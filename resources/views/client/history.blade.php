@include('partials.head', ['title' => 'Transactions'])

<body>
    @include('partials.nav')
    <main>
        <div class="records">
            <h2>Transactions</h2>
            <p>All records of transactions sent and received.</p>
            {{-- <input type="search" name="search" id="search" placeholder="Search" autocomplete="off"> --}}
            <table class="record">
                <thead>
                    <tr>
                        <th>Sender's Account</th>
                        <th>Recipient's Account</th>
                        <th>Amount</th>
                        <th class="not-too-interesting">Concept</th>
                        <th class="not-too-interesting">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($response))
                        @foreach ($response as $record)
                            <tr>
                                <td>
                                    {{ $record['from'] === '<External-Account>'
                                        ? '<External-Account>'
                                        : ($record['from'] === Auth::user()['account']
                                            ? 'Your account'
                                            : implode('-', str_split($record['from'], 5))) }}
                                </td>
                                <td>
                                    {{ Auth::user()['account'] == $record['to'] ? 'Your account' : implode('-', str_split($record['to'], 5)) }}
                                </td>
                                <td>${{ number_format($record['amount'], 2) }} USD</td>
                                <td class="not-too-interesting">
                                    {{ isset($record['concept']) ? $record['concept'] : '[No concept]' }}
                                </td>
                                <td class="not-too-interesting">{{ $record['created_at'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if (empty($response))
                        <tr>
                            <td colspan="5" class="not-found" style="padding: 33px 0; color:gray; text-align: center;">There are no transaction records.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <span class="improve">Enhance your experience by visiting the site from your desktop.</span>

        </div>
        <br><br>
    </main>
</body>
