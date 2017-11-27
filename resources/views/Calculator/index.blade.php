<input type="hidden" id="GlobalDataNames" value="{{ route('GlobalDataNames') }}">
<input type="hidden" id="bitcoinPrice" value="{{ $bitcoinPrice }}">
<link rel="stylesheet" href="css/calculator.css">


<div class="converter">

    @include("Calculator.converterTable", ['harcodedEur' => 'harcodedEur'])

    @include("Calculator.TrendingRates")

    @include("Calculator.cloudOfCurrencies")

</div>