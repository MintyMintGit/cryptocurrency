@extends('layouts.master')

@section('content')


    <div class="row bottom-margin-1x">
        <div class="col-xs-6 col-sm-4 col-md-4">
            <h1 class="text-large">
                <img src="{{ $linkToIcon }}"
                     class="currency-logo-32x32" alt="Ethereum">
                <small class="bold hidden-sm hidden-md hidden-lg">({{ $crypto['symbol'] }})</small>
                {{ $crypto['name'] }}
                <small class="bold hidden-xs">({{ $crypto['symbol'] }})</small>
            </h1>
        </div>
        <div class="col-xs-6 col-sm-8 col-md-4 text-left">


            <span class="text-large" id="quote_price">{{ number_format($crypto['price_usd']) }}</span> <span
                    class="text-large  negative_change">( {{ round($crypto['percent_change_24h'], 2) }}% )</span>
            <br>
            <small class="text-gray">{{ number_format($crypto['price_btc']) }} BTC</small>
            {{--<small class="negative_change"> (0.00%)</small>--}}

        </div>

    </div>

    <div class="row bottom-margin-2x">
        <div class="col-sm-8 col-sm-push-4">

            <div class="coin-summary-item col-xs-6  col-md-3">
                <div class="coin-summary-item-header">
                    <h3>Market Cap</h3>
                </div>
                <div class="coin-summary-item-detail">
                    ${{ number_format($crypto['market_cap_usd']) }}
                    <br>
                    <span class="text-gray"> {{ number_format($crypto['market_cap_usd'] / $bitcoinPrice) }} BTC</span>
                    <br>

                </div>
            </div>

            <div class="coin-summary-item col-xs-6  col-md-3">
                <div class="coin-summary-item-header">
                    <h3>Volume (24h)</h3>
                </div>
                <div class="coin-summary-item-detail">
                    ${{ $crypto['volume_usd_24h'] }}
                    <br>
                    <span class="text-gray">{{ number_format($crypto['volume_usd_24h'] / $bitcoinPrice) }} BTC</span>

                </div>
            </div>

            <div class="vertical-spacer col-xs-12 hidden-md hidden-lg"></div>

            <div class="coin-summary-item col-xs-6  col-md-3">
                <div class="coin-summary-item-header">
                    <h3>Circulating Supply</h3>
                </div>
                <div class="coin-summary-item-detail">
                    {{ number_format($crypto['available_supply']) }} BTC
                </div>
            </div>


            <div class="clearfix visible-xs"></div>

        </div>
        <div class="col-sm-4 col-sm-pull-8">
            <ul class="list-unstyled">
                <li><span class="glyphicon glyphicon-link text-gray" title="Website"></span> <a
                            href="https://www.ethereum.org/" target="_blank">Website</a></li>

                <li><span class="glyphicon glyphicon-search text-gray" title="Explorer"></span> <a
                            href="https://live.ether.camp/" target="_blank">Explorer</a></li>
                <li><span class="glyphicon glyphicon-search text-gray" title="Explorer"></span> <a
                            href="https://etherscan.io/" target="_blank">Explorer 2</a></li>
                <li><span class="glyphicon glyphicon-search text-gray" title="Explorer"></span> <a
                            href="https://etherchain.org/" target="_blank">Explorer 3</a></li>
                <li><span class="glyphicon glyphicon-list text-gray" title="Message Board"></span> <a
                            href="https://forum.ethereum.org/" target="_blank">Message Board</a></li>

                <li><span class="glyphicon glyphicon-bullhorn text-gray" title="Announcement"></span> <a
                            href="https://bitcointalk.org/index.php?topic=428589.0" target="_blank">Announcement</a>
                </li>


                <li><span class="glyphicon glyphicon glyphicon-star text-gray" title="Rank"></span>
                    <small><span class="label label-success"> Rank 2</span></small>
                </li>


                <li><span class="glyphicon glyphicon glyphicon-tag text-gray" title="Tags"></span>

                    <small><span class="label label-warning">Mineable</span></small>

                    <small><span class="label label-warning">Coin</span></small>


                </li>

            </ul>
        </div>

    </div>


    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Charts</a></li>
        <li><a data-toggle="tab" href="#menu1">Social</a></li>
        <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <h3>HOME</h3>
            <p>Some content.</p>
        </div>
        <div id="menu1" class="tab-pane fade">
            <h3>Social</h3>
            <p>Some content in menu 1.</p>
            <div class="col-xs-6">
                <a class="twitter-timeline" href="https://twitter.com/TwitterDev/timelines/539487832448843776?ref_src=twsrc%5Etfw">National Park Tweets - Curated tweets by TwitterDev</a>
                <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <div class="col-xs-6">
                <div id="reddit">
                    <script src="https://www.reddit.com/.embed?limit=5" type="text/javascript"></script>
                </div>
            </div>
        </div>
        <div id="menu2" class="tab-pane fade">
            <h3>Menu 2</h3>
            <p>Some content in menu 2.</p>
        </div>
    </div>
@endsection