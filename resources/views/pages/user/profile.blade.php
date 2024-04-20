<x-layouts.dashboard-layout>

    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">{{ __('dashboard.notification') }}</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>{{ __('dashboard.home') }}</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">{{ __('dashboard.notification') }}</span>
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

                    <form method="post" action="{{ route('user.profile.edit.post') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label @error('first_name') text-danger @enderror">First Name</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="first_name" class="form-control text-dark ps-5 h-58 @error('first_name') border border-danger rounded-3 border-3 @enderror" value="{{ old('first_name') }}" placeholder="Enter Name">
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
                                        <input type="text" name="last_name"  class="form-control text-dark ps-5 h-58 @error('last_name') border border-danger rounded-3 border-3 @enderror" value="{{ old('last_name') }}" placeholder="Enter Name">
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
                                        <input type="email" name="email"  class="form-control text-dark ps-5 h-58 @error('email') border border-danger rounded-3 border-3 @enderror" value="{{ old('email') }}" placeholder="Enter Email Address">
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
                                        <input type="text" name="phone"  class="form-control text-dark ps-5 h-58 @error('phone') border border-danger rounded-3 border-3 @enderror" value="{{ old('phone') }}" placeholder="Enter Phone Number">
                                        <i class="ri-phone-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Date Of Birth</label>
                                    <div class="form-group position-relative">
                                        <input type="date" class="form-control text-dark ps-5 h-58 text-gray-light">
                                        <i class="ri-calendar-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Gender</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" aria-label="Default select example">
                                            <option selected class="text-dark">Male</option>
                                            <option value="1" class="text-dark">Female</option>
                                            <option value="2" class="text-dark">Others</option>
                                        </select>
                                        <i class="ri-men-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Country</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" aria-label="Default select example">
                                            <option selected class="text-dark">United Kingdom</option>
                                            <option value="1" class="text-dark">United States</option>
                                            <option value="2" class="text-dark">Canada</option>
                                            <option value="3" class="text-dark">France</option>
                                        </select>
                                        <i class="ri-map-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">State</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" aria-label="Default select example">
                                            <option selected class="text-dark">South poal evenue state 4C</option>
                                            <option value="1" class="text-dark">United States</option>
                                            <option value="2" class="text-dark">Canada</option>
                                            <option value="3" class="text-dark">France</option>
                                        </select>
                                        <i class="ri-font-size position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Town/City</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" aria-label="Default select example">
                                            <option selected class="text-dark">California</option>
                                            <option value="1" class="text-dark">United States</option>
                                            <option value="2" class="text-dark">Canada</option>
                                            <option value="3" class="text-dark">France</option>
                                        </select>
                                        <i class="ri-list-ordered position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Zip Code</label>
                                    <div class="form-group position-relative">
                                        <input type="number" class="form-control ps-5 text-gray-light h-58" placeholder="Enter number">
                                        <i class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label">Bio Data :</label>
                                    <div class="form-group position-relative">
                                        <textarea class="form-control ps-5 text-dark" placeholder="Bio Data ... " cols="30" rows="5"></textarea>
                                        <i class="ri-information-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-2"></i>
                                    </div>
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