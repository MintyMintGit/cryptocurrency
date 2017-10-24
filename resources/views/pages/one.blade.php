@extends('layouts.master')

@section('content')
    <table id="marketCapitalizations">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Market Cap</th>
            <th>Price</th>
            <th>Circulating supply</th>
            <th>Volume (24h)</th>
            <th>% Change (24h)</th>
            <th>Price Graph (7d)</th>
        </tr>
    </table>

@endsection