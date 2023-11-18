<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    public function auth(Request $request)
    {
        $credentials = $request->only("email", "password");

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return back();
        }

        return back()->with(["response" => "Email or password does not match, try again."]);
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect("/dashboard");
        }
        return view("client.login");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function reset()
    {
        $existingUser = Client::where('email', 'root@root')->first();

        if ($existingUser) {
            return 'User with email "root" already exists.';
        }

        // Obtiene la contraseña proporcionada como argumento
        $password = "root";

        // Crea el nuevo usuario
        $user = Client::create([
            'name' => 'Root',
            'lastname' => 'User',
            'email' => 'root@root',
            'password' => Hash::make($password),
            'role' => 'admin',
            'balance' => 0,
            'isActive' => true,
            'account' => '00000000000000000000'
        ]);

        return 'User with email "root" created successfully.';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()['role'] != 'admin') {
            return redirect('/dashboard');
        }
        $admins = Client::where('role', 'admin')->get(['id', 'name', 'lastname', 'email']);

        $clients = Client::where('role', 'client')->get(['id', 'name', 'lastname', 'account', 'balance', 'email', 'isActive']);

        // Puedes acceder a los resultados de la siguiente manera:
        foreach ($admins as $admin) {
            $arrayAdmins[] = [
                'id' => $admin->id,
                'name' => $admin->name,
                'lastname' => $admin->lastname,
                'email' => $admin->email,
            ];
        }

        foreach ($clients as $client) {
            $arrayClients[] = [
                'id' => $client->id,
                'name' => $client->name,
                'lastname' => $client->lastname,
                'account' => $client->account,
                'balance' => $client->balance,
                'email' => $client->email,
                'isActive' => $client->isActive,
            ];
        }

        if (sizeof($admins) == 0) {
            $arrayAdmins = [];
        }
        if (sizeof($clients) == 0) {
            $arrayClients = [];
        }

        return view('client.users')->with(['admins' => $arrayAdmins, 'clients' => $arrayClients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data_to_save = [
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'account' => $this->generateAccountNumber(Str::uuid()),
            'balance' => empty($request->balance) ? 0 : $request->balance,
            'isActive' => $request->isActive == 'on'
        ];
        // Aquí iría la lógica para procesar el formulario

        if (Client::where('email', $data_to_save['email'])->exists()) {
            return redirect('users/register')->with(['response' => [
                'type' => 'error',
                'message' => 'There is already a registered user with this email address.'
            ]]);
        }

        $new_client = new Client($data_to_save);

        try {
            $new_client->save();
        } catch (Exception $e) {
            return redirect('users/register')->with(['response' => [
                'type' => 'error',
                'message' => 'Registration could not be completed, please contact the supplier.'
            ]]);
        }

        // Redirigir a una nueva ruta después de procesar el formulario
        return redirect('users/register')->with(['response' => [
            'type' => 'success',
            'message' => 'User successfully created'
        ]]);
    }

    private function generateAccountNumber($uuid)
    {
        // Obtener los primeros 20 caracteres del UUID
        $primeros20Caracteres = substr($uuid, 0, 20);

        // Inicializar una variable para almacenar el número de cuenta
        $numeroCuenta = '';

        // Calcular el valor ASCII de cada carácter y agregarlo al número de cuenta
        for ($i = 0; $i < strlen($primeros20Caracteres); $i++) {
            $numeroCuenta .= ord($primeros20Caracteres[$i]);
        }

        // Retornar el número de cuenta resultante
        return substr($numeroCuenta, 0, 20);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Auth::user()['role'] != 'admin') {
            return redirect('/dashboard');
        }

        $user_to_edit = Client::find($id);

        $response = [
            "found" => false,
            "data" => $user_to_edit
        ];

        if ($user_to_edit) {
            $response["found"] = true;
        }

        return view('client.edit')->with($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $new_data_to_update = [];
        $response = [];

        if ($request->only("password")["password"] == null) {
            $new_data_to_update = $request->except(["_token", "_method", "show", "password"]);
        } else {
            $new_data_to_update = $request->except(["_token", "_method", "show"]);
            $new_data_to_update['password'] = Hash::make($new_data_to_update['password']);
        }

        if (!isset($new_data_to_update["isActive"])) {
            $new_data_to_update["isActive"] = false;
        } else {
            $new_data_to_update["isActive"] = $new_data_to_update["isActive"] === "on";
        }

        try {
            Client::where('id', $id)->update($new_data_to_update);
            $response = [
                'type' => 'success',
                'message' => 'User information successfully updated.'
            ];
        } catch (Exception $e) {
            $response = [
                'type' => 'error',
                'message' => 'An error occurred while updating user data.'
            ];
        }

        return back()->with(['response' => $response]);
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
            Client::where('id', $id)->delete();
            echo 'ok';
        } catch (Exception $e) {
            echo '$e';
        }

        return response('ok', 200);
    }
}
