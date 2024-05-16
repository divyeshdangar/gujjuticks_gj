<x-layouts.dashboard-layout :metaData="$metaData">
    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">{{ $metaData['title'] }}</h4>
                    @if ($errors->any())
                        <div class="text-danger border border-danger border-4 p-3 rounded-3 mb-3">
                            <b>{{ __('dashboard.error') }}:</b>
                            <hr>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" id="formToValidate"
                        action="{{ route('dashboard.board.edit.post', ['id' => $dataDetail->id]) }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('title') text-danger @enderror">{{ __('dashboard.title') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="title"
                                            class="form-control text-dark ps-5 h-58 @error('title') border border-danger rounded-3 border-3 @enderror"
                                            value="{{ old('title', $dataDetail->title) }}"
                                            placeholder="{{ __('dashboard.title') }}" required>
                                        <i
                                            class="ri-pencil-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label
                                        class="label @error('description') text-danger @enderror">{{ __('dashboard.description') }}</label>
                                    <div class="form-group position-relative">
                                        <textarea id="description" name="description"
                                            class="form-control text-dark @error('description') border border-danger rounded-3 border-3 @enderror"
                                            placeholder="{{ __('dashboard.description') }}" cols="30" rows="7" required>{{ old('description', $dataDetail->description) }}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group d-flex gap-3">
                                    <button
                                        class="btn btn-primary py-3 px-5 fw-semibold text-white">{{ __('dashboard.save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h3 class="fs-18 mb-4 border-bottom pb-20 mb-20">Members</h3>

                    <form>
                        <div class="form-group">
                            <label class="label">Team Lead</label>
                            <div class="form-group position-relative mb-3">
                                <select class="form-select form-control text-gray-light h-58 ps-5"
                                    aria-label="Default select example">
                                    <option selected>Jordan Stevenson</option>
                                    <option value="1">Easin Arafat</option>
                                    <option value="2">Francis Frank</option>
                                </select>
                                <i
                                    class="ri-calendar-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                            </div>
                            <label class="label text-muted">Below selected members will be added.</label>
                            <div class="text-center">
                                <span class="mb-2">
                                    <img src="{{ asset('assets/images/user-7.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Jordan Stevenson">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-8.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-9.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-8.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-9.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-8.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-9.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-8.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-9.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-8.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-9.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-8.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-9.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-8.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-9.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-8.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-9.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-8.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-9.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-8.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-9.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-8.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-9.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-8.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-9.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-8.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                                </span>
                                <span>
                                    <img src="{{ asset('assets/images/user-9.jpg') }}"
                                        class="wh-48 mb-1 rounded-circle border border-2 border-color-white" alt="user"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


</x-layouts.dashboard-layout>
