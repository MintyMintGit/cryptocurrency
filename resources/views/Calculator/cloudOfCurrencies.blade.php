<section class="currency-tags container-fluid">
    <div class="container">

@if ($CloudsOfCurrencies->count() > 0)
        @foreach($CloudsOfCurrencies as $Currenci)
            @if ($Currenci['type'] == 'crypto' )
                <a data-content="{{ $counter }}" class="{{ isset($Currenci['topPopular']) ? "topPopular":"" }} {{ isset($Currenci['lessPopular']) ? "lessPopular":"" }}" href="/crypto/{{ $Currenci['profile_long'] != "" ? strtolower(str_replace(' ', '-',$Currenci['profile_long'])) : strtolower(str_replace(' ', '-',$Currenci['id'])) }}">
                    {{ $Currenci['profile_long'] != "" ? $Currenci['profile_long'] : $Currenci['id'] }}
                </a>
            @else
                <a data-content="{{ $counter }}" class="{{ isset($Currenci['topPopular']) ? "topPopular":"" }} {{ isset($Currenci['lessPopular']) ? "lessPopular":"" }}" href="/world/{{ $Currenci['profile_long'] != "" ? strtolower(str_replace(' ', '-',$Currenci['profile_long'])) : strtolower(str_replace(' ', '-',$Currenci['id'])) }}-exchange-rates">
                    {{ $Currenci['profile_long'] != "" ? $Currenci['profile_long'] : $Currenci['id'] }}
                </a>
            @endif
        @endforeach

@endif

    </div>
</section>