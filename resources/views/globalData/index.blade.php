@extends('layouts.master')

@section('content')
    <?php
            echo "Hello World!!!";
    ?>
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
        </thead>
        <tbody>
        <?php
            foreach ($values as $value) {
                echo "<tr>{$value['rank']}</tr>";
                echo "<tr>{$value['name']}</tr>";
                echo "<tr>{$value['market_cap_usd']}</tr>";
                echo "<tr>{$value['price_usd']}</tr>";
                echo "<tr>{$value['available_supply']}</tr>";
                echo "<tr>{$value['24h_volume_usd']}</tr>";
                echo "<tr>{$value['percent_change_24h']}</tr>";
                echo "<tr></tr>";
            }
        ?>
        </tbody>
    </table>

@endsection