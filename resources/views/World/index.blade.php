@extends('layouts.master')

@section('content')

    <table id="money" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Name</th>
            <th>ISO</th>
            <th>Symbol</th>
            <th>Central Bank Name</th>
            <th>Central Bank Website</th>
            <th>Unit</th>
            <th>Cent</th>
            <th>Coin</th>
            <th>Bank Notes</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Name</th>
            <th>ISO</th>
            <th>Symbol</th>
            <th>Central Bank Name</th>
            <th>Central Bank Website</th>
            <th>Unit</th>
            <th>Cent</th>
            <th>Coin</th>
            <th>Bank Notes</th>
        </tr>
        </tfoot>
        <tbody>

        @foreach ($money as $value)
            <tr>
                <td><a href="{{ "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" . "/" . strtolower(str_replace(' ', '-', $value['profile_long'])) . '-exchange-rates' }}">{{ $value['profile_long'] }}</a></td>
                <td>{{ $value['profile_short'] }}</td>
                <td>{{ $value['profile_symbol'] }}</td>
                <td>{{ $value['profile_central_bank_name'] }}</td>
                <td>{{ $value['profile_central_bank_website'] }}</td>
                <td>{{ $value['profile_unit'] }}</td>
                <td>{{ $value['profile_cent'] }}</td>
                <td>{{ $value['profile_coins'] }}</td>
                <td>{{ $value['profile_banknotes'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection