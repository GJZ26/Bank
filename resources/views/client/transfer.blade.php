@include('partials.head', ['title' => 'Transfer'])
<script>
    function calculaterCurrentBalance(e) {
        const initial_value = {{ Auth::user()['balance'] }};
        document.getElementById("actual").textContent =
            `$${(initial_value - e.target.value).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} USD`
    }
</script>

<body>
    @include('partials.nav')
    <main>
        <form action={{ url('/transfer') }} method="post" class="transfer">
            @csrf
            <h1>Transfer</h1>
            <p>Transfer your credit to another user by means of their account number.</p>
            <hr>
            <div class="vertical-input">
                <label for="sender">From my account</label>
                <div class="input">
                    <i class="fa-solid fa-building-columns"></i>
                    <input type="number" name="sender" id="sender" value="{{ Auth::user()['account'] }}" disabled>
                </div>
            </div>
            <div class="vertical-input">
                <label for="recipient">To</label>
                <div class="input">
                    <i class="fa-solid fa-building-columns" style="margin-top: 17px;"></i>
                    <input type="number" name="recipient" id="recipient" placeholder="20-digit account number" required
                        {{ Auth::user()['isActive'] ? '' : 'disabled' }}>
                </div>
            </div>
            <div class="vertical-input">
                <label for="amount">Amount</label>
                <div class="input">
                    <i class="fa-solid fa-money-bill" style="margin-top: 18px;"></i>
                    <input type="number" name="amount" id="amount" max="{{ Auth::user()['balance'] }}"
                        min="0" step="0.01" placeholder="Amount to be transferred"
                        {{ Auth::user()['isActive'] ? '' : 'disabled' }} required
                        oninput="calculaterCurrentBalance(event)">
                </div>
            </div>
            <div class="vertical-input">
                <label for="concept">Concept</label>
                <div class="input">
                    <i class="fa-solid fa-message" style="margin-top: 19px;"></i>
                    <input type="text" name="concept" id="concept" placeholder="Concept"
                        {{ Auth::user()['isActive'] ? '' : 'disabled' }}>
                </div>
            </div>
            <hr>
            <input type="submit" value="Transfer" {{ Auth::user()['isActive'] ? '' : 'disabled' }}>


            @if (!Auth::user()['isActive'])
                <span class="alert warn">
                    Your account is inactive, you cannot make transfers at this time.
                </span>
            @else
                <p class="dinamic-credit">Your balance after the transfer: <span id="actual">
                        ${{ number_format(Auth::user()['balance'], 2) }} USD</span></p>
            @endif


            @if (session('response'))
                <span class="alert {{ session('response')['type'] }}">
                    {{ session('response')['message'] }}
                </span>
            @endif
        </form>
        <br>
        <br>
    </main>
</body>
