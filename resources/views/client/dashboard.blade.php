@include('partials.head', ['title' => 'Dashboard'])
{{-- <script>
    function copy_text_to_clipboard(text) {
        navigator.clipboard.writeText(text).then(
            () => {
                console.log("Account number copied")
            },
            (e) => {
                console.error("Somehing went wrong")
                console.error(e)
            },
        );
    }
    async function get_exchange_value_of(coin) {
        const response = await fetch(`http://api.nbp.pl/api/exchangerates/rates/a/${coin}/`);
        const data = await response.json();
        return data;
    }

    function relative_value_calculation(first_value, amount, second_value) {
        return (amount * second_value) / first_value;
    }

    async function calculate_current_exhange() {

        const [usdData, cadData, mxnData] = await Promise.all([
            get_exchange_value_of('usd'),
            get_exchange_value_of('cad'),
            get_exchange_value_of('mxn')
        ]);


        const usdmxn = relative_value_calculation(usdData.rates[0].mid, 1, mxnData.rates[0].mid);
        const mxnusd = relative_value_calculation(mxnData.rates[0].mid, 1, usdData.rates[0].mid);

        const usdcad = relative_value_calculation(usdData.rates[0].mid, 1, cadData.rates[0].mid);
        const cadusd = relative_value_calculation(cadData.rates[0].mid, 1, usdData.rates[0].mid);

        const cadmxn = relative_value_calculation(cadData.rates[0].mid, 1, mxnData.rates[0].mid);
        const mxncad = relative_value_calculation(mxnData.rates[0].mid, 1, cadData.rates[0].mid);

        document.getElementById('usdmxn').textContent = `$${usdmxn.toFixed(2)} USD`;
        document.getElementById('mxnusd').textContent = `$${mxnusd.toFixed(2)} MXN`;
        document.getElementById('usdcad').textContent = `$${usdcad.toFixed(2)} USD`;
        document.getElementById('cadusd').textContent = `$${cadusd.toFixed(2)} CAD`;
        document.getElementById('cadmxn').textContent = `$${cadmxn.toFixed(2)} CAD`;
        document.getElementById('mxncad').textContent = `$${mxncad.toFixed(2)} MXN`;
    }

    calculate_current_exhange()
</script> --}}

{{-- <style>
    table tbody td {
        font-size: 12px;
        width: 100px;
        font-weight: bold;
        aspect-ratio: 1/1;
    }
</style> --}}

