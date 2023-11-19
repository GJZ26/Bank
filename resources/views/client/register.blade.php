@include('partials.head', ['title' => 'Register a new user'])
<body>
    @include('partials.nav')

    <main>
        <form action={{ url('users/register') }} method="post">
            @csrf
            <h1>Register a new user.</h1>
            <p>Register a new user as a customer or as an account administrator.</p>
            @if (session('response'))
                <span class="alert {{ session('response')['type'] }}">
                    {{ session('response')['message'] }}
                </span>
            @endif
            <hr>
            <div class="horizontal-input">
                <label for="name">First name</label>
                <input type="text" name="name" id="name" placeholder="First name" autocomplete="off" required>
            </div>

            <div class="horizontal-input">
                <label for="lastname">Lastname</label>
                <input type="text" name="lastname" id="lastname" placeholder="Lastname" autocomplete="off" required>
            </div>

            <div class="horizontal-input">
                <label for="Email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Enter Email" autocomplete="off"
                    required>
            </div>

            <div class="horizontal-input">
                <label for="password">Password</label>
                <div class="hori">
                    <label for="show" class="not-too-interesting">Show</label>
                    <input type="checkbox" name="show" id="show" onchange="toggleInputPass(event)" checked>
                    <input type="text" class="nomarge" name="password" id="password" placeholder="Password"
                        autocomplete="off" required>
                </div>
            </div>

            <div class="horizontal-input">
                <label for="balance">Balance</label>
                <input type="number" name="balance" id="balance" placeholder="Beginning balance" autocomplete="off"
                    step="0.01">
            </div>
            <hr>
            <div class="hori">
                <label for="admin">Administrator Account</label>
                <input type="radio" name="role" id="admin" value="admin">
            </div>

            <div class="hori">
                <label for="client">Client Account</label>
                <input type="radio" name="role" id="client" value="client" checked>
            </div>
            <hr>

            <div class="hori">
                <label for="isActive">Activate Account</label>
                <label class="switch">
                    <input type="checkbox" name="isActive" id="isActive" checked>
                    <span class="slider"></span>
                </label>
            </div>

            <hr>
            <input type="submit" value="Create">
            <a href="/users">Back</a>

        </form>
        <br><br>

    </main>
</body>
<script>
    const longitud = 8; // Puedes ajustar la longitud de la contraseña según tus necesidades
    const caracteres = 'dgKTYJeXfvZUCcNQ1sGOmqzF3kA8EbB7rn2Ip6t5MjwVuoLPa90SRDlxWy4hiH';
    let contrasena = '';

    for (let i = 0; i < longitud; i++) {
        const caracterAleatorio = caracteres.charAt(Math.floor(Math.random() * caracteres.length));
        contrasena += caracterAleatorio;
    }

    document.getElementsByName('password')[0].value = contrasena;
    console.log(contrasena)
</script>