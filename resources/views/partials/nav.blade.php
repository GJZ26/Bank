<script>
    function myFunction(x) {
        x.classList.toggle("change");
        document.getElementById('tabs').classList.toggle('collapsed');
    }
</script>
<nav>
    <div class="logo">
        <img src={{ asset('images/logoRed.png') }} alt="Logo">
    </div>
    <div class="client-info">
        <div class="profile">
            <img src={{ asset('images/default-avatar.png') }} alt="Default Avatar">
            <div class="info">
                <h2>
                    {{ explode(' ', Auth::user()['name'])[0] }} {{ explode(' ', Auth::user()['lastname'])[0] }}
                </h2>
                <p>
                    {{ Auth::user()['role'] === 'client' ? 'Standard' : 'Admin' }} Account
                </p>
            </div>
        </div>
        <div class="container" onclick="myFunction(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </div>
    <div class="tabs collapsed" id="tabs">


        <a href="/dashboard" {{ str_contains(request()->path(), 'dashboard') ? 'class=active' : '' }}>
            <i class="fa-solid fa-gauge-high"></i>Dashboard
        </a>
        <a href="/transfer" {{ str_contains(request()->path(), 'transfer') ? 'class=active' : '' }}>
            <i class="fa-solid fa-money-bill-transfer"></i>Transfers
        </a>

        <a href="/history" {{ str_contains(request()->path(), 'history') ? 'class=active' : '' }}>
            <i class="fa-solid fa-clock-rotate-left"></i>Transactions
        </a>

        <a href="/announcements" {{ str_contains(request()->path(), 'announcements') ? 'class=active' : '' }}
            class="notificated" notifications="9+">
            <i class="fa-solid fa-bullhorn"></i>Announcements
        </a>

        @if (Auth::user()['role'] == 'admin')
            <a href="/users" {{ str_contains(request()->path(), 'users') ? 'class=active' : '' }}>
                <i class="fa-solid fa-users"></i>Manage Users
            </a>
        @endif

        <a href="/logout">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>Logout
        </a>
    </div>
</nav>
