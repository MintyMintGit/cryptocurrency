@extends('layouts.master')

@section('content')

    @include('layouts.partials._navigation')


    <input type="hidden" id="GlobalDataNames" value="{{ route('GlobalDataNames') }}">
    <input type="hidden" id="bitcoinPrice" value="{{ $bitcoinPrice }}">
    <input type="hidden" id="currency" value="{{ $cc_profile[0]['profile_short'] }}">
    <input type="hidden" id="locationServ" value="{{ "http://$_SERVER[HTTP_HOST]" }}">
    <div class="exchange-pairs">
        <div class="container-fluid page-content">
            <h1>{{ $cc_profile[0]['profile_long'] }} EXCHANGE PAIRS</h1>
            <div class="table-1">
                <h3>Top-10 euro to crypto exchange pairs</h3>
                <div class="line"></div>
                <section class="exchange-pairs container">
                    <table id="topTenCrypto">
                        <thead>
                        <tr>
                            <th class="iso" scope="col">ISO</th>
                            <th class="name" scope="col">Name</th>
                            <th class="url" scope="col"><span
                                        class="desk">Custom hyper link {{ $cc_profile[0]['profile_long'] }}
                                    /URL</span><span class="mob">URL</span></th>
                            <th class="rate" scope="col">Rates</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topTenCrypto as $crypto)
                            <tr>
                                <td class="iso">{{ $crypto['symbol'] }}</td>
                                <td class="name">{{ $crypto['name'] }}</td>
                                <td class="url">
                                    <a data-from="{{ $cc_profile[0]['profile_short'] }}"
                                       data-to="{{ $crypto['symbol'] }}" class="updateLink"
                                       href="/calculator/{{ strtolower($cc_profile[0]['profile_short'])   }}-to-{{ strtolower($crypto['symbol']) }}">Convert
                                        from {{ $cc_profile[0]['profile_long'] }} to {{ $crypto['name'] }}</a>
                                </td>
                                <td class="rate">
                                    {{ 1 / $crypto['price_usd'] }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="table-2">
                <h3>Top-10 euro to crypto exchange pairs</h3>
                <div class="line"></div>
                <section class="exchange-pairs container">
                    <table id="fiat">
                        <thead>
                        <tr>
                            <th class="iso" scope="col">ISO</th>
                            <th class="name" scope="col">Name</th>
                            <th class="url" scope="col">
                                <span class="desk">Custom hyper link w/URL</span>
                                <span class="mob">URL</span>
                            </th>
                            <th class="rate" scope="col">Rates</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($moneyFiat as $fiat)
                                @if ($fiat['profile_short'] != $cc_profile[0]['profile_short'] )
                                    <tr>
                                        <td class="iso">{{ $fiat['profile_short'] }}</td>
                                        <td class="name">{{ $fiat['profile_long'] }}</td>
                                        <td class="url">
                                            <a class="desk" data-from="{{ $cc_profile[0]['profile_short'] }}"
                                               data-to="{{ $fiat['profile_short'] }}" class="updateLink"
                                               href="/calculator/{{ strtolower($cc_profile[0]['profile_short']) }}-to-{{ strtolower($fiat['profile_short']) }}">Convert
                                                from {{ $cc_profile[0]['profile_long'] }} to {{ $fiat['profile_long'] }}</a>
                                        </td>
                                        <td class="rate">
                                            @if ($fiat['value_quotes'] > 0)
                                                {{ 1 / $fiat['value_quotes'] }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>



    @include('layouts.partials._menu')
@endsection
