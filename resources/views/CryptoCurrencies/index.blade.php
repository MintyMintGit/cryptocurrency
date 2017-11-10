@extends('layouts.master')

@section('content')
    <input type="hidden" id="historicalData" value="{{ route('historicalData', $crypto['id']) }}">
    {{--<input type="hidden" id="pointStart" value="{{ $pointStart }}">--}}


    <div class="container-fluid page-content">
        <div class="container currency-details">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row top-info">
                        <div class="col-md-6 col-sm-6 col-xs-12 currency-name">
                            <img src="{{ $linkToIcon }}" class="currency-icon bitcoin" alt="icon">
                            <span class="name">{{ $crypto['name'] }}</span>
                            <span class="short">{{ $crypto['symbol'] }}</span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 buy-btn">
                            <a href="#">Buy instantly with credit card</a>
                        </div>
                    </div>
                    <div class="currency-price">
                        <span class="price">${{ number_format($crypto['price_usd']) }}<span class="gray"></span></span><span class="grow green">({{ round($crypto['percent_change_24h'], 2) }}%)</span>
                    </div>
                    <div class="row blocks">
                        <div class="item col-md-4 col-sm-4 col-xs-12">
                            <div class="wrap">
                                <h3>Market Cap</h3>
                                <span class="value">${{ number_format($crypto['market_cap_usd']) }}</span>
                            </div>
                        </div>
                        <div class="item col-md-4 col-sm-4 col-xs-12">
                            <div class="wrap">
                                <h3>Volume (24h)</h3>
                                <span class="value">${{ $crypto['volume_usd_24h'] }}</span>
                            </div>
                        </div>
                        <div class="item col-md-4 col-sm-4 col-xs-12">
                            <div class="wrap">
                                <h3>Circulating Supply</h3>
                                <span class="value">${{ number_format($crypto['available_supply']) }}</span>
                            </div>
                        </div>
                    </div>
                    @if(isset($social[0]))
                        <div class="row links">
                            <div class="col-md-3 col-sm-3 col-xs-12 explore">
                                @if (!is_null($social[0]->Website_1))
                                        <li><a href="{{ $social[0]->Website_1 or "Default Message"  }}">Explore</a></li>
                                @endif
                                    @if (!is_null($social[0]->Explorer_1))
                                        <li><a href="{{ $social[0]->Explorer_1 or "Default Message"  }}">Explore</a></li>
                                    @endif
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 website">
                                @if (!is_null($social[0]->Explorer_2))
                                    <li>
                                        <a href="{{ $social[0]->Explorer_2 or "Default Message"  }}" target="_blank">Explorer 2</a>
                                    </li>
                                @endif
                                @if (!is_null($social[0]->Explorer_3))
                                    <li>
                                        <a href="{{ $social[0]->Explorer_3 or "Default Message"  }}" target="_blank">Explorer 3</a>
                                    </li>
                                @endif
                            </div>
                            @if (!is_null($social[0]->Message_board_1))
                                <div class="col-md-3 col-sm-3 col-xs-12 message">
                                    <li><a href="{{ $social[0]->Message_board_1 or "Default Message"  }}" target="blank">Message Board</a></li>
                                </div>
                            @endif
                            @if (!is_null($social[0]->Message_board_2))
                                <div class="col-md-3 col-sm-3 col-xs-12 announcement">
                                    <li>
                                        <a href="{{ $social[0]->Message_board_2 or "Default Message"  }}" target="_blank">Announcement</a>
                                    </li>
                                </div>
                            @endif

                        </div>
                    @endif
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

            <div id="exTab2" class="container-fluid bottom-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#1" data-toggle="tab" aria-expanded="true">Charts</a>
                </li>
                @if(isset($social[0]))
                    <li class="">
                        <a href="#2" data-toggle="tab" aria-expanded="false">Social</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content ">
                <div class="tab-pane active" id="1">
                    <div id="container" style="height: 400px; min-width: 600px"></div>
                    <button id="button">Export chart</button>
                </div>
                @if(isset($social[0]))
                    <div class="tab-pane" id="2">
                            <div class="col-xs-6">
                                <a class="twitter-timeline" href="{{ $social[0]->Twitter or "Default Message"  }}"></a>
                                <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                            </div>
                            <div class="col-xs-6">
                                <div id="reddit">

                                    <script type="text/javascript"
                                            src="https://www.reddit.com/r/{{ str_replace(" ", "", $social[0]->Name) != "" ? str_replace(" ", "", $social[0]->Name) : "" }}.embed?limit=9"></script>
                                </div>
                            </div>
                    </div>
                @endif
            </div>
        </div>

    </div>

    @include('layouts.partials._menu')
@endsection