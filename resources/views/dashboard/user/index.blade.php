<x-layouts.dashboard-layout :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">{{ $metaData['title'] }}</h4>
                <button id="Btn_Add_User" class="border-0 btn btn-primary py-2 px-4 text-white fs-14 fw-semibold rounded-3"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add User</span>
                    </span>
                </button>
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
                        <div class="col-lg-3">
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
                                <th scope="col">{{ __('dashboard.email') }}</th>
                                <th scope="col">{{ __('dashboard.image') }}</th>
                                <th scope="col">{{ __('dashboard.name') }}</th>
                                {{-- <th scope="col">{{ __('dashboard.status') }}</th> --}}
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
                                        {!! CommonHelper::highLight($data->email) !!}
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{ $data->profile }}">
                                            <img src="{{ $data->profile }}" class="wh-60 rounded-circle">
                                        </a>
                                    </td>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-semibold position-relative" style="top: 1px;">
                                                {!! CommonHelper::highLight($data->name) !!}
                                                <span>
                                        </div>
                                    </td>
                                    {{-- <td>
                                        {!! $data->status !!}
                                    </td> --}}
                                    <td>
                                        {{ $data->created_at->format('j F, Y') }}
                                    </td>
                                    <td>
                                        <div class="dropdown action-opt">
                                            <a class="btn bg p-1"
                                                href="{{ route('dashboard.user.view', ['id' => $data->id]) }}">
                                                <i data-feather="eye"></i>
                                            </a>
                                            <a class="btn bg p-1"
                                                href="{{ route('dashboard.user.edit', ['id' => $data->id]) }}">
                                                <i data-feather="edit-3"></i>
                                            </a>
                                            <a class="btn bg p-1"
                                                onclick="confirmAndDelete('{{ route('dashboard.user.delete', ['id' => $data->id]) }}')">
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
            @if (count($dataList) == 0)
                <x-common.empty></x-common.empty>
            @endif
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom p-4">
            <h5 class="offcanvas-title fs-18 mb-0" id="offcanvasRightLabel">Add User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-4">
            <form method="post" action="{{ route('dashboard.user.create') }}">
                {{ csrf_field() }}
                <div class="form-group mb-4">
                    <label class="form-check-label text-danger" for="flexCheckDefault">
                        Important Note
                    </label><br>
                    <span class="text-muted">It must be original google email address, as for now we only support google
                        login.</span>
                </div>
                <div class="form-group mb-4">
                    <label class="label">{{ __('dashboard.first_name') }}</label>
                    <div class="form-group position-relative">
                        <input type="text" name="first_name" maxlength="255" minlength="3"
                            class="form-control text-dark h-58 @error('first_name') border border-danger rounded-3 border-3 @enderror"
                            value="{{ old('first_name') }}" placeholder="{{ __('dashboard.first_name') }}" required>
                    </div>
                    @error('first_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label class="label">{{ __('dashboard.last_name') }}</label>
                    <div class="form-group position-relative">
                        <input type="text" name="last_name" maxlength="255" minlength="3"
                            class="form-control text-dark h-58 @error('last_name') border border-danger rounded-3 border-3 @enderror"
                            value="{{ old('last_name') }}" placeholder="{{ __('dashboard.last_name') }}" required>
                    </div>
                    @error('last_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label class="label">{{ __('dashboard.email') }}</label>
                    <div class="form-group position-relative">
                        <input type="email" name="email" maxlength="255"
                            class="form-control text-dark h-58 @error('email') border border-danger rounded-3 border-3 @enderror"
                            value="{{ old('email') }}" placeholder="{{ __('dashboard.email') }}" required>
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label class="label">{{ __('dashboard.password') }}</label>
                    <div class="form-group position-relative">
                        <input type="text" name="password" maxlength="255" minlength="6"
                            class="form-control text-dark h-58 @error('password') border border-danger rounded-3 border-3 @enderror"
                            placeholder="{{ __('dashboard.password') }}" required>
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group d-flex gap-3">
                    <button type="submit" class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                        <span class="py-sm-1 d-block">
                            <i class="ri-add-line text-white"></i>
                            <span>Add User</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.addEventListener('load', function(event) {

            @if ($errors->any())
                var Btn_Add_User = document.getElementById('Btn_Add_User');
                Btn_Add_User.click();
            @endif
        });
    </script>
</x-layouts.dashboard-layout>
