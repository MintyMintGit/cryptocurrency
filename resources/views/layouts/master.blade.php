<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Navbar Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    @if (isset($canonical))
        <link rel="canonical" href="{{ $canonical }}"/>
    @else
        <link rel="canonical" href="{{ $_SERVER['APP_URL'].$_SERVER['REQUEST_URI'] }}"/>
    @endif
    <!-- Custom styles for this template -->

    <link href="/css/bootstrap-select.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/font-awesome.css">
    <link href="/css/style.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="page-top" class="index">

@include('layouts.partials._header')

@yield('content')
<input type="hidden" id="ExchangeRatesLink" value="{{route('getExchangeRates')}}" >
<input type="hidden" id="saveStatistic" value="{{route('saveStatistic')}}" >
<div id="currency-exchange-rates">
</div>
@include('layouts.partials._footer')
</body>
</html>