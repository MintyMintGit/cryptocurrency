<input type="hidden" id="searchIn" value="{{ route('searchIn', '') }}">
<input type="hidden" id="getFullListSearch" value="{{ route('getFullListSearch') }}">
<header class="header container-fluid">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 logo-col">
            <a href="{{ route('startPage') }}">
                <div class="head-logo">Crypto Converter</div>
            </a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 search-col">
            <button type="button" class="navbar-toggle nav-btn" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="true" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <form id="searchform">
                <input id="search_input" type="search" name="search" autocomplete="off">
                <label for="search_input"></label>
                <div class="search-dpopdown-list">
                    <div class="currency-block">
                        <ul id="listSearch">
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
</header>