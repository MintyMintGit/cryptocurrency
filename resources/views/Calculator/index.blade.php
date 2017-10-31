<input type="hidden" id="GlobalDataNames" value="{{ route('GlobalDataNames') }}">
<input type="hidden" id="bitcoinPrice" value="{{ $bitcoinPrice }}">
<link rel="stylesheet" href="css/calculator.css">


<div class="converter">
    <div class="container-fluid nav-page">
        <a id="tab1" href="" class="currency-converner-head-btn"><i class="fa fa-calculator" aria-hidden="true"></i>< Back to List</a>
    </div>
    @include("Calculator.converterTable")

    @include("Calculator.TrendingRates")

    @include("Calculator.cloudOfCurrencies")

</div>