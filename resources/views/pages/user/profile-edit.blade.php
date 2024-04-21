<x-layouts.dashboard-layout>

    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">{{ __('dashboard.profile') }}</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>{{ __('dashboard.home') }}</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">{{ __('dashboard.profile') }}</span>
            </li>
        </ul>
    </div>

    <div class="row justify-content-center">
        <div class="col-xxl-9">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">Settings</h4>
                    <ul class="ps-0 mb-4 list-unstyled d-sm-flex gap-3">
                        <li>
                            <a href="{{ route('user.profile.edit') }}" class="btn btn-primary bg-primary text-white py-2 px-3 border-0 fw-semibold w-sm-100 d-inline-block">Account</a>
                        </li>
                        <li>
                            <a href="" class="btn btn-primary bg-primary text-primary py-2 px-3 bg-opacity-10 border-0 fw-semibold w-sm-100 d-inline-block mt-2 mt-sm-0">Security</a>
                        </li>
                        <li>
                            <a href="" class="btn btn-primary bg-primary text-primary py-2 px-3 bg-opacity-10 border-0 fw-semibold w-sm-100 d-inline-block mt-2 mt-sm-0">Connections</a>
                        </li>
                    </ul>
                    <div class="border-bottom pb-3 mb-3">
                        <h4 class="fs-18 fw-semibold mb-1">Profile</h4>
                        <p class="fs-15">Update your photo and personal details here.</p>
                    </div>

                    @if ($errors->any())
                        <div class="text-danger border border-danger border-4 p-3 rounded-3 mb-3">
                            <b>Error:</b><hr>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" id="formToValidate" action="{{ route('user.profile.edit.post') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-4 p-4 bg-border-gray-light d-sm-flex justify-content-between align-items-center rounded-10">
                                    <div class="d-sm-flex align-items-center mb-3 mb-sm-0 me-lg-3">
                                        <div class="me-md-5 pe-xxl-5 mb-3 mb-sm-0">
                                            <h4 class="body-font fs-15 fw-semibold text-body">Your photo</h4>
                                            <p>This will be displayed on your profile.</p>
                                        </div>
                                        <img src="{{ auth()->user()->profile }}" class="rounded-4 wh-78 ms-3 ms-lg-0 rounded-circle" alt="product">
                                    </div>
                                    
                                    <div class="d-flex ms-sm-3 ms-md-0">
                                       <button type="button" class="btn bg-danger bg-opacity-10 text-danger fw-semibold">Delete</button>
                                       <button type="button" class="btn bg-primary bg-opacity-10 text-primary fw-semibold ms-3">Update</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label @error('first_name') text-danger @enderror">First Name</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="first_name" class="form-control text-dark ps-5 h-58 @error('first_name') border border-danger rounded-3 border-3 @enderror" value="{{ old('first_name', $dataDetail->first_name) }}" placeholder="Enter Name" readonly>
                                        <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label @error('last_name') text-danger @enderror">Last Name</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="last_name"  class="form-control text-dark ps-5 h-58 @error('last_name') border border-danger rounded-3 border-3 @enderror" value="{{ old('last_name', $dataDetail->last_name) }}" placeholder="Enter Name" readonly>
                                        <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label @error('email') text-danger @enderror">Email Address</label>
                                    <div class="form-group position-relative">
                                        <input type="email" name="email"  class="form-control text-dark ps-5 h-58 @error('email') border border-danger rounded-3 border-3 @enderror" value="{{ old('email', $dataDetail->email) }}" placeholder="Enter Email Address" readonly>
                                        <i class="ri-mail-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label @error('phone') text-danger @enderror">Phone</label>
                                    <div class="form-group position-relative">
                                        <input type="tel" id="phone" name="phone" maxlength="10" class="form-control text-dark ps-5 h-58 @error('phone') border border-danger rounded-3 border-3 @enderror" value="{{ old('phone', $dataDetail->phone) }}" placeholder="Enter Phone Number" required>
                                        <i class="ri-phone-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label @error('bio') text-danger @enderror">Bio</label>
                                    <div class="form-group position-relative">
                                        <textarea id="bio" name="bio" class="form-control ps-5 text-dark @error('bio') border border-danger rounded-3 border-3 @enderror" placeholder="Bio Data ... " cols="30" rows="5" required>{{ old('bio', $dataDetail->bio) }}</textarea>
                                        <i class="ri-information-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-2"></i>
                                    </div>
                                    @error('bio')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label @error('username') text-danger @enderror">Username</label>
                                    <div class="form-group position-relative">
                                        <input type="text" id="username" name="username" data-pristine-pattern="/[a-z]+$/i" class="form-control text-dark ps-5 h-58 @error('username') border border-danger rounded-3 border-3 @enderror" value="{{ old('username', $dataDetail->username) }}" placeholder="Enter Username" required>
                                        <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">                                        
                            <div class="col-lg-12">
                                <div class="form-group d-flex gap-3">
                                    <button class="btn btn-primary py-3 px-5 fw-semibold text-white">Save</button>
                                </div>
                            </div>
                        </div>     
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layouts.dashboard-layout>