<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif
    
    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">{{ __('dashboard.template') }}</h4>
                <a href="{{ route('dashboard.template.create') }}" class="border-0 btn btn-primary py-2 px-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>{{ __('dashboard.add') }} {{ __('dashboard.template') }}</span>
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
                                <th scope="col">{{ __('dashboard.image') }}</th>
                                <th scope="col">{{ __('dashboard.type') }}</th>
                                <th scope="col">{{ __('dashboard.title') }}</th>
                                <th scope="col">{{ __('dashboard.status') }}</th>
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
                                    <td>
                                        <a target="_blank" href="{{ URL::asset('/images/template/'.$data->image) }}">
                                            <img src="{{ URL::asset('/images/template/'.$data->image) }}" width="120px" class="img-thumbnail">
                                        </a>
                                    </td>
                                    <td>
                                        <span class="text-primary">{{ $data->getType() }}</span>
                                    </td>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-semibold position-relative" style="top: 1px;">
                                                {!! CommonHelper::highLight($data->title) !!}
                                            <span>
                                        </div>
                                    </td>
                                    <td>
                                        {!! $data->getStatus(true) !!}
                                    </td>
                                    <td>
                                        {{ $data->created_at->format('j F, Y') }}
                                    </td>
                                    <td>
                                        <div class="dropdown action-opt">
                                            <a class="btn bg p-1" data-bs-toggle="tooltip" data-bs-title="View Record" href="{{ route('dashboard.template.view', ['id' => $data->id]) }}">
                                                <i data-feather="eye"></i>
                                            </a>
                                            @if($data->type == 2)
                                                <a class="btn bg p-1" data-bs-toggle="tooltip" data-bs-title="Update Form Fields" href="{{ route('dashboard.template.form', ['id' => $data->id]) }}">
                                                    <i data-feather="table"></i>
                                                </a>
                                                <a class="btn bg p-1" data-bs-toggle="tooltip" data-bs-title="Generated Pages" href="{{ route('dashboard.template.generated', ['id' => $data->id]) }}">
                                                    <i data-feather="list"></i>
                                                </a>
                                            @endif
                                            <a class="btn bg p-1" data-bs-toggle="tooltip" data-bs-title="Edit Record" href="{{ route('dashboard.template.edit', ['id' => $data->id]) }}">
                                                <i data-feather="edit-3"></i>
                                            </a>
                                            <a class="btn bg p-1" data-bs-toggle="tooltip" data-bs-title="Delete Record" onclick="confirmAndDelete('{{ route('dashboard.template.delete', ['id' => $data->id]) }}')">
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