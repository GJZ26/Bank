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
                    {{ Auth::user()['role'] === 'client' ? 'Temporary Holdings Account' : 'Admin' }}
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
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                class="acorn-icons acorn-icons-navigate-diagonal icon">
                <path
                    d="M3.04983 7.55492L16.2848 2.46454C17.0935 2.15349 17.8882 2.94813 17.5771 3.75687L12.4868 16.9918C12.1327 17.9124 10.8008 17.8188 10.579 16.8577L9.89512 13.8942C9.4652 12.0312 8.01048 10.5765 6.14747 10.1465L3.18395 9.46265C2.22288 9.24087 2.12925 7.90899 3.04983 7.55492Z">
                </path>
            </svg>
            Dashboard
        </a>

        @if (Auth::user()['role'] == 'admin')
        <a href="/transfer" {{ str_contains(request()->path(), 'transfer') ? 'class=active' : '' }}>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                class="acorn-icons acorn-icons-shuffle icon d-none">
                <path
                    d="M2 5H4.95869C5.61132 5 6.2229 5.31842 6.59715 5.85308L12.4028 14.1469C12.7771 14.6816 13.3887 15 14.0413 15H17">
                </path>
                <path
                    d="M17 5H14.0413C13.3887 5 12.7771 5.31842 12.4028 5.85308L6.59715 14.1469C6.2229 14.6816 5.61132 15 4.95869 15H2">
                </path>
                <path d="M16 13 18 15 16 17M16 3 18 5 16 7"></path>
            </svg>
            Transfers
        </a>
        @endif

        <a href="/history" {{ str_contains(request()->path(), 'history') ? 'class=active' : '' }}>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                class="acorn-icons acorn-icons-list icon d-none">
                <path d="M8 3 18 3M8 10 18 10M8 17 18 17"></path>
                <path
                    d="M2 3C2 2.44772 2.44772 2 3 2V2C3.55228 2 4 2.44772 4 3V3C4 3.55228 3.55228 4 3 4V4C2.44772 4 2 3.55228 2 3V3zM2 10C2 9.44772 2.44772 9 3 9V9C3.55228 9 4 9.44772 4 10V10C4 10.5523 3.55228 11 3 11V11C2.44772 11 2 10.5523 2 10V10zM2 17C2 16.4477 2.44772 16 3 16V16C3.55228 16 4 16.4477 4 17V17C4 17.5523 3.55228 18 3 18V18C2.44772 18 2 17.5523 2 17V17z">
                </path>
            </svg>
            Transactions
        </a>

        <a href="/announcements" {{ str_contains(request()->path(), 'announcements') ? 'class=active' : '' }}
            class="notificated" notifications="9+">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                class="acorn-icons acorn-icons-alarm icon d-none">
                <circle cx="10" cy="10" r="7"></circle>
                <path
                    d="M16 2 18 4M4 2 2 4M7 17 6 18M13 17 14 18M8 12 9.70711 10.2929C9.89464 10.1054 10 9.851 10 9.58579V6">
                </path>
            </svg>
            Announcements
        </a>

        @if (Auth::user()['role'] == 'admin')
            <a href="/users" {{ str_contains(request()->path(), 'users') ? 'class=active' : '' }}>
                <i class="fa-solid fa-users"></i>Manage Users
            </a>
        @else
            <a href="/credentials/" {{ str_contains(request()->path(), 'credentials') ? 'class=active' : '' }}>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="18" height="18"
                    viewBox="0 0 35 35" stroke="none" data-name="Layer 2"
                    id="a6b678a2-3714-46f6-ad50-598977cf64a4">
                    <path
                        d="M27.137,34.75H7.862a4.8,4.8,0,0,1-4.79-4.791V15.614a4.8,4.8,0,0,1,4.79-4.791H27.137a4.8,4.8,0,0,1,4.791,4.791V29.959A4.8,4.8,0,0,1,27.137,34.75ZM7.862,13.323a2.292,2.292,0,0,0-2.29,2.291V29.959a2.292,2.292,0,0,0,2.29,2.291H27.137a2.293,2.293,0,0,0,2.291-2.291V15.614a2.293,2.293,0,0,0-2.291-2.291Z" />
                    <path
                        d="M25.537,13.323a1.25,1.25,0,0,1-1.25-1.25V8.608a5.409,5.409,0,0,0-1.935-4.082A7.253,7.253,0,0,0,17.5,2.75c-3.744,0-6.79,2.628-6.79,5.858v3.465a1.25,1.25,0,0,1-2.5,0V8.608C8.207,4,12.375.25,17.5.25a9.748,9.748,0,0,1,6.511,2.4,7.869,7.869,0,0,1,2.779,5.955v3.465A1.25,1.25,0,0,1,25.537,13.323Z" />
                    <path
                        d="M17.5,25.779a1.25,1.25,0,0,1-1.25-1.25V21.2a1.25,1.25,0,0,1,2.5,0v3.334A1.25,1.25,0,0,1,17.5,25.779Z" />
                </svg>
                Change password
            </a>
        @endif

        <a href="/logout">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 20 20" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                class="acorn-icons acorn-icons-logout me-2">
                <path
                    d="M7 15 2.35355 10.3536C2.15829 10.1583 2.15829 9.84171 2.35355 9.64645L7 5M3 10H13M12 18 14.5 18C15.9045 18 16.6067 18 17.1111 17.6629 17.3295 17.517 17.517 17.3295 17.6629 17.1111 18 16.6067 18 15.9045 18 14.5L18 5.5C18 4.09554 18 3.39331 17.6629 2.88886 17.517 2.67048 17.3295 2.48298 17.1111 2.33706 16.6067 2 15.9045 2 14.5 2L12 2">
                </path>
            </svg>
            Logout
        </a>
    </div>
</nav>
