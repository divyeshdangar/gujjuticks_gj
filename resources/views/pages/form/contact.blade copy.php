<x-layouts.simple-layout :showHeader="true" :metaData="$metaData">
    {{-- :showHeader="false" --}}
    <div class="container-fluid">
        <div class="main-content d-flex flex-column px-0">
            <!-- Start Authentication Area -->
            <div class="m-auto mw-510 py-5">
                <div class="d-flex align-items-center gap-4 mb-3">
                    <h1 class="fs-3 mb-0">{{ __('contact.contact_us') }}</h1>
                    <a href="{{ route('home') }}">
                        <img src="brand/full-logo-black.png" alt="logo">
                    </a>
                </div>

                <div class="py-5">
                    <h2 class="h3 text-center text-danger">{{ __('dashboard.live_soon') }}</h2>
                </div>

                <div class="pt-3">
                    <h2 class="h3 text-black">{{ __('contact.get_in_touch') }}</h2>
                    <p class="mt-4">
                        {{ __('contact.desc_1') }}
                    </p>
                </div>

                <div class="pt-5">

                    @if ($errors->any())
                        <div class="text-danger border border-danger border-4 p-3 rounded-3 mb-3">
                            <b>{{ __('dashboard.error') }}:</b><hr>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" id="formToValidate" action="{{ route('form.contact.post') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label @error('name') text-danger @enderror">{{ __('dashboard.name') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="name" class="form-control text-dark ps-5 h-58 @error('name') border border-danger rounded-3 border-3 @enderror" value="{{ old('name') }}" placeholder="{{ __('dashboard.name') }}" required>
                                        <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label @error('email') text-danger @enderror">{{ __('dashboard.email') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="email" name="email"  class="form-control text-dark ps-5 h-58 @error('email') border border-danger rounded-3 border-3 @enderror" value="{{ old('email') }}" placeholder="{{ __('dashboard.email') }}" required>
                                        <i class="ri-mail-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label @error('phone') text-danger @enderror">{{ __('dashboard.phone') }}</label>
                                    <div class="form-group position-relative">
                                        <input type="tel" id="phone" name="phone" maxlength="10" class="form-control text-dark ps-5 h-58 @error('phone') border border-danger rounded-3 border-3 @enderror" value="{{ old('phone') }}" placeholder="{{ __('dashboard.phone') }}" required>
                                        <i class="ri-phone-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label @error('message') text-danger @enderror">{{ __('dashboard.message') }}</label>
                                    <div class="form-group position-relative">
                                        <textarea id="message_" name="message" class="form-control ps-5 text-dark @error('message') border border-danger rounded-3 border-3 @enderror" placeholder="{{ __('dashboard.message') }}" cols="30" rows="5" required>{{ old('message') }}</textarea>
                                        <i class="ri-information-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-2"></i>
                                    </div>
                                    @error('message')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">                                        
                            <div class="col-lg-12">
                                <div class="form-group d-flex gap-3">
                                    <button class="btn btn-primary py-3 px-5 fw-semibold text-white">{{ __('dashboard.save') }}</button>
                                </div>
                            </div>
                        </div>     
                    </form>
                </div>                    

                <div class="pt-4 pb-3">
                    <p class="mt-4">
                        {{ __('contact.desc_2') }}
                    </p>
                    <p class="mt-4">
                        {{ __('contact.desc_3') }}
                    </p>
                </div>

            </div>
            <!-- End Authentication Area -->
        </div>
    </div>
</x-layouts.simple-layout>