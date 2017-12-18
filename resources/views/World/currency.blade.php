@extends('layouts.master')

@section('content')

    @include('layouts.partials._navigation')


    <input type="hidden" id="GlobalDataNames" value="{{ route('GlobalDataNames') }}">
    <input type="hidden" id="bitcoinPrice" value="{{ $bitcoinPrice }}">
    <input type="hidden" id="currency" value="{{ $cc_profile[0]['profile_short'] }}">
    <input type="hidden" id="locationServ" value="{{ "http://$_SERVER[HTTP_HOST]" }}">
    <div class="exchange-pairs">
        <div class="container-fluid page-content">
            <h1>{{ $cc_profile[0]['profile_long'] }} EXCHANGE RATES</h1>
            <div class="table-1">
                <h3>All {{ $cc_profile[0]['profile_long'] }} to crypto exchange pairs</h3>
                <div class="line"></div>
                <section class="exchange-pairs container">
                    <table id="topTenCrypto">
                        <thead>
                        <tr>
                            <th class="iso" scope="col">ISO</th>
                            <th class="name" scope="col">Name</th>
                            <th class="url" scope="col"><span
                                        class="desk">Convert {{ $cc_profile[0]['profile_long'] }}</span><span class="mob">URL</span></th>
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
                                       href="/calculator/{{ strtolower($cc_profile[0]['profile_short'])   }}-{{ strtolower($crypto['symbol']) }}">Convert
                                        {{ $cc_profile[0]['profile_long'] }} to {{ $crypto['name'] }}</a>
                                </td>
                                <td price_usd="{{$crypto['price_usd']}}" selectedFiat="{{$selectedFiat}}" class="rate">
                                    {{ number_format((float)1 / $selectedFiat / $crypto['price_usd'], 6, '.', '') }}
{{--                                    {{ round(exp(1 / $selectedFiat / $crypto['price_usd']), 6) }}--}}
                                    {{--{{ round(exp(1 / $selectedFiat / $crypto['price_usd']), 6) }}--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="table-2">
                <h3>All {{ $cc_profile[0]['profile_long'] }} to fiat exchange pairs</h3>
                <div class="line"></div>
                <section class="exchange-pairs container">
                    <table id="fiat">
                        <thead>
                        <tr>
                            <th class="iso" scope="col">ISO</th>
                            <th class="name" scope="col">Name</th>
                            <th class="url" scope="col">
                                <span class="desk">Convert {{ $cc_profile[0]['profile_long'] }}</span>
                                <span class="mob">URL</span>
                            </th>
                            <th class="rate" scope="col">Rates</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($moneyFiat as $fiat)
                                @if($fiat['value_quotes'] > 0)
                                    @if ($fiat['profile_short'] != $cc_profile[0]['profile_short'] )
                                        <tr>
                                            <td class="iso">{{ $fiat['profile_short'] }}</td>
                                            <td class="name">{{ $fiat['profile_long'] }}</td>
                                            <td class="url">
                                                <a class="desk" data-from="{{ $cc_profile[0]['profile_short'] }}"
                                                   data-to="{{ $fiat['profile_short'] }}" class="updateLink"
                                                   href="/calculator/{{ strtolower($cc_profile[0]['profile_short']) }}-{{ strtolower($fiat['profile_short']) }}">Convert
                                                    {{ $cc_profile[0]['profile_long'] }} to {{ $fiat['profile_long'] }}</a>
                                            </td>
                                            <td data-content="{{$selectedFiat}}" value_quotes="{{$fiat['value_quotes']}}" class="rate">
                                                {{--{{ round( $fiat['value_quotes'] / $selectedFiat, 6) }}--}}
                                                {{ number_format((float) $fiat['value_quotes'] / $selectedFiat, 6, '.', '') }}
                                            </td>
                                        </tr>
                                    @endif
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
