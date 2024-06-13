<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userAccount = Auth::user()["account"];
        $total = 0;
        $count = 0;

        $transactions = Transaction::where('from', $userAccount)
            ->orWhere('to', $userAccount)
            ->select('id', 'from', 'to', 'amount', 'concept', 'created_at')
            ->orderBy('created_at', 'asc') // Ordenar por created_at en orden ascendente
            ->get()
            ->map(function ($transaction) use (&$total, &$count) {
                // Obtener el cliente correspondiente al transaction->to
                $clientInfo = Client::where('account', $transaction->to)->first();

                $total += $transaction->amount;
                $count += str_contains($transaction->concept, 'o') ? 0 : (int)$transaction->concept;

                return [
                    'id' => $transaction->id,
                    'from' => $transaction->from,
                    'to' => $clientInfo ? $clientInfo->name . ' ' . $clientInfo->lastname : '[ Client not found ]',
                    'amount' => $transaction->amount,
                    'concept' => str_contains($transaction->concept, 'o') ?  "Opening Balance" : $transaction->concept . " Traded Shares",
                    'created_at' => Carbon::parse($transaction->created_at)->format('Y-m-d')
                ];
            })
            ->toArray();

        return view('client.history')->with(["response" => $transactions, "total" => $total, "count" => $count]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $recipientAccount = $request->input("recipient");
        $amount = $request->input('amount');

        // Buscar al destinatario por la cuenta
        $recipient = Client::where("account", $recipientAccount)->first();

        // Verificar si el destinatario existe
        if (!$recipient) {
            return redirect('/transfer')->with(['response' => [
                'type' => 'error',
                'message' => 'The addressee could not be located, and the transaction was unsuccessful.'
            ]]);
        }

        // Verificar si el usuario tiene saldo suficiente para la transacción
        if (!($amount <= Auth::user()->balance && $amount > 0) && Auth::user()['role'] === 'client') {
            return redirect('/transfer')->with(['response' => [
                'type' => 'error',
                'message' => 'You do not have the necessary amount for the transaction.'
            ]]);
        }

        if (Auth::user()['account'] === $recipientAccount) {
            return redirect('/transfer')->with(['response' => [
                'type' => 'warn',
                'message' => 'You should not transfer yourself.'
            ]]);
        }

        if (!Auth::user()['isActive'] && Auth::user()["role"] === 'client') {
            return redirect('/transfer')->with(['response' => [
                'type' => 'error',
                'message' => 'Your account is disabled.'
            ]]);
        }

        if ($amount <= 0) {
            return redirect('/transfer')->with(['response' => [
                'type' => 'error',
                'message' => "You cannot transfer amounts less than or equal to zero."
            ]]);
        }

        // Actualizar los saldos del remitente y el destinatario
        $recipient->update([
            "balance" => $recipient->balance + $amount
        ]);

        // if (Auth::user()['role'] === 'client') {
        //     Auth::user()->update([
        //         "balance" => Auth::user()->balance - $amount
        //     ]);
        // }


        try {
            $record = new Transaction([
                "from" => Auth::user()["account"],
                "to" => $recipientAccount,
                "amount" => $amount,
                "concept" => $request->has("concept") ? $request->input("concept") : "",
                "created_at" => $request->input("date") # Created no está definido en el modelo, pero quiero modificarlo desde acá
            ]);
            $record->timestamps = false; // Desactiva la gestión automática de timestamps
            $record->save();
            $record->timestamps = true; // Reactiva la gestión automática de timestamps
        } catch (Exception $e) {
            return redirect('/transfer')->with(['response' => [
                'type' => 'error',
                'message' => 'A server error has occurred, try again later.'
            ]]);
        }

        return redirect('/transfer')->with(['response' => [
            'type' => 'success',
            'message' => 'The transfer has been successfully completed.'
        ]]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        if (!Auth::check() || Auth::user()->role != 'admin') {
            return redirect('/dashboard');
        }

        $users = Client::where('account', '!=', '00000000000000000000')
            ->get(['name', 'lastname', 'account'])
            ->toArray();

        return view('client.transfer', ['users' => $users]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if (!Auth::check()) {
            return response('ok', 401);
        }
        if (Auth::user()['role'] != 'admin') {
            return response('ok', 401);
        }
        try {
            Transaction::where('id', $id)->delete();
            echo 'ok';
        } catch (Exception $e) {
            echo '$e';
        }

        return response('ok', 200);
    }
}