<body>
    @include('partials.nav')
    <main class="dash">
        <div class="main-container">

            <h1
                style="margin-left: 48px;
        margin-top: 20px;
        font-weight: 300;
        color: #4d4d4d;
        padding:0">
                Dashboard</h1>

            <p style="
            margin-left: 48px;
    margin-top: -1px;
    font-weight: 300;
    color: #9f9f9f;">
                Corporate & Investment Banking
            </p>

            <div class="two-segment">

                <div class="info">
                    <h2
                        style="    font-weight: 300;
                    color: #606060;
                    font-size: 23px;
                    max-width:300px">
                        How are you doing {{ explode(' ', Auth::user()['name'])[0] }}
                        {{ explode(' ', Auth::user()['lastname'])[0] }}?</h2>
                    <p
                        style="font-size: 17px;
                    font-weight: 300;
                    color: gray;
                    margin-top: 10px;">
                        Enjoy your new digital experience</p>

                    <div class="info-seg"
                        style="display: flex;
    column-gap: 10px;
    background: #eeeeee;
    padding: 11px 11px;
    color: gray;
    border-radius: 9px;
    border: 1px solid #d9d9d9;
    font-weight: 300;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="acorn-icons acorn-icons-user undefined">
                            <path
                                d="M10.0179 8C10.9661 8 11.4402 8 11.8802 7.76629C12.1434 7.62648 12.4736 7.32023 12.6328 7.06826C12.8989 6.64708 12.9256 6.29324 12.9789 5.58557C13.0082 5.19763 13.0071 4.81594 12.9751 4.42106C12.9175 3.70801 12.8887 3.35148 12.6289 2.93726C12.4653 2.67644 12.1305 2.36765 11.8573 2.2256C11.4235 2 10.9533 2 10.0129 2V2C9.03627 2 8.54794 2 8.1082 2.23338C7.82774 2.38223 7.49696 2.6954 7.33302 2.96731C7.07596 3.39365 7.05506 3.77571 7.01326 4.53982C6.99635 4.84898 6.99567 5.15116 7.01092 5.45586C7.04931 6.22283 7.06851 6.60631 7.33198 7.03942C7.4922 7.30281 7.8169 7.61166 8.08797 7.75851C8.53371 8 9.02845 8 10.0179 8V8Z">
                            </path>
                            <path
                                d="M16.5 17.5L16.583 16.6152C16.7267 15.082 16.7986 14.3154 16.2254 13.2504C16.0456 12.9164 15.5292 12.2901 15.2356 12.0499C14.2994 11.2842 13.7598 11.231 12.6805 11.1245C11.9049 11.048 11.0142 11 10 11C8.98584 11 8.09511 11.048 7.31945 11.1245C6.24021 11.231 5.70059 11.2842 4.76443 12.0499C4.47077 12.2901 3.95441 12.9164 3.77462 13.2504C3.20144 14.3154 3.27331 15.082 3.41705 16.6152L3.5 17.5">
                            </path>
                        </svg>
                        <p>{{ Auth::user()['name'] }} {{ Auth::user()['lastname'] }}</p>
                    </div>


                    <div class="info-seg"
                        style="display: flex;
    column-gap: 10px;
    background: #eeeeee;
    padding: 11px 11px;
    color: gray;
    border-radius: 9px;
    border: 1px solid #d9d9d9;
    font-weight: 300;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="acorn-icons acorn-icons-lock-on undefined">
                            <path
                                d="M5 12.6667C5 12.0467 5 11.7367 5.06815 11.4824C5.25308 10.7922 5.79218 10.2531 6.48236 10.0681C6.73669 10 7.04669 10 7.66667 10H12.3333C12.9533 10 13.2633 10 13.5176 10.0681C14.2078 10.2531 14.7469 10.7922 14.9319 11.4824C15 11.7367 15 12.0467 15 12.6667V13C15 13.9293 15 14.394 14.9231 14.7804C14.6075 16.3671 13.3671 17.6075 11.7804 17.9231C11.394 18 10.9293 18 10 18V18C9.07069 18 8.60603 18 8.21964 17.9231C6.63288 17.6075 5.39249 16.3671 5.07686 14.7804C5 14.394 5 13.9293 5 13V12.6667Z">
                            </path>
                            <path d="M11 15H10 9M13 10V5C13 3.34315 11.6569 2 10 2V2C8.34315 2 7 3.34315 7 5V10"></path>
                        </svg>
                        <p>{{ Auth::user()['role'] === 'client' ? 'Temporary Holdings Account' : 'Admin' }}</p>
                    </div>

                    <div class="info-seg"
                        style="display: flex;
    column-gap: 10px;
    background: #eeeeee;
    padding: 11px 11px;
    color: gray;
    border-radius: 9px;
    border: 1px solid #d9d9d9;
    font-weight: 300;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="acorn-icons acorn-icons-link undefined">
                            <path
                                d="M7 6.00003 6.00001 6.00002C5.07004 6.00002 4.60506 6.00001 4.22356 6.10223 3.18828 6.37963 2.37962 7.18828 2.10222 8.22356 2 8.60506 2 9.07004 2 10V10C2 10.93 2 11.395 2.10222 11.7764 2.37962 12.8117 3.18827 13.6204 4.22355 13.8978 4.60505 14 5.07003 14 5.99999 14H7M13 6.00003 14 6.00002C14.93 6.00002 15.3949 6.00001 15.7764 6.10223 16.8117 6.37963 17.6204 7.18828 17.8978 8.22356 18 8.60506 18 9.07004 18 10V10C18 10.93 18 11.395 17.8978 11.7764 17.6204 12.8117 16.8117 13.6204 15.7764 13.8978 15.395 14 14.93 14 14 14H13M7 10H13">
                            </path>
                        </svg>
                        <p>{{ str_repeat('*', 6) . substr(Auth::user()['account'], -4) }}
                        </p>
                    </div>


                    <div class="info-seg"
                        style="display: flex;
    column-gap: 10px;
    background: #eeeeee;
    padding: 11px 11px;
    color: gray;
    border-radius: 9px;
    border: 1px solid #d9d9d9;
    font-weight: 300;">
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
                        <p>
                            @if (Auth::user()['role'] !== 'admin')
                                ${{ number_format(Auth::user()['balance'], 2) }} USD
                            @else
                                Infinity
                            @endif
                        </p>
                    </div>

                    <div>
                        <p class="{{ Auth::user()['isActive'] ? 'active' : 'inactive' }}"
                            style="     background-color: {{ Auth::user()['isActive'] ? '#1aebb1' : '#ebb71a' }};
                                        width: fit-content;
                                        padding: 10px 49px;
                                        border-radius: 9px;
                                        color: white;
                                        font-weight: 300;
                                        ">
                            Account {{ Auth::user()['isActive'] ? 'Active' : 'Inactive' }}</p>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>
