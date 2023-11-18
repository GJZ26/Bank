@include('partials.head', ['title' => 'Transfer registers.'])

<body>
    @include('partials.nav')
    <main style="margin-left: 200px">
        <div class="records">
            <h2>Transfer registers</h2>
            {{-- <input type="search" name="search" id="search" placeholder="Search" autocomplete="off"> --}}
            <table class="record">
                <tbody>
                    <tr>
                        <th>
                            Sender's Account
                            {{-- <i class="fa-solid fa-chevron-up"></i> --}}
                        </th>
                        <th>
                            Recipient's Account
                            {{-- <i class="fa-solid fa-chevron-up"></i> --}}
                        </th>
                        <th>
                            Amount
                            {{-- <i class="fa-solid fa-chevron-up"></i> --}}
                        </th>
                        <th>
                            Concept
                            {{-- <i class="fa-solid fa-chevron-up"></i> --}}
                        </th>
                        <th>
                            Date
                            {{-- <i class="fa-solid fa-chevron-up"></i> --}}
                        </th>
                    </tr>
                    @foreach ($response as $record)
                        <tr>
                            <td
                                style="{{ $record['from'] === '<External-Account>' ? 'color: #aeaeae;font-style: italic;' : '' }}">
                                    {{
                                        $record['from'] === '<External-Account>'
                                            ? '<External-Account>'
                                            : ($record['from'] === Auth::user()['account']
                                                ? 'Your account'
                                                : implode('-', str_split($record['from'], 5))
                                            )
                                    }}
                                    
                                {{-- {{ ($record['from'] === Auth::user()['account'] ? ' Your account ' : $record['from'] !== '<External-Account>') ? implode('-', str_split($record['from'], 5)) : '<External-Account>' }} --}}
                            </td>
                            <td>
                                {{ Auth::user()['account'] == $record['to'] ? ' Your account ' : implode('-', str_split($record['to'], 5)) }}
                            </td>
                            <td>${{ number_format($record['amount'], 2) }} USD</td>
                            <td
                                style="max-width: 186px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;{{ !isset($record['concept']) ? 'color: #aeaeae;font-style: italic;' : '' }}">
                                {{ isset($record['concept']) ? $record['concept'] : '[ No concept ]' }}
                            </td>
                            <td>{{ $record['created_at'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>
