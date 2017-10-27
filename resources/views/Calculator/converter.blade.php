@extends('layouts.master')

@section('content')
<div class="converter">
    <input type="hidden" id="GlobalDataNames" value="{{ route('GlobalDataNames') }}">
    <input type="hidden" id="bitcoinPrice" value="{{ $bitcoinPrice }}">

    <div class="container-fluid nav-page">
        <a href="{{ route('startPage') }}" class="currency-converner-head-btn"><i class="fa fa-calculator" aria-hidden="true"></i>&lt; Back to List</a>
    </div>
    @include("Calculator.converterTable")

    @include("Calculator.TrendingRates")


    @include("Calculator.cloudOfCurrencies")

    @include('layouts.partials._menu')

</div>

@endsection