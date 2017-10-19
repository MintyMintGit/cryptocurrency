<input type="hidden" id="GlobalDataNames" value="{{ route('GlobalDataNames') }}">
<input type="hidden" id="bitcoinPrice" value="{{ $bitcoinPrice }}">
<link rel="stylesheet" href="css/calculator.css">

@include("Calculator.cloudOfCurrencies")

<h1>Enter Currency Amount</h1>
<table id="converterTable">
    <tbody>
    <tr>
        <td>
            <input type="number" id="amount">
        </td>
        <td>
            From:
        </td>
        <td>
            <input type="text" id="from">
            <ul id="fromAuto" class="autocomplete">
            </ul>
        </td>
        <td>
            <div id="inversion">Inversion</div>
        </td>
        <td>
            To:
        </td>
        <td>
            <input type="text" id="to">
            <ul id="toAuto" class="autocomplete">
            </ul>
        </td>
        <td id="result">
        </td>
    </tr>
    </tbody>
</table>

@include("Calculator.TrendingRates")

{{--<h1>Cross Rates</h1>--}}
<table width="100%" id="crossRatesTable">
    <thead>
    <tr>
        <th></th>
        <th>
            <img src="/img/flags/USD.png">
            <p>USD</p>
        </th>
        <th>
            <img src="/img/flags/EUR.png">
            <p>EUR</p>
        </th>
        <th>
            <img src="/img/flags/GBP.png">
            <p>GBP</p>
        </th>
        <th>
            <img src="/img/flags/CAD.png">
            <p>CAD</p>
        </th>
        <th>
            <img src="/img/flags/CHF.png">
            <p>CHF</p>
        </th>
        <th>
            <img src="/img/flags/AUD.png">
            <p>AUD</p>
        </th>
        <th>
            <img src="/img/flags/INR.png">
            <p>INR</p>
        </th>
        <th>
            <img src="/img/flags/CNY.png">
            <p>CNY</p>
        </th>
        <th>
            <img src="/img/flags/JPY.png">
            <p>JPY</p>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <b>1 USD</b>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>
            <b>Inverse</b>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>
            <b>1 EUR</b>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>
            <b>Inverse</b>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>
            <b>1 GBP</b>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>
            <b>Inverse</b>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>
            <b>1 BTC</b>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>
            <b>Inverse</b>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>
