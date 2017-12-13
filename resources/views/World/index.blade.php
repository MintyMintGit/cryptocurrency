@extends('layouts.master')

@section('content')

    @include('layouts.partials._navigation')

<div class="world_currencies">
    <div class="container-fluid page-content">
        <h1>WORLD CURRENCIES</h1>
        <section class="world-currencies-table">
            <table id="money">
                <thead>
                <tr>
                    <th class="name" scope="col">Name</th>
                    <th class="iso" scope="col">ISO</th>
                    <th class="symbol" scope="col">Symbol</th>
                    <th class="bank-name" scope="col">Central Bank Name</th>
                    <th class="bank-site" scope="col">Central Bank Website</th>
                    <th class="unit" scope="col">Unit</th>
                    <th class="cent" scope="col">Cent</th>
                    <th class="coin" scope="col">Coin</th>
                    <th class="banknotes" scope="col">Bank Notes</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($money as $value)
                    <tr>
                        <td class="name"><a href="{{ "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" . "/" . strtolower(str_replace(' ', '-', $value['profile_long'])) . '-exchange-rates' }}">{{ $value['profile_long'] }} Exchange Rates</a></td>
                        <td class="iso">{{ $value['profile_short'] }}</td>
                        <td class="symbol">{{ $value['profile_symbol'] }}</td>
                        <td class="bank-name">{{ $value['profile_central_bank_name'] }}</td>
                        <td class="bank-site"><a href="http://{{ $value['profile_central_bank_website'] }}">{{ $value['profile_central_bank_website'] }}</a> </td>
                        <td class="unit">{{ $value['profile_unit'] }}</td>
                        <td class="cent">{{ $value['profile_cent'] }}</td>
                        <td class="coin">{{ $value['profile_coins'] }}</td>
                        <td class="banknotes">{{ $value['profile_banknotes'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>

</div>

    @include('layouts.partials._menu')
@endsection