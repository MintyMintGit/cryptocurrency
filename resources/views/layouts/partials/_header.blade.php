<!-- Static navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <input type="hidden" id="searchIn" value="{{ route('searchIn', '') }}">
        <div style="float: right">
            <input type="text" id="search" style="text-transform: uppercase;">
            <ul id="listSearch" style="    position: absolute;    z-index: 100;   background-color: red;">
                @isset($exchange_pairs)
                    @foreach ($exchange_pairs as $exchange_pair)
                        <li
                                exchange2="{{ $exchange2 or '' }}"
                                exchange1="{{ $exchange1 or '' }}"
                                data-content="{{ $exchange_pair['profile_long'] }}"
                                class="{{ $exchange_pair['type'] }}"
                                data-usd="{{ $exchange_pair['price_usd'] }}"
                        >
                            {{ $exchange_pair['id'] }}
                        {{ strlen($exchange_pair['profile_long']) > 0 ? "-" : "" }}
                            {{ $exchange_pair['profile_long'] or '' }}
                        </li>
                    @endforeach
                @endisset
            </ul>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>
                <li><a href="../navbar-static-top/">Static top</a></li>
                <li><a href="../navbar-fixed-top/">Fixed top</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
