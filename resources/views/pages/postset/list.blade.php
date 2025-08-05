<x-layouts.front :showHeader="true" :metaData="$metaData">
    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 pb-3 me-lg-5">
                        <h6 class="sub-title">Boost your professional image</h6>
                        <h1 class="display-5 fw-semibold mb-3">Build Your Resume in Minutes with <span
                                class="text-warning fw-bold">GT Resume Builder</span></h1>
                        <p class="lead text-muted mb-0">Create a stunning, professional resume with ease. No design
                            skills needed.</p>
                    </div>
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="mt-3 mt-md-0 h-100">
                                <button class="btn btn-warning" style="color: rgb(19, 19, 19) !important;"
                                    data-bs-toggle="modal" data-bs-target="#startBuildingResume">Start Building
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mt-5 mt-md-0">
                        <img src="{{ asset('files/images/gujjuticks-resume-builder.png') }}" alt=""
                            class="home-img w-100" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="startBuildingResume" class="modal fade" tabindex="-1" aria-labelledby="startBuildingResumeLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title text-warning mt-0" id="startBuildingResumeLabel">Start Adding Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                        <p class="mb-4">Start building your resume by entering a few basic details. No sign-up needed
                            - just fill in your name and mobile number to continue.</p>
                        <div class="mb-3">
                            <label for="prompt" class="form-label">Prompt</label>
                            <textarea name="prompt" id="prompt" class="form-control" rows="4" style="width: 100%">{{ old('prompt', $prompt) }}</textarea>
                            @error('prompt')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="data" class="form-label">Data</label>
                            <textarea name="data" id="data" class="form-control" rows="10" style="width: 100%">{{ old('data') }}</textarea>
                            @error('data')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning waves-effect waves-light"
                            style="color: rgb(19, 19, 19) !important;">Start Process</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.front>
