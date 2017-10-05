@extends('layouts.master')

@section('content')

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
            </td>
            <td>
                <div id="amount"></div>
            </td>
            <td>
                To:
            </td>
            <td>
                <input type="text" id="to">
            </td>
            <td>
                <button id="convert">Convert</button>
            </td>
        </tr>
        </tbody>
    </table>
@endsection