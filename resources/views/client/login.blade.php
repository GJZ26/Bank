@include('partials.head', ['title' => 'Login'])

<style>
    body {
        background-image: url('images/login-back.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        min-width: 100vw;
        min-height: 100vh;
    }

    div.overlay {
        backdrop-filter: blur(3px);
        background-color: rgba(0, 0, 0, 0.104);
        min-width: 100%;
        min-height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    form {
        background-color: white;
        width: fit-content;
        border-radius: 4px;
        box-shadow: -1px 1px 7px 0px #6262620f;
        padding: 19px 54px 27px;
    }

    img {
        max-width: 80px;
    }

    h2 {
        color: rgb(45, 45, 45);
        display: block;
        font-weight: 500;
        font-size: 25px;
        margin-bottom: 20px;
    }

    label {
        margin-bottom: 5px;
        font-size: 15px;
    }

    p {
        font-size: 12.5px;
        margin: 20px 0px;
    }

    input:not([type=submit]) {
        width: 250px;
    }

    input[type=submit] {
        padding: 6px 25px;
    }

    a {
        color: rgb(0, 106, 255);
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
    }

    a:hover {
        color: rgb(0, 42, 255);
        transition: all 200ms
    }

    @media screen and (max-width: 1200px) {
        body {
            flex-direction: row;
        }

    }
</style>

<body>
    <div class="overlay">
        <form action="{{ url('/auth') }}" method="POST">
            @csrf
            <img src="images/logoRed.png" alt="Logo">
            <h2>Sign in</h2>
            <div class="vertical-input" style=" align-items: baseline;">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>
            <div class="vertical-input" style=" align-items: baseline;">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" autocomplete="off"
                    required>
            </div>
            <input type="submit" value="Login">
            @if (session('response'))
                <span class="alert error">{{ session()->get('response') }}</span>
            @endif
            <p>Don't have an account? <a href="#">Contact us</a>.</p>
        </form>
    </div>
</body>
