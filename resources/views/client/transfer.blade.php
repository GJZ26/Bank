@include('partials.head', ['title' => 'Transfer'])
<script>
    function calculaterCurrentBalance(e) {
        const initial_value = {{ Auth::user()['balance'] }};
        document.getElementById("actual").textContent =
            `$${(initial_value - e.target.value).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} USD`
    }

    function calculateCurrentAmount(e) {
        document.getElementById("amount-fake").value = e.target.value * 1850
        document.getElementById("amount").value = e.target.value * 1850
        document.getElementById("concept-preview").textContent = e.target.value + " Traded Shares"
        document.getElementById("amount-calc").textContent = e.target.value + " x 1,850 = " + e.target.value * 1850;
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
                        {{ Auth::user()->role === 'admin' ? '' : 'disabled' }} list="accounts">
                    <datalist id="accounts">
                        @if (!empty($users))
                            @foreach ($users as $user)
                                <option value="{{ $user['account'] }}">{{ $user['name'] }} {{ $user['lastname'] }}
                                </option>
                            @endforeach
                        @else
                            <option value="0000">No user registered :(</option>
                        @endif
                    </datalist>
                </div>
            </div>
            <div class="vertical-input">
                <label for="amount-fake">Total</label>
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
                    <input type="number" name="amount-fake" id="amount-fake" min="0" step="0.01"
                        placeholder="Amount to be transferred" disabled {{-- {{ Auth::user()['role'] === 'admin' ? '' : 'disabled' }}  --}} required
                        {{-- oninput="calculaterCurrentBalance(event)" --}} value="0.00">
                    <span class="hint">
                        <span>Total is calculated by: </span><strong id="amount-calc">[Amount] x 1,850 =
                            [Total]</strong>
                    </span>
                </div>
                <input type="hidden" name="amount" value="0.00" id="amount">
            </div>
            @if (Auth::user()['role'] === 'admin')
                <div class="vertical-input">
                    <label for="concept">Amount</label>
                    <div class="input">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M7 9H17M7 13H17M21 20L17.6757 18.3378C17.4237 18.2118 17.2977 18.1488 17.1656 18.1044C17.0484 18.065 16.9277 18.0365 16.8052 18.0193C16.6672 18 16.5263 18 16.2446 18H6.2C5.07989 18 4.51984 18 4.09202 17.782C3.71569 17.5903 3.40973 17.2843 3.21799 16.908C3 16.4802 3 15.9201 3 14.8V7.2C3 6.07989 3 5.51984 3.21799 5.09202C3.40973 4.71569 3.71569 4.40973 4.09202 4.21799C4.51984 4 5.0799 4 6.2 4H17.8C18.9201 4 19.4802 4 19.908 4.21799C20.2843 4.40973 20.5903 4.71569 20.782 5.09202C21 5.51984 21 6.0799 21 7.2V20Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <input type="number" name="concept" id="concept" placeholder="Concept"
                            {{ Auth::user()['role'] === 'admin' ? '' : 'disabled' }}
                            oninput="calculateCurrentAmount(event)" value="0">
                        <span class="hint">
                            <span>Concept will appear as: </span><strong id="concept-preview">0 Traded Shares</strong>
                        </span>
                    </div>
                </div>
            @endif
            <div class="vertical-input">
                <label for="date">Date</label>
                <div class="input">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"
                        version="1.1" id="Capa_1" width="20px" height="20px" viewBox="0 0 610.398 610.398"
                        xml:space="preserve">
                        <g>
                            <g>
                                <path fill="currentColor" stroke="currentColor"
                                    d="M159.567,0h-15.329c-1.956,0-3.811,0.411-5.608,0.995c-8.979,2.912-15.616,12.498-15.616,23.997v10.552v27.009v14.052    c0,2.611,0.435,5.078,1.066,7.44c2.702,10.146,10.653,17.552,20.158,17.552h15.329c11.724,0,21.224-11.188,21.224-24.992V62.553    V35.544V24.992C180.791,11.188,171.291,0,159.567,0z" />
                                <path fill="currentColor" stroke="currentColor"
                                    d="M461.288,0h-15.329c-11.724,0-21.224,11.188-21.224,24.992v10.552v27.009v14.052c0,13.804,9.5,24.992,21.224,24.992    h15.329c11.724,0,21.224-11.188,21.224-24.992V62.553V35.544V24.992C482.507,11.188,473.007,0,461.288,0z" />
                                <path fill="currentColor" stroke="currentColor"
                                    d="M539.586,62.553h-37.954v14.052c0,24.327-18.102,44.117-40.349,44.117h-15.329c-22.247,0-40.349-19.79-40.349-44.117    V62.553H199.916v14.052c0,24.327-18.102,44.117-40.349,44.117h-15.329c-22.248,0-40.349-19.79-40.349-44.117V62.553H70.818    c-21.066,0-38.15,16.017-38.15,35.764v476.318c0,19.784,17.083,35.764,38.15,35.764h468.763c21.085,0,38.149-15.984,38.149-35.764    V98.322C577.735,78.575,560.671,62.553,539.586,62.553z M527.757,557.9l-446.502-0.172V173.717h446.502V557.9z" />
                                <path fill="currentColor" stroke="currentColor"
                                    d="M353.017,266.258h117.428c10.193,0,18.437-10.179,18.437-22.759s-8.248-22.759-18.437-22.759H353.017    c-10.193,0-18.437,10.179-18.437,22.759C334.58,256.074,342.823,266.258,353.017,266.258z" />
                                <path fill="currentColor" stroke="currentColor"
                                    d="M353.017,348.467h117.428c10.193,0,18.437-10.179,18.437-22.759c0-12.579-8.248-22.758-18.437-22.758H353.017    c-10.193,0-18.437,10.179-18.437,22.758C334.58,338.288,342.823,348.467,353.017,348.467z" />
                                <path fill="currentColor" stroke="currentColor"
                                    d="M353.017,430.676h117.428c10.193,0,18.437-10.18,18.437-22.759s-8.248-22.759-18.437-22.759H353.017    c-10.193,0-18.437,10.18-18.437,22.759S342.823,430.676,353.017,430.676z" />
                                <path fill="currentColor" stroke="currentColor"
                                    d="M353.017,512.89h117.428c10.193,0,18.437-10.18,18.437-22.759c0-12.58-8.248-22.759-18.437-22.759H353.017    c-10.193,0-18.437,10.179-18.437,22.759C334.58,502.71,342.823,512.89,353.017,512.89z" />
                                <path fill="currentColor" stroke="currentColor"
                                    d="M145.032,266.258H262.46c10.193,0,18.436-10.179,18.436-22.759s-8.248-22.759-18.436-22.759H145.032    c-10.194,0-18.437,10.179-18.437,22.759C126.596,256.074,134.838,266.258,145.032,266.258z" />
                                <path fill="currentColor" stroke="currentColor"
                                    d="M145.032,348.467H262.46c10.193,0,18.436-10.179,18.436-22.759c0-12.579-8.248-22.758-18.436-22.758H145.032    c-10.194,0-18.437,10.179-18.437,22.758C126.596,338.288,134.838,348.467,145.032,348.467z" />
                                <path fill="currentColor" stroke="currentColor"
                                    d="M145.032,430.676H262.46c10.193,0,18.436-10.18,18.436-22.759s-8.248-22.759-18.436-22.759H145.032    c-10.194,0-18.437,10.18-18.437,22.759S134.838,430.676,145.032,430.676z" />
                                <path fill="currentColor" stroke="currentColor"
                                    d="M145.032,512.89H262.46c10.193,0,18.436-10.18,18.436-22.759c0-12.58-8.248-22.759-18.436-22.759H145.032    c-10.194,0-18.437,10.179-18.437,22.759C126.596,502.71,134.838,512.89,145.032,512.89z" />
                            </g>
                        </g>
                    </svg>
                    @php
                        $today = date('Y-m-d');
                    @endphp

                    <input type="date" name="date" id="date" value="{{ $today }}"
                        max="{{ $today }}">
                </div>
            </div>
            <hr>
            <input type="submit" value="Transfer" {{ Auth::user()['role'] === 'admin' ? '' : 'disabled' }}>


            {{-- @if (!Auth::user()['role'] === 'admin') --}}
            {{-- <span class="alert warn">
                    Your account is inactive, you cannot make transfers at this time.
                </span> --}}
            {{-- @else --}}
            {{-- <p class="dinamic-credit">Your balance after the transfer: <span id="actual">
                        ${{ number_format(Auth::user()['balance'], 2) }} USD</span></p> --}}
            {{-- @endif --}}


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
