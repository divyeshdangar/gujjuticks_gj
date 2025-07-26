<x-layouts.front :showHeader="true" :metaData="$metaData">
    <style>
        .cr-boundary {
            border-radius: 15px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('assets/plugin/croppie/croppie.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/plugin/croppie/croppie.js') }}"></script>

    <div class="p-2">
        <div class="p-5 d-none d-md-block">
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title mt-4 mt-lg-0">
                        <h3 class="title">{{ $metaData['title'] }}</h3>
                        <p class="text-muted">{{ $metaData['description'] }}</p>
                        <a target="_blank"
                            href="{{ route('pages.resume.builder.generate', ['token' => $dataDetail->token]) }}"
                            class="btn btn-primary">Check Resume PDF</a>
                        <a target="_blank"
                            href="{{ route('pages.resume.builder.generate', ['token' => $dataDetail->token, 'download' => '1']) }}"
                            class="btn btn-danger">Download Resume PDF</a>
                        <div class="overflow-auto mt-4">
                            <ul class="nav nav-underline flex-nowrap justify-content-start my-4"
                                style="white-space: nowrap;" id="resumeTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="tab-info" data-bs-toggle="tab" href="#info"
                                        role="tab">Basic Info</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="tab-skills" data-bs-toggle="tab" href="#skills"
                                        role="tab">Skills</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="tab-educations" data-bs-toggle="tab" href="#educations"
                                        role="tab">Educations</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="tab-experiences" data-bs-toggle="tab" href="#experiences"
                                        role="tab">Experiences</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="tab-achievements" data-bs-toggle="tab" href="#achievements"
                                        role="tab">Achievements</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="tab-portfolios" data-bs-toggle="tab" href="#portfolios"
                                        role="tab">Portfolios</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="resumeTabContent">

                            <div class="tab-pane fade show active" id="info" role="tabpanel"
                                aria-labelledby="tab-info">

                                <form method="post" enctype="multipart/form-data" class="contact-form mt-4"
                                    name="basicDetailsForm" id="basicDetailsForm">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="record_type" value="basic">
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
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="firstname"
                                                            class="form-label @error('firstname') text-danger @enderror">First
                                                            Name</label>
                                                        <input type="text"
                                                            value="{{ old('firstname', $dataDetail->firstname) }}"
                                                            name="firstname" id="firstname"
                                                            class="form-control @error('firstname') border border-danger border-1 @enderror">
                                                        @error('firstname')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="lastname"
                                                            class="form-label @error('lastname') text-danger @enderror">Last
                                                            Name</label>
                                                        <input type="text"
                                                            value="{{ old('lastname', $dataDetail->lastname) }}"
                                                            name="lastname" id="lastname"
                                                            class="form-control @error('lastname') border border-danger border-1 @enderror">
                                                        @error('lastname')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="email"
                                                            class="form-label @error('email') text-danger @enderror">Email</label>
                                                        <input type="email"
                                                            value="{{ old('email', $dataDetail->email) }}"
                                                            name="email" id="email"
                                                            class="form-control @error('email') border border-danger border-1 @enderror">
                                                        @error('email')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="mobile"
                                                            class="form-label @error('mobile') text-danger @enderror">Mobile</label>
                                                        <input type="text"
                                                            value="{{ old('mobile', $dataDetail->mobile) }}"
                                                            name="mobile" id="mobile"
                                                            class="form-control @error('mobile') border border-danger border-1 @enderror">
                                                        @error('mobile')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="website"
                                                            class="form-label @error('website') text-danger @enderror">Website</label>
                                                        <input type="text"
                                                            value="{{ old('website', $dataDetail->website) }}"
                                                            name="website" id="website"
                                                            class="form-control @error('website') border border-danger border-1 @enderror">
                                                        @error('website')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="designation"
                                                            class="form-label @error('designation') text-danger @enderror">Designation</label>
                                                        <input type="text"
                                                            value="{{ old('designation', $dataDetail->designation) }}"
                                                            name="designation" id="designation"
                                                            class="form-control @error('designation') border border-danger border-1 @enderror">
                                                        @error('designation')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="links"
                                                            class="form-label @error('links') text-danger @enderror">Links</label>
                                                        <input type="text"
                                                            value="{{ old('links', $dataDetail->links) }}"
                                                            name="links" id="links"
                                                            class="form-control @error('links') border border-danger border-1 @enderror">
                                                        @error('links')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="language"
                                                            class="form-label @error('language') text-danger @enderror">Language <span class="text-muted">(for PDF language)</span></label>
                                                        <select
                                                            class="form-control @error('language') border border-danger border-1 @enderror"
                                                            name="language" id="language">
                                                            <option value="English" class="text-dark"
                                                                @if ('English' == old('language', $dataDetail->language)) selected="selected" @endif>
                                                                English</option>
                                                            <option value="Hindi" class="text-dark"
                                                                @if ('Hindi' == old('language', $dataDetail->language)) selected="selected" @endif>
                                                                Hindi</option>
                                                            <option value="Gujarati" class="text-dark"
                                                                @if ('Gujarati' == old('language', $dataDetail->language)) selected="selected" @endif>
                                                                Gujarati</option>
                                                        </select>
                                                        <small class="text-muted">You can add languages you know in <span class="text-warning">Skills</span> section.</small>
                                                        @error('language')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="address"
                                                            class="form-label @error('address') text-danger @enderror">Address</label>
                                                        <textarea name="address" id="address"
                                                            class="form-control @error('address') border border-danger border-1 @enderror" rows="2">{{ old('address', $dataDetail->address) }}</textarea>
                                                        @error('address')
                                                            <div class="text-danger">{{ $address }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="about"
                                                            class="form-label @error('about') text-danger @enderror">About</label>
                                                        <textarea name="about" id="about" class="form-control @error('about') border border-danger border-1 @enderror"
                                                            rows="6">{{ old('about', $dataDetail->about) }}</textarea>
                                                        @error('about')
                                                            <div class="text-danger">{{ $about }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3" id="imageFormGroup">
                                                <label for="image"
                                                    class="form-label @error('image') text-danger @enderror">Image</label>
                                                <input type="file" name="image" id="image"
                                                    class="form-control @error('image') border border-danger border-1 @enderror">
                                                <input type="hidden" id="croppedImage" name="croppedImage"
                                                    value="">
                                                @error('image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div id="upload-image-image"></div>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="skills" role="tabpanel" aria-labelledby="tab-skills">
                                <!-- Skills form -->
                                <form method="post" class="contact-form mt-4" name="myForm" id="skillRepeater">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="record_type" value="skills">
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
                                        <div class="col-md-12">
                                            <button type="button" data-repeater-create class="btn btn-sm btn-primary mb-2">Add Skill</button>
                                            <div class="row" data-repeater-list="skills">

                                                @if ($dataDetail->skills && count($dataDetail->skills) > 0)
                                                    @foreach ($dataDetail->skills as $skill)
                                                        <div data-repeater-item class="col-md-4">
                                                            <div class="form-group mb-4">
                                                                <label for="skill" class="form-label">Skill</label>
                                                                <input type="text" name="skill" id="skill"
                                                                    class="form-control" value="{{ $skill->name }}">
                                                                <button type="button" data-repeater-delete
                                                                    class="btn btn-sm btn-outline-danger mt-2"
                                                                    required>Remove</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div data-repeater-item class="col-md-4">
                                                        <div class="form-group mb-4">
                                                            <label for="skill" class="form-label">Skill</label>
                                                            <input type="text" name="skill" id="skill"
                                                                class="form-control">
                                                            <button type="button" data-repeater-delete
                                                                class="btn btn-sm btn-outline-danger mt-2">Remove</button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="educations" role="tabpanel"
                                aria-labelledby="tab-educations">
                                <!-- Educations form -->
                                <form method="post" class="contact-form mt-4" name="myForm"
                                    id="educationsRepeater">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="record_type" value="educations">
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
                                        <div class="col-md-12">
                                            <button type="button" data-repeater-create
                                                class="btn btn-sm btn-primary mb-2">Add Education</button>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row" data-repeater-list="educations">

                                                @if ($dataDetail->educations && count($dataDetail->educations) > 0)
                                                    @foreach ($dataDetail->educations as $edu)
                                                        <div data-repeater-item class="col-md-12 mb-4">
                                                            <div class="border border-2 rounded p-3">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group mb-2">
                                                                            <label for="title"
                                                                                class="form-label">Title</label>
                                                                            <input type="text" name="title"
                                                                                id="title"
                                                                                value="{{ $edu->title }}"
                                                                                class="form-control" required>
                                                                        </div>
                                                                        <div class="form-group mb-2">
                                                                            <label for="place"
                                                                                class="form-label">Place</label>
                                                                            <input type="text" name="place"
                                                                                id="place"
                                                                                value="{{ $edu->place }}"
                                                                                class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="row">
                                                                            <div class="col-5">
                                                                                <div class="form-group mb-2">
                                                                                    <label for="start_month"
                                                                                        class="form-label">Start
                                                                                        Month</label>
                                                                                    <select
                                                                                        class="form-control @error('start_month') border border-danger border-1 @enderror"
                                                                                        name="start_month"
                                                                                        id="start_month" required>
                                                                                        <option value="" class="text-dark">-- Select --</option>
                                                                                        @foreach($months as $key => $value)
                                                                                            <option value="{{ $key+1 }}" class="text-dark" @if (($key+1) == old('start_month',  $edu->start_month)) selected="selected" @endif>{{ $value }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-7">
                                                                                <div class="form-group mb-2">
                                                                                    <label for="start_year"
                                                                                        class="form-label">Start
                                                                                        Year</label>
                                                                                    <input type="text"
                                                                                        name="start_year"
                                                                                        value="{{ $edu->start_year }}"
                                                                                        id="start_year"
                                                                                        class="form-control" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5">
                                                                                <div class="form-group mb-2">
                                                                                    <label for="end_month"
                                                                                        class="form-label">End
                                                                                        Month</label>
                                                                                    <select
                                                                                        class="form-control @error('end_month') border border-danger border-1 @enderror"
                                                                                        name="end_month"
                                                                                        id="end_month">
                                                                                        <option value="" class="text-dark">-- Select --</option>
                                                                                        @foreach($months as $key => $value)
                                                                                            <option value="{{ $key+1 }}" class="text-dark" @if (($key+1) == old('end_month',  $edu->end_month)) selected="selected" @endif>{{ $value }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-7">
                                                                                <div class="form-group mb-2">
                                                                                    <label for="end_year"
                                                                                        class="form-label">End
                                                                                        Year</label>
                                                                                    <input type="text"
                                                                                        name="end_year" id="end_year"
                                                                                        value="{{ $edu->end_year }}"
                                                                                        class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="mb-2">
                                                                            <label for="description"
                                                                                class="form-label">Description</label>
                                                                            <textarea name="description" id="description" class="form-control" rows="5">{{ $edu->description }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="button" data-repeater-delete
                                                                        class="btn btn-sm btn-outline-danger mt-2">Remove</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div data-repeater-item class="col-md-12 mb-4">
                                                        <div class="border border-2 rounded p-3">

                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-2">
                                                                        <label for="title"
                                                                            class="form-label">Title</label>
                                                                        <input type="text" name="title"
                                                                            id="title" class="form-control"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="place"
                                                                            class="form-label">Place</label>
                                                                        <input type="text" name="place"
                                                                            id="place" class="form-control"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-5">
                                                                            <div class="form-group mb-2">
                                                                                <label for="start_month"
                                                                                    class="form-label">Start
                                                                                    Month</label>
                                                                                <select
                                                                                    class="form-control"
                                                                                    name="start_month"
                                                                                    id="start_month" required>
                                                                                    <option value="" class="text-dark">-- Select --</option>
                                                                                    @foreach($months as $key => $value)
                                                                                        <option value="{{ $key+1 }}" class="text-dark">{{ $value }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-7">
                                                                            <div class="form-group mb-2">
                                                                                <label for="start_year"
                                                                                    class="form-label">Start
                                                                                    Year</label>
                                                                                <input type="text"
                                                                                    name="start_year" id="start_year"
                                                                                    class="form-control" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5">
                                                                            <div class="form-group mb-2">
                                                                                <label for="end_month"
                                                                                    class="form-label">End
                                                                                    Month</label>
                                                                                <select
                                                                                    class="form-control"
                                                                                    name="end_month"
                                                                                    id="end_month">
                                                                                    <option value="" class="text-dark">-- Select --</option>
                                                                                    @foreach($months as $key => $value)
                                                                                        <option value="{{ $key+1 }}" class="text-dark">{{ $value }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-7">
                                                                            <div class="form-group mb-2">
                                                                                <label for="end_year"
                                                                                    class="form-label">End
                                                                                    Year</label>
                                                                                <input type="text" name="end_year"
                                                                                    id="end_year"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mb-2">
                                                                        <label for="description"
                                                                            class="form-label">Description</label>
                                                                        <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="form-group">
                                                                <button type="button" data-repeater-delete
                                                                    class="btn btn-sm btn-outline-danger mt-2">Remove</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="experiences" role="tabpanel"
                                aria-labelledby="tab-experiences">
                                <!-- Experiences form -->
                                <form method="post" class="contact-form mt-4" name="myForm"
                                    id="experiencesRepeater">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="record_type" value="experiences">
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
                                        <div class="col-md-12">
                                            <button type="button" data-repeater-create
                                                class="btn btn-sm btn-primary mb-2">Add Experience</button>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row" data-repeater-list="experiences">
                                                @if ($dataDetail->experiences && count($dataDetail->experiences) > 0)
                                                    @foreach ($dataDetail->experiences as $exp)
                                                        <div data-repeater-item class="col-md-12 mb-4">
                                                            <div class="border border-2 rounded p-3">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group mb-2">
                                                                            <label for="title"
                                                                                class="form-label">Title</label>
                                                                            <input type="text" name="title"
                                                                                id="title"
                                                                                value="{{ $exp->title }}"
                                                                                class="form-control" required>
                                                                        </div>
                                                                        <div class="form-group mb-2">
                                                                            <label for="place"
                                                                                class="form-label">Place</label>
                                                                            <input type="text" name="place"
                                                                                id="place"
                                                                                value="{{ $exp->place }}"
                                                                                class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="row">
                                                                            <div class="col-5">
                                                                                <div class="form-group mb-2">
                                                                                    <label for="start_month"
                                                                                        class="form-label">Start
                                                                                        Month</label>
                                                                                    <select
                                                                                        class="form-control @error('start_month') border border-danger border-1 @enderror"
                                                                                        name="start_month"
                                                                                        id="start_month" required>
                                                                                        <option value="" class="text-dark">-- Select --</option>
                                                                                        @foreach($months as $key => $value)
                                                                                            <option value="{{ $key+1 }}" class="text-dark" @if (($key+1) == old('start_month',  $exp->start_month)) selected="selected" @endif>{{ $value }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-7">
                                                                                <div class="form-group mb-2">
                                                                                    <label for="start_year"
                                                                                        class="form-label">Start
                                                                                        Year</label>
                                                                                    <input type="text"
                                                                                        name="start_year"
                                                                                        value="{{ $exp->start_year }}"
                                                                                        id="start_year"
                                                                                        class="form-control" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5">
                                                                                <div class="form-group mb-2">
                                                                                    <label for="end_month"
                                                                                        class="form-label">End
                                                                                        Month</label>
                                                                                    <select
                                                                                        class="form-control @error('end_month') border border-danger border-1 @enderror"
                                                                                        name="end_month"
                                                                                        id="end_month">
                                                                                        <option value="" class="text-dark">-- Select --</option>
                                                                                        @foreach($months as $key => $value)
                                                                                            <option value="{{ $key+1 }}" class="text-dark" @if (($key+1) == old('end_month',  $exp->end_month)) selected="selected" @endif>{{ $value }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-7">
                                                                                <div class="form-group mb-2">
                                                                                    <label for="end_year"
                                                                                        class="form-label">End
                                                                                        Year</label>
                                                                                    <input type="text"
                                                                                        name="end_year" id="end_year"
                                                                                        value="{{ $exp->end_year }}"
                                                                                        class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="mb-2">
                                                                            <label for="experience"
                                                                                class="form-label">Experience</label>
                                                                            <textarea name="experience" id="experience" class="form-control" rows="5" required>{{ $exp->experience }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group mb-2">
                                                                            <label for="city"
                                                                                class="form-label">City</label>
                                                                            <input type="text" name="city"
                                                                                value="{{ $exp->city }}"
                                                                                id="city" class="form-control"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group mt-4">
                                                                            <button type="button" data-repeater-delete
                                                                                class="btn btn-sm btn-outline-danger mt-2">Remove</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div data-repeater-item class="col-md-12 mb-4">
                                                        <div class="border border-2 rounded p-3">

                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-2">
                                                                        <label for="title"
                                                                            class="form-label">Title</label>
                                                                        <input type="text" name="title"
                                                                            id="title" class="form-control"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="place"
                                                                            class="form-label">Place</label>
                                                                        <input type="text" name="place"
                                                                            id="place" class="form-control"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-5">
                                                                            <div class="form-group mb-2">
                                                                                <label for="start_month"
                                                                                    class="form-label">Start
                                                                                    Month</label>
                                                                                <select
                                                                                    class="form-control"
                                                                                    name="start_month"
                                                                                    id="start_month" required>
                                                                                    <option value="" class="text-dark">-- Select --</option>
                                                                                    @foreach($months as $key => $value)
                                                                                        <option value="{{ $key+1 }}" class="text-dark">{{ $value }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-7">
                                                                            <div class="form-group mb-2">
                                                                                <label for="start_year"
                                                                                    class="form-label">Start
                                                                                    Year</label>
                                                                                <input type="text"
                                                                                    name="start_year" id="start_year"
                                                                                    class="form-control" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5">
                                                                            <div class="form-group mb-2">
                                                                                <label for="end_month"
                                                                                    class="form-label">End
                                                                                    Month</label>
                                                                                <select
                                                                                    class="form-control"
                                                                                    name="end_month"
                                                                                    id="end_month">
                                                                                    <option value="" class="text-dark">-- Select --</option>
                                                                                    @foreach($months as $key => $value)
                                                                                        <option value="{{ $key+1 }}" class="text-dark">{{ $value }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-7">
                                                                            <div class="form-group mb-2">
                                                                                <label for="end_year"
                                                                                    class="form-label">End
                                                                                    Year</label>
                                                                                <input type="text" name="end_year"
                                                                                    id="end_year"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mb-2">
                                                                        <label for="experience"
                                                                            class="form-label">Experience</label>
                                                                        <textarea name="experience" id="experience" class="form-control" rows="5" required></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-2">
                                                                        <label for="city"
                                                                            class="form-label">City</label>
                                                                        <input type="text" name="city"
                                                                            id="city" class="form-control"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mt-4">
                                                                        <button type="button" data-repeater-delete
                                                                            class="btn btn-sm btn-outline-danger mt-2">Remove</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="portfolios" role="tabpanel"
                                aria-labelledby="tab-portfolios">
                                <!-- Portfolios form -->
                                <p>This is the Portfolios section.</p>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $('#skillRepeater').repeater({
            initEmpty: false,
            show: function() {
                $(this).slideDown();
            },
            hide: function(deleteElement) {
                if (confirm('Remove this skill entry?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });

        $('#educationsRepeater').repeater({
            initEmpty: false,
            show: function() {
                $(this).slideDown();
            },
            hide: function(deleteElement) {
                if (confirm('Remove this education entry?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });

        $('#experiencesRepeater').repeater({
            initEmpty: false,
            show: function() {
                $(this).slideDown();
            },
            hide: function(deleteElement) {
                if (confirm('Remove this education entry?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });


        var $image_crop;
        var $banner_crop;
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
                format: 'jpeg',
                quality: 0.7
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
                    height: $("#imageFormGroup").width() * 1.2
                },
                url: '{{ URL::asset('/images/resume/' . $dataDetail->image) }}'
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
