<x-layouts.dashboard-layout :metaData="$metaData">
    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white border-0 rounded-10 border-bottom border-2 mb-4">
                <div class="card-body p-4">
                    <div class="d-sm-flex text-center justify-content-between align-items-center">
                        <h4 class="fw-semibold fs-20 mb-sm-0"><i class="ri-clipboard-line"></i> Recent Boards</h4>
                        <a href="{{ route('dashboard.board.create') }}" class="border-0 btn btn-dark py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                            <span class="py-sm-1 d-block">
                                <i class="ri-add-line text-white"></i>
                                <span>Create New Board</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @foreach ($dataList as $data)
                <div class="card bg-white border-0 rounded-10 mb-4">
                    <div class="d-flex justify-content-between mb-4 bg-dark p-3 rounded-3">
                        <div class="">
                            <h4 class="fs-20 text-light fw-semibold mb-2">{{ $data->title }}</h4>
                            <p class="text-light">{{ $data->description }}</p>
                        </div>

                        <div class="dropdown action-opt">
                            <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="more-horizontal" style="stroke: #ccc;"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('dashboard.board.items', ['id' => $data->id]) }}">
                                        <i data-feather="eye"></i>
                                        Open Board
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard.board.edit', ['id' => $data->id]) }}">
                                        <i data-feather="edit-3"></i>
                                        Edit
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard.board.delete', ['id' => $data->id]) }}">
                                        <i data-feather="trash-2"></i>
                                        Delete
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom pb-4">
                            <div class="d-flex align-items-center mb-3 mb-sm-0">
                                <div class="flex-shrink-0">
                                    <img src="{{ $data->user->profile }}" class="wh-60 rounded-circle" alt="user">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="fs-16 fw-semibold mb-1">{{ ucwords($data->user->name) }}</h4>
                                    <span class="fs-14 text-primary">Creator</span>
                                </div>
                            </div>

                            <ul class="ps-0 mb-0 list-unstyled d-flex">

                                @foreach ($data->users as $user)
                                    <li @if ($loop->index) class="ms-8" @endif>
                                        <img src="{{ $user->user->profile }}"
                                            class="wh-38 rounded-circle border border-2 border-color-white"
                                            alt="user" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="{{ ucwords($user->user->name) }}">
                                    </li>
                                @endforeach

                                @if (count($data->users) > 3)
                                    <li class="ms-1">
                                        <a href="{{ route('dashboard.board.items', ['id' => $data->id]) }}" class="wh-38 rounded-circle bg-success bg-opacity-10 text-success text-decoration-none d-inline-block text-center position-relative">
                                            <span class="position-absolute top-50 start-50 translate-middle">+{{ count($data->users) - 3 }}</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div class="d-sm-flex align-items-center justify-content-between">
                            <div class="mb-3 mb-sm-0">
                                <span
                                    class="fs-12 mb-1 d-block fw-semibold text-gray-light">{{ $data->created_at->format('j F, Y') }}</span>
                                <span class="fw-semibold d-block">{{ __('dashboard.date') }}</span>
                            </div>
                            <div class="mb-3 mb-sm-0">
                                <span class="fs-12 mb-1 d-block fw-semibold text-gray-light">{{ $data->categories ? count($data->categories) : 0 }} Processes</span>
                                <span class="fw-semibold d-block">{{ $data->items ? count($data->items) : 0 }} Items</span>
                            </div>
                            <a href="{{ route('dashboard.board.items', ['id' => $data->id]) }}"
                                class="btn btn-primary bg-primary bg-opacity-10 text-primary border-0 py-2 px-3 mt-2 mt-sm-0">
                                View Details
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-8 mb-4">
            {{ $dataList->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>


</x-layouts.dashboard-layout>
