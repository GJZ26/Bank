@include('partials.head', ['title' => 'Transfer'])
<script>
    function calculaterCurrentBalance(e){
        const initial_value = {{Auth::user()['balance']}};
        document.getElementById("actual").textContent = `$${(initial_value - e.target.value).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} USD`
    }
</script>
<body>
    @include('partials.nav')
    <main>
        <form action={{ url('/transfer') }} method="post">
            @csrf
            <h1>Transfer</h1>
            <p>Transfer your credit to another user by means of their account number.</p>
            <hr>
            <div class="horizontal-input">
                <label for="sender">Sender's account number</label>
                <input type="number" name="sender" id="sender" value="{{ Auth::user()['account'] }}" disabled>
            </div>
            <div class="horizontal-input">
                <label for="recipient">Recipient's account number</label>
                <input type="number" name="recipient" id="recipient" placeholder="20-digit account number" required
                    {{ Auth::user()['isActive'] ? '' : 'disabled' }}>
            </div>
            <div class="horizontal-input">
                <label for="amount">Amount (USD)</label>
                <input type="number" name="amount" id="amount" max="{{ Auth::user()['balance'] }}" min="0"
                    step="0.01" placeholder="Amount to be transferred"
                    {{ Auth::user()['isActive'] ? '' : 'disabled' }} required style="width: 189px"
                    oninput="calculaterCurrentBalance(event)">
            </div>
            <div class="horizontal-input">
                <label for="concept">Concept</label>
                <input type="text" name="concept" id="concept" placeholder="Concept"
                    {{ Auth::user()['isActive'] ? '' : 'disabled' }}>
            </div>
            <hr>
            <input type="submit" value="Transfer" {{ Auth::user()['isActive'] ? '' : 'disabled' }}>
            <p>Your balance after the transfer: <span id="actual"
                    style="font-weight: 400;">${{ number_format(Auth::user()['balance'], 2) }} USD</span></p>

            @if (!Auth::user()['isActive'])
                <span class="alert warn">
                    Your account is inactive, you cannot make transfers at this time.
                </span>
            @endif

            @if (session('response'))
                <span class="alert {{ session('response')['type'] }}">
                    {{ session('response')['message'] }}
                </span>
            @endif
        </form>
    </main>
</body>
