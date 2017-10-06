@extends('layouts.master')

@section('content')
    <input type="hidden" id="GlobalDataNames" value="{{ route('GlobalDataNames') }}">
    <link rel="stylesheet" href="css/calculator.css">
    <h1>Enter Currency Amount</h1>
    <table>
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
            <td>
                <button id="convert">Convert</button>
            </td>
        </tr>
        </tbody>
    </table>
@endsection