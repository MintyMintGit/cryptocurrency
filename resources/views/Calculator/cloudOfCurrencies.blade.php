@if ($CloudsOfCurrencies->count() > 0)
    <table>
        <?php $counter = 0; ?>
        <tr>
            @foreach($CloudsOfCurrencies as $Currenci)

                @if(($counter % 6) == 0)
        </tr>
        <tr>
            @endif

            <td data-content="{{ $counter }}" class="{{ isset($Currenci['topPopular']) ? "topPopular":"" }}">

                @if ($Currenci['type'] == 'crypto' )
                    <a href="/crypto/{{ $Currenci['profile_long'] != "" ? strtolower(str_replace(' ', '-',$Currenci['profile_long'])) : strtolower(str_replace(' ', '-',$Currenci['id'])) }}">
                        {{ $Currenci['profile_long'] != "" ? $Currenci['profile_long'] : $Currenci['id'] }}
                    </a>
                @else
                    <a href="/world/{{ $Currenci['profile_long'] != "" ? strtolower(str_replace(' ', '-',$Currenci['profile_long'])) : strtolower(str_replace(' ', '-',$Currenci['id'])) }}-exchange-rates">
                        {{ $Currenci['profile_long'] != "" ? $Currenci['profile_long'] : $Currenci['id'] }}
                    </a>
                @endif
            </td>
            <?php $counter++ ?>
            @endforeach
        </tr>
    </table>

@endif