@include('partials.head', ['title' => 'Dashboard - ' . Auth::user()['name']])
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(
            () => {
                console.log("Account number copied")
            },
            (e) => {
                console.error("somthing went wrong")
                console.error(e)
            },
        );
    }
    async function obtenerTasaDeCambio(moneda) {
        const response = await fetch(`http://api.nbp.pl/api/exchangerates/rates/a/${moneda}/`);
        const data = await response.json();
        return data;
    }

    function calcularReglaDeTres(valor1, cantidad1, valor2) {
        return (cantidad1 * valor2) / valor1;
    }

    async function letsDoIt() {

        const [usdData, cadData, mxnData] = await Promise.all([
            obtenerTasaDeCambio('usd'),
            obtenerTasaDeCambio('cad'),
            obtenerTasaDeCambio('mxn')
        ]);


        const usdmxn = calcularReglaDeTres(usdData.rates[0].mid, 1, mxnData.rates[0].mid);
        const mxnusd = calcularReglaDeTres(mxnData.rates[0].mid, 1, usdData.rates[0].mid);

        const usdcad = calcularReglaDeTres(usdData.rates[0].mid, 1, cadData.rates[0].mid);
        const cadusd = calcularReglaDeTres(cadData.rates[0].mid, 1, usdData.rates[0].mid);

        const cadmxn = calcularReglaDeTres(cadData.rates[0].mid, 1, mxnData.rates[0].mid);
        const mxncad = calcularReglaDeTres(mxnData.rates[0].mid, 1, cadData.rates[0].mid);

        document.getElementById('usdmxn').textContent = `$${usdmxn.toFixed(2)} USD`;
        document.getElementById('mxnusd').textContent = `$${mxnusd.toFixed(2)} MXN`;
        document.getElementById('usdcad').textContent = `$${usdcad.toFixed(2)} USD`;
        document.getElementById('cadusd').textContent = `$${cadusd.toFixed(2)} CAD`;
        document.getElementById('cadmxn').textContent = `$${cadmxn.toFixed(2)} CAD`;
        document.getElementById('mxncad').textContent = `$${mxncad.toFixed(2)} MXN`;
    }

    letsDoIt()
</script>

<style>
    table tbody td {
        font-size: 12px;
        width: 100px;
        font-weight: bold;
        aspect-ratio: 1/1;
    }
</style>

<body>
    @include('partials.nav')
    <main style="margin-left: 224px">
        <div class="main-container">
            <div class="greeting">
                <h2>Welcome back, <strong>{{ explode(' ', Auth::user()['name'])[0] }}</strong>.</h2>
            </div>
            <h1>Your's account information.</h1>
            <div class="balance">
                <h2>Your current balance</h2>
                <p>${{ number_format(Auth::user()['balance'], 2) }} USD</p>
            </div>
            <div class="two-segment">

                <div class="info">
                    <h2>Your Information</h2>
                    <hr>
                    <div class="account">
                        <span>Account status</span>
                        <p class="{{ Auth::user()['isActive'] ? 'active' : 'inactive' }}">
                            {{ Auth::user()['isActive'] ? 'Active' : 'Inactive' }}</p>
                    </div>
                    <hr>
                    <div class="info-seg">
                        <span>Account type</span>
                        <p>{{Auth::user()['role'] === 'client' ? 'Standard' : 'Admin'}}</p>
                    </div>
                    <div class="info-seg">
                        <span>Account number</span>
                        <p>{{ implode('-', str_split(Auth::user()['account'], 5)) }} <button
                                onclick="copyToClipboard('{{ Auth::user()['account'] }}')"><i
                                    class="fa-regular fa-copy"></i></button></p>
                    </div>
                    <div class="info-seg">
                        <span>Full name</span>
                        <p>{{ Auth::user()['name'] }} {{ Auth::user()['lastname'] }}</p>
                    </div>
                    <div class="info-seg">
                        <span>Email</span>
                        <p>{{ Auth::user()['email'] }}</p>
                    </div>
                </div>
                <hr>
                <table>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>USD</td>
                            <td>CAD</td>
                            <td>MXN</td>
                        </tr>
                        <tr>
                            <td>USD</td>
                            <td>$1.00 USD</td>
                            <td id="usdcad">...</td>
                            <td id="usdmxn">...</td>
                        </tr>
                        <tr>
                            <td>CAD</td>
                            <td id="cadusd">...</td>
                            <td>$1.00 CAD</td>
                            <td id="cadmxn">...</td>
                        </tr>
                        <tr>
                            <td>MXN</td>
                            <td id="mxnusd">...</td>
                            <td id="mxncad">...</td>
                            <td>$1.00 MXN</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</body>
