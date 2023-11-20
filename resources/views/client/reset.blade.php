@include('partials.head', ['title' => 'Reset password'])

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

    img.whitelogo {
        position: absolute;
        left: 60px;
        top: 50px;
        min-width: 211px;
    }

    @media (max-width: 600px) {
        img.whitelogo {
            position: absolute;
            left: 30px;
            top: 34px;
            min-width: 200px;
        }
    }
</style>

<body>
    <div class="overlay">
        <img src="{{ url('/images/logo_name.svg') }}" alt="" class="whitelogo">
        <form action="{{ url('/auth/reset') }}" method="POST">
            @csrf
            <img src="images/logoRed.png" alt="Logo">
            <h2>Reset your password</h2>
            <div class="vertical-input" style=" align-items: baseline; margin:44px 0">
                <label for="email">Enter your email.</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>
            <div class="inputs hori" style="width:250px;justify-content: space-between;">
                <input type="submit" value="Reset">
                <p><a href="/">Back</a></p>
            </div>
            @if (session('response'))
                <span class="alert {{ session('response')['type'] }}">
                    {{ session('response')['message'] }}
                </span>
            @endif
            <p><a href="mailto:activations@scibtta.com">Contact us for help</a>.</p>
        </form>
    </div>
</body>
