<form action="{{ url('/register') }}" method="post" enctype="multipart/form-data">
    @if (session('success'))
        <h1>HOLAAAAAAAAAAAA</h1>
    @else
        <h1>ADIOOOOOOOOOOOOO</h1>
    @endif

    @csrf
    <label for="name">First name</label>
    <input type="text" name="name" id="name" placeholder="Jhon" autocomplete="off">

    <label for="lastname">Lastname</label>
    <input type="text" name="lastname" id="lastname" placeholder="Smith R." autocomplete="off">

    <label for="Email">E-mail</label>
    <input type="email" name="email" id="email" placeholder="jhon@sample.com" autocomplete="off">

    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Password" autocomplete="off">

    <label for="balance">Balance</label>
    <input type="number" name="balance" id="balance" placeholder="100.00" autocomplete="off">

    <div>
        <label for="admin">Administrator Account</label>
        <input type="radio" name="role" id="admin" value="admin">
    </div>

    <div>
        <label for="client">Client Account</label>
        <input type="radio" name="role" id="client" value="client" checked>
    </div>

    <label for="isActive">Activate Account</label>
    <input type="checkbox" name="isActive" id="isActive" checked>

    <input type="submit" value="Enviar">

</form>
