{{--
  Shared error page shell.
  Expected vars: $code, $kicker, $title, $lead, $label, $chips, $wire, $logs, $statuses, $showPath (bool)
--}}
@php
    $code = (string) ($code ?? '404');
    $digits = str_split($code);
    $metaData = [
        'title' => ($title ?? 'Error') . ' | GujjuTicks',
        'description' => $lead ?? 'Something went wrong. Head back to GujjuTicks.',
        'url' => url()->current(),
        'robots' => 'noindex, follow',
    ];
    $tried = request()->path();
    $showPath = $showPath ?? false;
    $chips = $chips ?? ['ERROR', 'RETRY', 'HOME'];
    $wire = $wire ?? ['recover → home', 'services desk', 'contact link'];
    $logs = $logs ?? ['checking status…', 'preparing recovery…'];
    $statuses = $statuses ?? ['Alert', 'Retry', 'Recover'];
@endphp

<x-layouts.site :metaData="$metaData" page="error">

    <div class="er-page" data-er-page
        data-er-statuses='@json($statuses)'>
        <div class="er-ambient" aria-hidden="true">
            <div class="er-ambient__grid"></div>
            <div class="er-ambient__blob er-ambient__blob--a"></div>
            <div class="er-ambient__blob er-ambient__blob--b"></div>
            <div class="er-ambient__glow" data-er-glow></div>
            <canvas class="er-ambient__canvas" data-er-particles width="1" height="1"></canvas>
        </div>

        <section class="er-shell" aria-labelledby="er-title">
            <div class="er-copy">
                <p class="er-kicker">
                    <span class="er-kicker__dot"></span>
                    {{ $kicker }}
                </p>
                <h1 class="er-title" id="er-title">{{ $title }}</h1>
                <p class="er-lead">{{ $lead }}</p>

                @if ($showPath && $tried && $tried !== '/' && !str_starts_with($tried, 'dev/errors'))
                    <p class="er-path">
                        <span>Requested</span>
                        <code data-er-path>/{{ ltrim($tried, '/') }}</code>
                    </p>
                @endif

                <div class="er-log" data-er-log aria-hidden="true">
                    @foreach ($logs as $i => $line)
                        <p class="er-log__line{{ $i === 0 ? ' is-on' : '' }}" data-er-log-line>{{ $line }}</p>
                    @endforeach
                </div>

                <div class="er-actions">
                    <a class="er-btn er-btn--solid" href="{{ route('home') }}">Back to home</a>
                    <a class="er-btn er-btn--ghost" href="{{ route('pages.services') }}">View services</a>
                    <a class="er-btn er-btn--ghost" href="{{ route('form.contact') }}">Contact us</a>
                </div>
            </div>

            <div class="er-visual" aria-hidden="true" data-er-visual>
                <div class="er-frame">
                    <span class="er-frame__corner er-frame__corner--tl"></span>
                    <span class="er-frame__corner er-frame__corner--tr"></span>
                    <span class="er-frame__corner er-frame__corner--bl"></span>
                    <span class="er-frame__corner er-frame__corner--br"></span>

                    <div class="er-radar">
                        <span class="er-radar__sweep"></span>
                        <span class="er-radar__cross er-radar__cross--h"></span>
                        <span class="er-radar__cross er-radar__cross--v"></span>
                    </div>

                    <div class="er-signal">
                        <div class="er-signal__ring er-signal__ring--a"></div>
                        <div class="er-signal__ring er-signal__ring--b"></div>
                        <div class="er-signal__ring er-signal__ring--c"></div>

                        <span class="er-signal__arm er-signal__arm--a"><i></i></span>
                        <span class="er-signal__arm er-signal__arm--b"><i></i></span>
                        <span class="er-signal__arm er-signal__arm--c"><i></i></span>

                        <div class="er-digits" data-er-digits>
                            @foreach ($digits as $i => $digit)
                                <span class="er-digit{{ $i === 1 ? ' er-digit--mid' : '' }}"
                                    data-er-digit style="--d: {{ $i }}">{{ $digit }}</span>
                            @endforeach
                        </div>

                        <span class="er-signal__scan"></span>
                        <span class="er-signal__glitch" data-er-glitch></span>

                        <div class="er-meters">
                            <span class="er-meter"><i style="--m: 1"></i></span>
                            <span class="er-meter"><i style="--m: 2"></i></span>
                            <span class="er-meter"><i style="--m: 3"></i></span>
                        </div>
                    </div>

                    <div class="er-chips">
                        @foreach ($chips as $i => $chip)
                            <span class="er-chip" style="--i: {{ $i }}" data-er-chip>{{ $chip }}</span>
                        @endforeach
                    </div>

                    <div class="er-wire">
                        <div class="er-wire__track">
                            @foreach ([1, 2] as $copy)
                                @foreach ($wire as $item)
                                    <span>{{ $item }}</span>
                                @endforeach
                            @endforeach
                        </div>
                    </div>

                    <p class="er-signal__status" data-er-status>{{ $statuses[0] ?? 'Alert' }}</p>
                    <p class="er-coords" data-er-coords>x:00 y:00</p>
                </div>
                <p class="er-visual__label">{{ $label }}</p>
            </div>
        </section>
    </div>

</x-layouts.site>
