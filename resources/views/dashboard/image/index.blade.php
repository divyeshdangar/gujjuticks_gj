<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">{{ __('dashboard.image') }}</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>{{ __('dashboard.home') }}</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">{{ __('dashboard.image') }}</span>
            </li>
        </ul>
    </div>
    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">{{ __('dashboard.image') }}</h4>
                <a href="{{ route('dashboard.image.create') }}" class="border-0 btn btn-primary py-2 px-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>{{ __('dashboard.add') }} {{ __('dashboard.image') }}</span>
                    </span>
                </a>
            </div>
            <div class="default-table-area notification-list">
                <form method="get" id="form">
                    {{-- {{ csrf_field() }} --}}
                    <div class="row mb-2">
                        <div class="col-lg-3">
                            <div class="form-group mb-2">
                                <div class="form-group">
                                    <input type="text" name="search" value="{{ old('search', Request::get("search") ) }}" class="form-control text-dark" placeholder="Search here">                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-2">
                                <button type="submit" class="border-0 btn btn-primary py-2 px-3 px-sm-4 text-white fs-16 rounded-3">
                                    <span class="py-sm-1 d-block">
                                        <span>{{ __('dashboard.search') }}</span>
                                    </span>
                                </button>
                                <a href="{{ Request::url() }}" type="reset" class="btn btn-outline-secondary hover-white py-2 px-3 px-sm-4 fs-16 rounded-3">
                                    <span class="py-sm-1 d-block">
                                        <span>{{ __('dashboard.clear') }}</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col" class="text-primary">
                                    <label class="form-check-label ms-2" for="flexCheckDefault">#{{ __('dashboard.id') }}</label>
                                </th>
                                <th scope="col">{{ __('dashboard.title') }}</th>
                                <th scope="col">{{ __('dashboard.description') }}</th>
                                <th scope="col">{{ __('dashboard.image') }}</th>
                                <th scope="col">{{ __('dashboard.date') }}</th>
                                <th scope="col">{{ __('dashboard.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataList as $data)
                                <tr>
                                    <td>
                                        #{{ $data->id }}
                                    </td>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-semibold position-relative" style="top: 1px;">
                                                {!! CommonHelper::highLight($data->title) !!}
                                            <span>
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-semibold position-relative" style="top: 1px;">
                                                {!! CommonHelper::highLight($data->meta_description) !!}
                                            <span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 lh-1">
                                                    <a target="_blank" href="{{ URL::asset('/images/dynamic/'.$data->image) }}">
                                                        <img src="{{ URL::asset('/images/dynamic/'.$data->image) }}" class="wh-44 rounded-circle">
                                                    </a>
                                                </div>
                                                <div class="flex-grow-1 ms-10">
                                                    <h4 class="fw-semibold fs-16 mb-0">{{ $data->width }} x {{ $data->height }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $data->created_at->format('j F, Y') }}
                                    </td>
                                    <td>
                                        <div class="dropdown action-opt">
                                            <a class="btn bg p-1" onclick="confirmAndDelete('{{ route('dashboard.image.copy', ['id' => $data->id]) }}', 'Copy')">
                                                <i data-feather="copy"></i>
                                            </a>
                                            <a class="btn bg p-1" href="{{ route('dashboard.image.view', ['id' => $data->id]) }}">
                                                <i data-feather="eye"></i>
                                            </a>
                                            <a class="btn bg p-1" href="{{ route('dashboard.image.edit', ['id' => $data->id]) }}">
                                                <i data-feather="edit-3"></i>
                                            </a>
                                            <a class="btn bg p-1" onclick="confirmAndDelete('{{ route('dashboard.image.delete', ['id' => $data->id]) }}')">
                                                <i data-feather="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $dataList->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</x-layouts.dashboard>