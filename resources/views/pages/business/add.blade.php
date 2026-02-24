<x-layouts.front :showHeader="true" :metaData="$metaData">

    <style>
        .cr-boundary {
            border-radius: 15px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('assets/plugin/croppie/croppie.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/plugin/croppie/croppie.js') }}"></script>

    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 pb-3 me-lg-5">
                        <h6 class="sub-title">List It. Get Noticed | GujjuTicks</h6>

                        <h1 class="display-5 fw-semibold mb-3">{!! str_replace(
                            'Business Directory',
                            '<span class="text-warning fw-bold">Business Directory</span>',
                            $metaData['title'],
                        ) !!}</h1>

                        <p class="lead text-muted mb-4">{{ $metaData['description'] }}</p>

                        <p class="lead text-muted mb-0">
                            Want more people to discover your business? Add your business to our city directory and
                            reach thousands of local customers actively searching for services like yours. It is quick,
                            easy, and completely free - simply enter your business details, and we will make sure you
                            are visible where it matters most.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mt-5 mt-md-0">
                        <img loading="lazy" src="{{ URL::asset('/images/creative/Add-Your-Business-GujjuTicks-Business-Directory.jpg') }}" alt="Gujarat Add Business Image"
                            title="Gujarat Add Business Image" class="rounded-4 home-img w-100" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <h2 class="text-warning mb-4">Explore & Discover: 50+ Cities from Gujarat</h2>
                        <p class="text-muted mb-5">Uncover the vibrant essence of Gujarat through its top 50+ cities.
                            From historical landmarks to modern hubs, each city has a unique story, culture, and charm
                            waiting to be explored. Whether you're planning a trip or simply curious, this guide offers
                            a quick glimpse into the diverse spirit of Gujarat's landscape.</p>
                    </div>
                </div>
                <div class="col-ld-10">
                    <form method="post" action="" id="basicDetailsForm" enctype="multipart/form-data">
                        <div>
                            <h5 class="fs-17 fw-semibold mb-3 mb-0">Basic Business Details</h5>

                            {{ csrf_field() }}
                            <span id="error-msg">
                                @if ($errors->any())
                                    <div class="text-danger border border-danger border-2 p-3 rounded-3 mb-3">
                                        <b>{{ __('dashboard.error') }}:</b>
                                        <hr>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </span>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="name"
                                            class="form-label @error('name') text-danger @enderror">Business
                                            Name</label>
                                        <input type="text" value="{{ old('name') }}" name="name" id="name"
                                            class="form-control @error('name') border border-danger border-1 @enderror"
                                            placeholder="Enter Business Name" required>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <div class="form-group mb-2">
                                            <label for="city_id" class="form-label">Select City</label>
                                            <select
                                                class="form-control @error('city_id') border border-danger border-1 @enderror"
                                                name="city_id" id="city_id" required>
                                                <option value="" class="text-dark">-- Select --</option>
                                                @foreach ($cities as $key => $value)
                                                    <option value="{{ $value->id }}" class="text-dark"
                                                        @if ($value->id == old('city_id')) selected="selected" @endif>
                                                        {{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('city_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <div class="form-group mb-2">
                                            <label for="place_category_id" class="form-label">Select Business
                                                Category</label>
                                            <select
                                                class="form-control @error('place_category_id') border border-danger border-1 @enderror"
                                                name="place_category_id" id="place_category_id" required>
                                                <option value="" class="text-dark">-- Select --</option>
                                                @foreach ($categories as $key => $value)
                                                    <option value="{{ $value->id }}" class="text-dark"
                                                        @if ($value->id == old('place_category_id')) selected="selected" @endif>
                                                        {{ $value->label }}</option>
                                                @endforeach
                                            </select>
                                            @error('place_category_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                        <!--end account-->
                        <div class="mt-4">
                            <h5 class="fs-17 fw-semibold mb-3">About & Contact Details</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="description"
                                            class="form-label @error('description') text-danger @enderror">Explain About
                                            Your Business</label>
                                        <textarea name="description" id="description"
                                            class="form-control @error('description') border border-danger border-1 @enderror"
                                            placeholder="Enter About Your Business" rows="6">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone"
                                            class="form-label @error('phone') text-danger @enderror">Business
                                            phone</label>
                                        <input type="tel" value="{{ old('phone') }}" name="phone" id="phone"
                                            class="form-control @error('phone') border border-danger border-1 @enderror"
                                            placeholder="Enter Phone" required pattern="[0-9]{10,12}" minlength="10"
                                            maxlength="12" inputmode="numeric">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="website"
                                            class="form-label @error('website') text-danger @enderror">Website</label>
                                        <input type="url" value="{{ old('website') }}" name="website"
                                            id="website"
                                            class="form-control @error('website') border border-danger border-1 @enderror"
                                            placeholder="Enter website" required maxlength="255">
                                        @error('website')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="address"
                                            class="form-label @error('address') text-danger @enderror">Address</label>
                                        <textarea name="address" id="address"
                                            class="form-control @error('address') border border-danger border-1 @enderror"
                                            placeholder="Enter Address" rows="3">{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6" style="overflow: hidden;">
                                    <div class="mb-3" id="imageFormGroup">
                                        <label for="image"
                                            class="form-label @error('image') text-danger @enderror">Image/Logo</label>
                                        <input type="file" name="image" id="image"
                                            class="form-control @error('image') border border-danger border-1 @enderror">
                                        <input type="hidden" id="croppedImage" name="croppedImage" value="">
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div id="upload-image-image"></div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-warning">Submit for Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-muted">
                    <h2 class="text-warning text-center mb-4">Reach More Local Customers with a Free Business Listing
                    </h2>
                    <p class="text-muted text-start">
                        Getting your business listed online has never been easier, and it is one of the smartest ways to
                        reach more customers in your city. By adding your business to our directory, you give potential
                        clients a simple way to discover your products and services exactly when they are searching for
                        them. A well-crafted listing increases your local visibility, builds credibility, and drives
                        more inquiries without the need for expensive advertising. Whether you are running a retail
                        shop, a restaurant, a startup, or a professional service, our platform helps you showcase your
                        name, location, contact details, operating hours, website links, and a short description that
                        tells people why they should choose you.
                    </p>
                    <p class="text-muted text-start">
                        Our system is designed to make the process quick and hassle-free. In just a few minutes, you can
                        submit your details and have your business listed across all supported cities, ensuring you do
                        not miss out on local traffic. Each listing is optimized to appear in city-specific searches,
                        helping you stand out from competitors and connect with customers right where they live. Adding
                        your business is completely free, and you can update or edit your information anytime to keep it
                        accurate. Do not wait for people to find you by chance - take control of your online presence
                        today and put your business in front of the audience that matters most.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script>
        var $image_crop;
        var isImageSelected = false;
        window.addEventListener('load', function(event) {
            addCropperImage();
            $("#basicDetailsForm").submit(function(eventObj) {
                getImage();
                return true;
            });
        });

        function getImage() {
            $('#upload-image-image').croppie('result', {
                type: 'base64',
                format: 'png',
                size: {
                    width: 512,
                    height: 512
                }
            }).then(function(resp) {
                if (resp && isImageSelected) {
                    $("#croppedImage").val(resp)
                } else {
                    $("#croppedImage").val("")
                }
            });
        }

        function addCropperImage() {
            $image_crop = $('#upload-image-image').croppie({
                //enableExif: true,
                enableResize: true,
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square'
                },
                boundary: {
                    width: $("#imageFormGroup").width(),
                    height: 300
                }
            });
            $('#image').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $image_crop.croppie('bind', {
                        url: e.target.result
                    }).then(function() {
                        isImageSelected = true;
                    });
                }
                reader.readAsDataURL(this.files[0]);
            });
        }
    </script>

</x-layouts.front>
