@extends('layouts.master')

@section('content')
    <ul id="hardcoded">
        <li>USD</li>
        <li>EUR</li>
        <li>GBP</li>
        <li>CAD</li>
        <li>AUD</li>
        <li>BTC</li>
        <li>ETH</li>
        <li>XRP</li>
        <li>BCH</li>
        <li>LTC</li>
    </ul>
    <h1>Enter Currency Amount</h1>
    <table>
        <tbody>
        <tr>
            <td>
                <input type="text" id="count">
            </td>
            <td>
                From:
            </td>
            <td>
                <input type="text" id="from">
                <ul id="autoFrom" class="autocomplete">

                </ul>
            </td>
            <td>
                <div id="amount"></div>
            </td>
            <td>
                To:
            </td>
            <td>
                <input type="text" id="to">
                <ul id="autoTo" class="autocomplete">

                </ul>
            </td>
            <td>
                <button id="convert">Convert</button>
            </td>
        </tr>
        </tbody>
    </table>
@endsection