@include('partials.head', ['title' => 'Transactions'])

<body>
    @include('partials.nav')
    <main>
        <div class="records">
            <h2>Transactions</h2>
            <p>Corporate & Investment Banking</p>
            {{-- <input type="search" name="search" id="search" placeholder="Search" autocomplete="off"> --}}
            <table class="record">
                <thead>
                    <tr>
                        {{-- <th>Account Number</th> --}}
                        <th>Amount</th>
                        @if (Auth::user()['role'] == 'admin')
                            <th>Recipient</th>
                        @endif
                        <th @if (Auth::user()['role'] == 'admin') class="not-too-interesting" @endif>Transaction</th>
                        <th class="not-too-interesting">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($response))
                        @foreach ($response as $record)
                            <tr>
                                {{-- <td>
                                    {{ str_repeat('*', 6) . substr($record['from'], -4) }}
                                </td> --}}
                                <td>{{ $record['amount'] }}</td>
                                @if (Auth::user()['role'] == 'admin')
                                    <td>{{ $record['to'] }}</td>
                                @endif
                                <td @if (Auth::user()['role'] == 'admin') class="not-too-interesting" @endif>
                                    {{ isset($record['concept']) ? $record['concept'] : '' }}
                                </td>
                                <td class="not-too-interesting">{{ $record['created_at'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if (empty($response))
                        <tr>
                            <td colspan="5" class="not-found" style="padding: 33px 0; color:gray; text-align: center;">
                                There are no transaction records.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <span class="improve">Enhance your experience by visiting the site from your desktop.</span>

        </div>
        <br><br>
    </main>
</body>
