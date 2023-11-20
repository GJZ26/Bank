@include('partials.head', ['title' => 'Set your new password'])
<body>

    <main>
        <form action="{{ url()->current() }}" method="post">
            @csrf
            <h1>Set your new password.</h1>
            <p>Change your login credentials.</p>
            @if (session('response'))
                <span class="alert {{ session('response')['type'] }}">
                    {{ session('response')['message'] }}
                </span>
            @endif
            <hr>

            <div class="horizontal-input">
                <label for="password">New Password</label>
                <div class="hori">
                    <label for="show" class="not-too-interesting">Show</label>
                    <input type="checkbox" name="show" id="show" onchange="toggleInputPass(event)" checked>
                    <input min="8" type="text" class="nomarge" name="password" id="password" placeholder="Password"
                        autocomplete="off" required>
                </div>
            </div>

            <hr>
            <input type="submit" value="Change">
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