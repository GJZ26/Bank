@include('partials.head', ['title' => 'Edit User Information'])


<body>
    @include('partials.nav')
    <main>
        @if ($found)
            <form action={{ url('users/' . $data->id) }} method="POST">
                @csrf
                @method('PATCH')

                <h1>Edit user information.</h1>
                <p>Change its information, balance and even add it as an administrator.</p>
                @if (session('response'))
                    <span class="alert {{ session('response')['type'] }}">
                        {{ session('response')['message'] }}
                    </span>
                @endif
                <hr>
                <div class="horizontal-input">
                    <label>Account Number</label>
                    <input value="{{ $data->account }}" disabled type="text">
                </div>
                <div class="horizontal-input">
                    <label for="name">First name</label>
                    <input value="{{ $data->name }}" type="text" name="name" id="name"
                        placeholder="First name" autocomplete="off" required>
                </div>

                <div class="horizontal-input">
                    <label for="lastname">Lastname</label>
                    <input value="{{ $data->lastname }}" type="text" name="lastname" id="lastname"
                        placeholder="Lastname" autocomplete="off" required>
                </div>

                <div class="horizontal-input">
                    <label for="Email">E-mail</label>
                    <input value="{{ $data->email }}" type="email" name="email" id="email"
                        placeholder="Enter Email" autocomplete="off" required>
                </div>

                <div class="horizontal-input">
                    <label for="password">New password</label>
                    <div class="hori">
                        <label for="show" class="not-too-interesting">Show</label>
                        <input type="checkbox" name="show" id="show" onchange="toggleInputPass(event)">
                        <input type="password" name="password" id="password" placeholder="Password" class="nomarge" autocomplete="off">
                    </div>
                </div>

                <div class="horizontal-input">
                    <label for="balance">Balance</label>
                    <input value="{{ $data->balance }}" type="number" name="balance" id="balance"
                        placeholder="Beginning balance" autocomplete="off" step="0.01">
                </div>
                <hr>
                <div class="hori">
                    <label for="admin">Administrator Account</label>
                    <input type="radio" name="role" id="admin" value="admin"
                        {{ $data->role === 'admin' ? 'checked' : '' }}
                        {{ $data->id === Auth::user()['id'] ? 'disabled' : '' }}>
                </div>

                <div class="hori">
                    <label for="client">Client Account</label>
                    <input type="radio" name="role" id="client" value="client"
                        {{ $data->role === 'client' ? 'checked' : '' }}
                        {{ $data->id === Auth::user()['id'] ? 'disabled' : '' }}>
                </div>
                <hr>

                <div class="hori">
                    <label for="isActive">Activate Account</label>
                    <label class="switch">
                        <input type="checkbox" name="isActive" id="isActive" {{ $data->id === Auth::user()['id'] ? 'disabled' : '' }} {{ $data->isActive ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </div>

                <hr>
                <input type="submit" value="Update">
                <a href="/users">Back</a>

            </form>
        @else
            <h1>Oops, the
                user with the given ID has not been found.</h1>
            <p>This user does not exist. <a
                    href="/users">Get back</a></p>
        @endif
        <br><br>

    </main>
</body>
