@extends('layouts.master')

@section('content')

    <input type="hidden" id="GlobalDataNames" value="{{ route('GlobalDataNames') }}">
    <input type="hidden" id="bitcoinPrice" value="{{ $bitcoinPrice }}">
    <input type="hidden" id="currency" value="{{ $cc_profile[0]['profile_short'] }}">
    <input type="hidden" id="locationServ" value="{{ "http://$_SERVER[HTTP_HOST]" }}">
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


    <h1>
        {{ $cc_profile[0]['profile_short'] }} - {{ $cc_profile[0]['profile_long'] }}
    </h1>

    <table id="topTenCrypto">
        <thead>
        <tr>
            <th>ISO</th>
            <th>Name</th>
            <th>Custom hyper link w/URL</th>
            <th>Rates</th>
        </tr>
        </thead>
        <tbody>
        @foreach($topTenCrypto as $crypto)
            <tr>
                <td>{{ $crypto['symbol'] }}</td>
                <td>{{ $crypto['name'] }}</td>
                <td>
                    <a data-from="{{ $cc_profile[0]['profile_short'] }}" data-to="{{ $crypto['symbol'] }}" class="updateLink" href="/calculator/{{ $cc_profile[0]['profile_short'] }}-to-{{ $crypto['symbol'] }}">Convert
                        from {{ $cc_profile[0]['profile_long'] }} to {{ $crypto['name'] }}</a>
                </td>
                <td>
                    {{ 1 / $crypto['price_usd'] }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>



    <table id="fiat">
        <thead>
        <tr>
            <th>ISO</th>
            <th>Name</th>
            <th>Custom hyper link w/URL</th>
            <th>Rates</th>
        </tr>
        </thead>
        <tbody>
        @foreach($moneyFiat as $fiat)
            <tr>
                <td>{{ $fiat['profile_short'] }}</td>
                <td>{{ $fiat['profile_long'] }}</td>
                <td>
                    <a data-from="{{ $cc_profile[0]['profile_short'] }}" data-to="{{ $fiat['profile_short'] }}" class="updateLink" href="/calculator/{{ $cc_profile[0]['profile_short'] }}-to-{{ $fiat['profile_short'] }}">Convert
                        from {{ $cc_profile[0]['profile_long'] }} to {{ $fiat['profile_long'] }}</a>
                </td>
                <td>
                    @if ($fiat['value_quotes'] > 0)
                        {{ 1 / $fiat['value_quotes'] }}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div id="content">
        <div class="currency currency-page">

            <div class="short-desc">
                <p>The currency used by the {{ $cc_profile[0]['profile_country'] }} is known as
                    the {{ $cc_profile[0]['profile_long'] }},
                    which is also written out in full as
                    the {{ $cc_profile[0]['profile_country'] }} {{ $cc_profile[0]['profile_long'] }} and popular
                    <a href="/converter/1CAD-{{ $cc_profile[0]['profile_short'] }}">exchange rate is CAD
                        to {{ $cc_profile[0]['profile_short'] }}</a>.
                    The currency symbol for the {{ $cc_profile[0]['profile_long'] }}
                    is {{ $cc_profile[0]['profile_symbol'] }}, while the currency code
                    is {{ $cc_profile[0]['profile_short'] }}.
                    You might see either of these listed in any exchange rate.
                    You can find the most up-to-date {{ $cc_profile[0]['profile_long'] }} rates as well as a convenient
                    currency converter above.
                </p>
            </div>
            <div class="top-rates">
                <h2>Top {{ $cc_profile[0]['profile_short'] }} Cross Rates</h2>
                <table class="tbl_rate" id="crossRatesTable" width="100%">
                    <tbody>
                    <tr class="rate_lines">
                        <td></td>
                        <th>
                            <div class="flag"><img width="45" src="/img/flags/EUR.png"></div>
                            <p>EUR</p></th>
                        <th>
                            <div class="flag"><img width="45" src="/img/flags/GBP.png"></div>
                            <p>GBP</p></th>
                        <th>
                            <div class="flag"><img width="45" src="/img/flags/CAD.png"></div>
                            <p>CAD</p></th>
                        <th>
                            <div class="flag"><img width="45" src="/img/flags/CHF.png"></div>
                            <p>CHF</p></th>
                        <th>
                            <div class="flag"><img width="45" src="/img/flags/AUD.png"></div>
                            <p>AUD</p></th>
                        <th>
                            <div class="flag"><img width="45" src="/img/flags/CNY.png"></div>
                            <p>CNY</p></th>
                        <th>
                            <div class="flag"><img width="45" src="/img/flags/JPY.png"></div>
                            <p>JPY</p></th>
                    </tr>
                    <tr class="rate_lines1">
                        <td>
                            <b>1 {{ $cc_profile[0]['profile_short'] }}</b>
                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr class="rate_lines2">
                        <td>Inverse:</td>
                        <td>

                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="desc">
                <h2>Description</h2>
                <ul class="description">
                    <li><b>Short:</b> {{ $cc_profile[0]['profile_long'] }}</li>
                    <li><b>Long:</b> {{ $cc_profile[0]['profile_long'] }}</li>
                    <li><b>Country:</b> {{ $cc_profile[0]['profile_country'] }} </li>
                    <li><b>Symbol:</b> {{ $cc_profile[0]['profile_symbol'] }} </li>
                    <li><b>Central Bank Rate:</b> {{ $cc_profile[0]['profile_central_bank_rate'] }} </li>
                    <li><b>Central Bank Name:</b> {{ $cc_profile[0]['profile_central_bank_name'] }} </li>
                    <li><b>Central Bank Website:</b> <a href="{{ $cc_profile[0]['profile_central_bank_website'] }}"
                                                        target="_blank">{{ $cc_profile[0]['profile_central_bank_website'] }}</a>
                    </li>
                    <li><b>Unit:</b> {{ $cc_profile[0]['profile_unit'] }}</li>
                    <li><b>Cent:</b> {{ $cc_profile[0]['profile_cent'] }}</li>
                    <li><b>Coins:</b> {{ $cc_profile[0]['profile_coins'] }}</li>
                    <li><b>Banknotes:</b> {{ $cc_profile[0]['profile_banknotes'] }}</li>
                </ul>
            </div>
            <div class="extra-desc">
                {!! $cc_profile[0]['profile_desc_extra'] !!}
            </div><!--end extra-desc -->
        </div>
    </div>


@endsection
