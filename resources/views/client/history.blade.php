@include('partials.head', ['title' => 'Transactions'])
<script>
    function askDelete(e, id) {
        if (!confirm('Are you sure you want to perform this action?' + '\nTHIS ACTION CANNOT BE REVERSED.')) {
            return;
        }
        const btn = e.target.nodeName === 'I' ? e.target.parentNode : e.target
        btn.disabled = true
        const uri = "{{ url('/transaction') }}/" + id;

        const requestOptions = {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        };
        fetch(uri, requestOptions)
            .then((res) => {
                if (res.status === 200) {
                    btn.parentElement.parentNode.parentNode.removeChild(btn.parentElement.parentNode)
                } else {
                    console.log(res)
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>

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
                        <th {{-- class="not-too-interesting" --}}>Date</th>
                        <th @if (Auth::user()['role'] == 'admin') class="not-too-interesting" @endif>Transaction</th>
                        @if (Auth::user()['role'] == 'admin')
                            <th>Recipient</th>
                        @endif
                        <th>Amount</th>
                        @if (Auth::user()['role'] == 'admin')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (isset($response))
                        @foreach ($response as $record)
                            <tr>
                                {{-- <td>
                                    {{ str_repeat('*', 6) . substr($record['from'], -4) }}
                                </td> --}}
                                <td {{-- class="not-too-interesting" --}}>{{ $record['created_at'] }}</td>
                                <td @if (Auth::user()['role'] == 'admin') class="not-too-interesting" @endif>
                                    {{ isset($record['concept']) ? $record['concept'] : '' }}
                                </td>
                                @if (Auth::user()['role'] == 'admin')
                                    <td>{{ $record['to'] }}</td>
                                @endif
                                <td>${{ number_format($record['amount'], 2) }}</td>
                                @if (Auth::user()['role'] == 'admin')
                                    <td
                                        style="
                            display: flex;
                            align-items: center;
                            align-content: center;
                            justify-content: flex-start;
                            gap: 6px;
                            flex-wrap: wrap;
                        ">
                                        <button class="delete" onclick="askDelete(event,{{ $record['id'] }})"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </td>
                                @endif
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
            @if (!empty($response))
                <span class="hint summary" style="margin-top: 25px"><strong>Total Traded Shares:
                    </strong>{{ $count }}</span>
                <span class="hint summary"><strong>Total Balance: </strong>${{ number_format($total, 2) }}
                    USD</span>
            @endif
            <span class="improve">Enhance your experience by visiting the site from your desktop.</span>

        </div>
        <br><br>
    </main>
</body>
