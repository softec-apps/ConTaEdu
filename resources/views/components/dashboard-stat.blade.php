@props([
    'stat' => null,
    'value' => null,
    'route' => null
])

<div class="col-6 col-lg-3">
    <div class="app-card app-card-stat shadow-sm h-100">
        <div class="app-card-body p-3 p-lg-4">
            <h4 class="stats-type mb-1">{{ $stat }}</h4>
            <div class="stats-figure">
                @isset($value)
                    {{ $value }}
                @else
                    ...
                @endisset
            </div>
        </div>
        <!--//app-card-body-->
        <a class="app-card-link-mask" href="@isset ($route){{ $route }}@else#@endisset"></a>
    </div>
    <!--//app-card-->
</div>
<!--//col-->