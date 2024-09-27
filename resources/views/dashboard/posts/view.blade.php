<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.english') }}</h4>
                    </div>
                    <a target="_blank" href="{{ URL::asset('/images/posts/' . $dataDetail->image) }}">
                        <img src="{{ URL::asset('/images/posts/' . $dataDetail->image) }}" class="img-fluid rounded-10 mb-4">
                    </a>
                    <h4 class="fs-15 fw-semibold">{{ __('dashboard.type') }}:</h4>
                    <p>{!! $dataDetail->type !!}</p>                
                    <p class="mb-4">{{ __('dashboard.day') }}: {{ $dataDetail->day }} <br>{{ __('dashboard.month') }}: {{ $dataDetail->month }} <br>{{ __('dashboard.year') }}: {{ $dataDetail->year }}</p>

                    <h4 class="fs-15 fw-semibold">{{ __('dashboard.title') }}:</h4>
                    <p class="mb-4">{!! $dataDetail->title !!}</p>
                    <h4 class="fs-15 fw-semibold">{{ __('dashboard.description') }}:</h4>
                    <p class="mb-4">{!! $dataDetail->description !!}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.gujarati') }}</h4>
                    </div>
                    <a target="_blank" href="{{ URL::asset('/images/posts/' . $dataDetail->image_g) }}">
                        <img src="{{ URL::asset('/images/posts/' . $dataDetail->image_g) }}" class="img-fluid rounded-10 mb-4">
                    </a>
                    <h4 class="fs-15 fw-semibold">{{ __('dashboard.type') }}:</h4>
                    <p>{!! $dataDetail->type_g !!}</p>                
                    <p class="mb-4">{{ __('dashboard.day') }}: {{ $dataDetail->day_g }} <br>{{ __('dashboard.month') }}: {{ $dataDetail->month_g }} <br>{{ __('dashboard.year') }}: {{ $dataDetail->year_g }}</p>

                    <h4 class="fs-15 fw-semibold">{{ __('dashboard.title') }}:</h4>
                    <p class="mb-4">{!! $dataDetail->title_g !!}</p>
                    <h4 class="fs-15 fw-semibold">{{ __('dashboard.description') }}:</h4>
                    <p class="mb-4">{!! $dataDetail->description_g !!}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.hindi') }}</h4>
                    </div>
                    <a target="_blank" href="{{ URL::asset('/images/posts/' . $dataDetail->image_h) }}">
                        <img src="{{ URL::asset('/images/posts/' . $dataDetail->image_h) }}" class="img-fluid rounded-10 mb-4">
                    </a>
                    <h4 class="fs-15 fw-semibold">{{ __('dashboard.type') }}:</h4>
                    <p>{!! $dataDetail->type_h !!}</p>                
                    <p class="mb-4">{{ __('dashboard.day') }}: {{ $dataDetail->day_h }} <br>{{ __('dashboard.month') }}: {{ $dataDetail->month_h }} <br>{{ __('dashboard.year') }}: {{ $dataDetail->year_h }}</p>

                    <h4 class="fs-15 fw-semibold">{{ __('dashboard.title') }}:</h4>
                    <p class="mb-4">{!! $dataDetail->title_h !!}</p>
                    <h4 class="fs-15 fw-semibold">{{ __('dashboard.description') }}:</h4>
                    <p class="mb-4">{!! $dataDetail->description_h !!}</p>
                </div>
            </div>
        </div>
    </div>


</x-layouts.dashboard>
