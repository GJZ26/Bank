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
            <p>Corporate & Investment Banking</p>
            <hr>
            <div class="vertical-input">
                <label for="sender">From my account</label>
                <div class="input">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="acorn-icons acorn-icons-home-garage undefined">
                        <g clip-path="url(#clip0_630:3623)">
                            <path
                                d="M3 11V16.25C3 16.9522 3 17.3033 3.16853 17.5556 3.24149 17.6648 3.33524 17.7585 3.44443 17.8315 3.69665 18 4.04777 18 4.75 18H5.25C5.95223 18 6.30335 18 6.55557 17.8315 6.66476 17.7585 6.75851 17.6648 6.83147 17.5556 7 17.3033 7 16.9522 7 16.25V3M7 8V16.25C7 16.9522 7 17.3033 7.16853 17.5556 7.24149 17.6648 7.33524 17.7585 7.44443 17.8315 7.69665 18 8.04777 18 8.75 18H15.25C15.9522 18 16.3033 18 16.5556 17.8315 16.6648 17.7585 16.7585 17.6648 16.8315 17.5556 17 17.3033 17 16.9522 17 16.25V8">
                            </path>
                            <path d="M2 11.5 7 8.5M5.50024 2.49994 19.0002 8.99994"></path>
                            <path
                                d="M14 18V13.875C14 13.5239 14 13.3483 13.9157 13.2222C13.8793 13.1676 13.8324 13.1207 13.7778 13.0843C13.6517 13 13.4761 13 13.125 13H10.875C10.5239 13 10.3483 13 10.2222 13.0843C10.1676 13.1207 10.1207 13.1676 10.0843 13.2222C10 13.3483 10 13.5239 10 13.875V18">
                            </path>
                        </g>
                        <defs>
                            <clippath id="clip0_630:3623">
                                <path d="M0 0H20V20H0z"></path>
                            </clippath>
                        </defs>
                    </svg>
                    <input type="number" name="sender" id="sender" value="{{ Auth::user()['account'] }}" disabled>
                </div>
            </div>
            <div class="vertical-input">
                <label for="recipient">To</label>
                <div class="input">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" class="acorn-icons acorn-icons-home-garage undefined">
                        <g clip-path="url(#clip0_630:3623)">
                            <path
                                d="M3 11V16.25C3 16.9522 3 17.3033 3.16853 17.5556 3.24149 17.6648 3.33524 17.7585 3.44443 17.8315 3.69665 18 4.04777 18 4.75 18H5.25C5.95223 18 6.30335 18 6.55557 17.8315 6.66476 17.7585 6.75851 17.6648 6.83147 17.5556 7 17.3033 7 16.9522 7 16.25V3M7 8V16.25C7 16.9522 7 17.3033 7.16853 17.5556 7.24149 17.6648 7.33524 17.7585 7.44443 17.8315 7.69665 18 8.04777 18 8.75 18H15.25C15.9522 18 16.3033 18 16.5556 17.8315 16.6648 17.7585 16.7585 17.6648 16.8315 17.5556 17 17.3033 17 16.9522 17 16.25V8">
                            </path>
                            <path d="M2 11.5 7 8.5M5.50024 2.49994 19.0002 8.99994"></path>
                            <path
                                d="M14 18V13.875C14 13.5239 14 13.3483 13.9157 13.2222C13.8793 13.1676 13.8324 13.1207 13.7778 13.0843C13.6517 13 13.4761 13 13.125 13H10.875C10.5239 13 10.3483 13 10.2222 13.0843C10.1676 13.1207 10.1207 13.1676 10.0843 13.2222C10 13.3483 10 13.5239 10 13.875V18">
                            </path>
                        </g>
                        <defs>
                            <clippath id="clip0_630:3623">
                                <path d="M0 0H20V20H0z"></path>
                            </clippath>
                        </defs>
                    </svg>
                    <input type="number" name="recipient" id="recipient" placeholder="11-digit account number" required
                        {{ Auth::user()['role'] === 'admin' ? '' : 'disabled' }}>
                </div>
            </div>
            <div class="vertical-input">
                <label for="amount">Amount</label>
                <div class="input">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" class="acorn-icons acorn-icons-wallet undefined">
                        <path
                            d="M5.5 17L14.5 17C15.9045 17 16.6067 17 17.1111 16.6629C17.3295 16.517 17.517 16.3295 17.6629 16.1111C18 15.6067 18 14.9045 18 13.5L18 13.2667L18 9.53333C18 9.03764 18 8.78979 17.9563 8.58418C17.7921 7.81154 17.1885 7.20793 16.4158 7.0437C16.2102 7 15.9624 7 15.4667 7L10.9366 7C10.5447 7 10.3488 7 10.1749 6.93285C10.0984 6.90331 10.0259 6.86447 9.95884 6.81721C9.80652 6.70978 9.69784 6.54676 9.48048 6.22073L7.85285 3.77927C7.63549 3.45323 7.52681 3.29022 7.37449 3.18279C7.30748 3.13553 7.23491 3.09669 7.15841 3.06715C6.98454 3 6.78861 3 6.39676 3L5.5 3C4.09554 3 3.39331 3 2.88886 3.33706C2.67048 3.48298 2.48298 3.67048 2.33706 3.88886C2 4.39331 2 5.09554 2 6.5L2 13.5C2 14.9045 2 15.6067 2.33706 16.1111C2.48298 16.3295 2.67048 16.517 2.88886 16.6629C3.39331 17 4.09554 17 5.5 17Z">
                        </path>
                        <path
                            d="M18 9L18 7.5C18 6.09554 18 5.39331 17.6629 4.88886C17.517 4.67048 17.3295 4.48298 17.1111 4.33706C16.6067 4 15.9045 4 14.5 4L8 4">
                        </path>
                        <path d="M6 13H8"></path>
                    </svg>
                    <input type="number" name="amount" id="amount"
                        min="0" step="0.01" placeholder="Amount to be transferred"
                        {{ Auth::user()['role'] === 'admin' ? '' : 'disabled' }} required
                        oninput="calculaterCurrentBalance(event)">
                </div>
            </div>
            @if(Auth::user()['role']==='admin')
            <div class="vertical-input">
                <label for="concept">Concept</label>
                <div class="input">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M7 9H17M7 13H17M21 20L17.6757 18.3378C17.4237 18.2118 17.2977 18.1488 17.1656 18.1044C17.0484 18.065 16.9277 18.0365 16.8052 18.0193C16.6672 18 16.5263 18 16.2446 18H6.2C5.07989 18 4.51984 18 4.09202 17.782C3.71569 17.5903 3.40973 17.2843 3.21799 16.908C3 16.4802 3 15.9201 3 14.8V7.2C3 6.07989 3 5.51984 3.21799 5.09202C3.40973 4.71569 3.71569 4.40973 4.09202 4.21799C4.51984 4 5.0799 4 6.2 4H17.8C18.9201 4 19.4802 4 19.908 4.21799C20.2843 4.40973 20.5903 4.71569 20.782 5.09202C21 5.51984 21 6.0799 21 7.2V20Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <input type="text" name="concept" id="concept" placeholder="Concept"
                        {{ Auth::user()['role'] === 'admin' ? '' : 'disabled' }}>
                </div>
            </div>
            @endif
            <hr>
            <input type="submit" value="Transfer" {{ Auth::user()['role'] === 'admin' ? '' : 'disabled' }}>


            @if (!Auth::user()['role'] === 'admin')
                {{-- <span class="alert warn">
                    Your account is inactive, you cannot make transfers at this time.
                </span> --}}
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
