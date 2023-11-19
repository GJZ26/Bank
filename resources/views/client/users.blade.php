@include('partials.head', ['title' => 'User list.'])

<script>
    function askDelete(e, id, name) {
        if (!confirm('Are you sure you want to delete the user ' + name + '?\nTHIS ACTION CANNOT BE REVERSED.')) {
            return;
        }
        const btn = e.target.nodeName === 'I' ? e.target.parentNode : e.target
        btn.disabled = true
        const uri = "{{ url('/users') }}/" + id;

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
        <div class="records user">
            <h1>User list</h1>
            <p>Manage your customer users or administrators from this section or <a href="/users/register">add a new
                    one</a>.</p>
            <h2 class="admins">Administrators</h2>
            <table class="record">
                <tbody>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td class="not-too-interesting">Lastname</td>
                        <td>Email</td>
                        <td>Actions</td>
                    </tr>
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $admin['id'] }}</td>
                            <td>{{ $admin['name'] }}</td>
                            <td class="not-too-interesting">{{ $admin['lastname'] }}</td>
                            <td>{{ $admin['email'] }}</td>
                            <td
                                style="
                            display: flex;
                            align-items: center;
                            align-content: center;
                            justify-content: flex-start;
                            gap: 6px;
                            flex-wrap: wrap;
                        ">
                                <a href={{ url('/users/' . $admin['id']) }}>
                                    <button class="edit"><i class="fa-solid fa-pen"></i></button>
                                </a>
                                @if (Auth::user()['id'] != $admin['id'])
                                    <button class="delete"
                                        onclick="askDelete(event,{{ $admin['id'] }}, '{{ $admin['name'] }}')"><i
                                            class="fa-solid fa-trash"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <h2>Clients</h2>
            <table class="record">
                <tbody>
                    <tr>
                        <td class="not-too-interesting">ID</td>
                        <td>Name</td>
                        <td class="not-too-interesting">Lastname</td>
                        <td class="not-too-interesting">Account</td>
                        <td>Balance</td>
                        <td>Email</td>
                        <td>Status</td>
                        <td>Actions</td>
                    </tr>
                    @foreach ($clients as $client)
                        <tr>
                            <td class="not-too-interesting">{{ $client['id'] }}</td>
                            <td>{{ $client['name'] }}</td>
                            <td class="not-too-interesting">{{ $client['lastname'] }}</td>
                            <td class="not-too-interesting">{{ substr($client['account'], 0, 4) . '###' . substr($client['account'], -4) }}</td>
                            <td>${{ number_format($client['balance'], 2) }} USD</td>
                            <td>{{ $client['email'] }}</td>
                            <td class="{{ $client['isActive'] ? 'active' : 'inactive' }}">
                                {{ $client['isActive'] ? 'Active' : 'Inactive' }}</td>
                            <td
                            style="
                        display: flex;
                        align-items: center;
                        align-content: center;
                        justify-content: flex-start;
                        gap: 6px;
                        flex-wrap: wrap;
                    ">
                                <a href={{ url('/users/' . $client['id']) }}>
                                    <button class="edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                </a>
                                <button class="delete"
                                    onclick="askDelete(event,{{ $client['id'] }},'{{ $client['name'] }}')"><i
                                        class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br><br>
    </main>
</body>
