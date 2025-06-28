<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div
                        class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-sm-0">{{ __('dashboard.list') }}</h4>
                        <a href="{{ route('dashboard.image.data.create', ['id' => $dataDetail->id]) }}"
                            class="border-0 btn btn-primary py-2 px-4 text-white fs-14 fw-semibold rounded-3">
                            <span class="py-sm-1 d-block">
                                <i class="ri-add-line text-white"></i>
                                <span>{{ __('dashboard.add') }} {{ __('dashboard.image') }}
                                    {{ __('dashboard.data') }}</span>
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
                                            <input type="text" name="search"
                                                value="{{ old('search', Request::get('search')) }}"
                                                class="form-control text-dark" placeholder="Search here">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <button type="submit"
                                            class="border-0 btn btn-primary py-2 px-3 px-sm-4 text-white fs-16 rounded-3">
                                            <span class="py-sm-1 d-block">
                                                <span>{{ __('dashboard.search') }}</span>
                                            </span>
                                        </button>
                                        <a href="{{ Request::url() }}" type="reset"
                                            class="btn btn-outline-secondary hover-white py-2 px-3 px-sm-4 fs-16 rounded-3">
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
                                            <label class="form-check-label ms-2"
                                                for="flexCheckDefault">#{{ __('dashboard.id') }}</label>
                                        </th>
                                        <th scope="col">{{ __('dashboard.type') }}</th>
                                        <th scope="col">{{ __('dashboard.text') }}</th>
                                        <th scope="col">{{ __('dashboard.image') }}</th>
                                        <th scope="col">{{ __('dashboard.editable') }}</th>
                                        <th scope="col">{{ __('dashboard.date') }}</th>
                                        <th scope="col">{{ __('dashboard.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataList as $data)
                                        <tr class="@if($data->list_order < 1) rounded border border-2 my-1 border-danger @endif">
                                            <td>
                                                #{{ $data->list_order }}
                                            </td>
                                            <td class="ps-0 text-center">
                                                <span class="badge text-bg-dark">{{ strtoupper($data->type) }}</span>
                                            </td>
                                            <td class="ps-0">
                                                <span class="fw-semibold position-relative" style="top: 1px;">
                                                    {{ \Illuminate\Support\Str::limit($data->text, 40) }}
                                                <span>
                                            </td>
                                            <td>
                                                @if ($data->type == 'image')
                                                    <div class="text-center">
                                                        <a target="_blank"
                                                            href="{{ URL::asset(config('paths.images.dynamic_data') . $data->image) }}">
                                                            <img width="210px" class="bg-warning rounded p-1"
                                                                src="{{ URL::asset(config('paths.images.dynamic_data') . $data->image) }}">
                                                        </a><br>
                                                        <div class="fw-semibold fs-16 mb-0">{{ $data->width }} x
                                                            {{ $data->height }}</div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($data->is_editable == 1)
                                                    <span class="badge text-bg-primary text-white">YES</span>
                                                @else
                                                    <span class="badge text-bg-warning">NO</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $data->created_at->format('j F, Y') }}
                                            </td>
                                            <td>
                                                <div class="dropdown action-opt">
                                                    <a class="btn bg p-1"
                                                        href="{{ route('dashboard.image.data.edit', ['id' => $data->id, 'image_id' => $dataDetail->id]) }}">
                                                        <i data-feather="edit-3"></i>
                                                    </a>
                                                    <a class="btn bg p-1"
                                                        onclick="confirmAndDelete('{{ route('dashboard.image.data.delete', ['id' => $data->id, 'image_id' => $dataDetail->id]) }}')">
                                                        <i data-feather="trash-2"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (count($dataList) == 0)
                        <x-common.empty></x-common.empty>
                    @endif
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body">
                    <img src="{{ route('pages.image.detail', ['slug' => $dataDetail->slug]) }}"
                        class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
