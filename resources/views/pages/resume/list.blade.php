<x-layouts.front :showHeader="true" :metaData="$metaData">
    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 pb-3 me-lg-5">
                        <h6 class="sub-title">We have 150,000+ live jobs</h6>
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

    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title me-5">
                        <h3 class="title text-warning">How It Work</h3>
                        <p class="text-muted">Post a job to tell us about your project. We'll quickly match you with the
                            right freelancers.</p>
                        <div class="process-menu nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home"
                                role="tab" aria-controls="v-pills-home" aria-selected="true">
                                <div class="d-flex">
                                    <div class="number flex-shrink-0">
                                        1
                                    </div>
                                    <div class="flex-grow-1 text-start ms-3">
                                        <h5 class="fs-18">Fill In Your Details</h5>
                                        <p class="text-muted mb-0">Enter your personal information, work experience,
                                            education, skills, and more using our simple form. No technical knowledge
                                            needed.</p>
                                    </div>
                                </div>
                            </a>
                            <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile"
                                role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                <div class="d-flex">
                                    <div class="number flex-shrink-0">
                                        2
                                    </div>
                                    <div class="flex-grow-1 text-start ms-3">
                                        <h5 class="fs-18">Choose a Template</h5>
                                        <p class="text-muted mb-0">Browse through our collection of clean, modern, and
                                            professional resume templates. Select the one that suits your style and job
                                            profile.</p>
                                    </div>
                                </div>
                            </a>
                            <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-messages"
                                role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                <div class=" d-flex">
                                    <div class="number flex-shrink-0">
                                        3
                                    </div>
                                    <div class="flex-grow-1 text-start ms-3">
                                        <h5 class="fs-18">Download Your Resume</h5>
                                        <p class="text-muted mb-0">Preview your resume and download it instantly as a
                                            high-quality PDF. It’s ready to print, share, or send to recruiters right
                                            away.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <img src="{{ asset('files/images/fill-your-details.png') }}" alt=""
                                class="img-fluid">
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            <img src="{{ asset('files/images/choose-a-template.png') }}" alt=""
                                class="img-fluid">
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                            aria-labelledby="v-pills-messages-tab">
                            <img src="{{ asset('files/images/download-your-resume.png') }}" alt=""
                                class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <h2 class="text-warning mb-4">Who Is It For?</h2>
                        <p class="text-muted mb-5">Whether you're just starting your career or making a bold move, our
                            resume builder is tailored to help you shine. It’s made for everyone who wants a resume that
                            gets noticed.</p>

                        <div class="row text-start">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <h3 class="h4">👩‍🎓 Fresh Graduates</h3>
                                    <p class="text-muted">No work experience? No problem. Create a professional resume
                                        that highlights your education, skills, and potential—perfect for landing your
                                        first job.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-5">
                                    <h3 class="h4">🔄 Job Seekers Switching Careers</h3>
                                    <p class="text-muted">Making a career shift? Our templates help you reframe your
                                        experience and focus on transferable skills to stand out in a new industry.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-5">
                                    <h3 class="h4">💼 Freelancers and Part-Timers</h3>
                                    <p class="text-muted">Present your freelance projects and gigs in a clean,
                                        structured format. Show off your versatility and client work in a way recruiters
                                        understand.</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-5">
                                    <h3 class="h4">📚 Students Applying for Internships</h3>
                                    <p class="text-muted">Build a resume that highlights your academics,
                                        extracurriculars, and strengths—designed to impress internship coordinators and
                                        mentors.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-2">
                            <button class="btn btn-warning btn-hover" style="color: rgb(19, 19, 19) !important;"
                                data-bs-toggle="modal" data-bs-target="#startBuildingResume">Start Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="text-warning text-center mb-4">Frequntly Asked Questions!</h2>
                    <p class="text-muted text-center mb-5">Whether you're just starting your career or making a bold
                        move, our resume builder is tailored to help you shine. It’s made for everyone who wants a
                        resume that gets noticed.</p>
                    <div class="accordion accordion-flush faq-box" id="support">
                        <div class="accordion-item mt-4 border-0">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button btn-secondary rounded-3 text-dark" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true"
                                    aria-controls="collapse1">
                                    Is the resume builder free to use?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1"
                                data-bs-parent="#support">
                                <div class="accordion-body text-muted">
                                    Yes, you can create and preview your resume for free. Some premium templates or
                                    downloads may require a small fee.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mt-4 border-0">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button btn-secondary rounded-3 text-dark collapsed"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse2"
                                    aria-expanded="false" aria-controls="collapse2">
                                    Do I need to create an account to use it?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2"
                                data-bs-parent="#support">
                                <div class="accordion-body text-muted">
                                    No sign-up is required to build your resume. Just fill in your details, choose a
                                    template, and download instantly.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mt-4 border-0">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button btn-secondary rounded-3 text-dark collapsed"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse3"
                                    aria-expanded="false" aria-controls="collapse3">
                                    Can I edit my resume after downloading it?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3"
                                data-bs-parent="#support">
                                <div class="accordion-body text-muted">
                                    Once downloaded as a PDF, it's not editable. However, you can return to the builder,
                                    make changes, and generate a new version anytime.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mt-4 border-0">
                            <h2 class="accordion-header" id="faq4">
                                <button class="accordion-button btn-secondary rounded-3 text-dark collapsed"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse4"
                                    aria-expanded="false" aria-controls="collapse4" style="">
                                    Are your resume templates ATS-friendly?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4"
                                data-bs-parent="#support">
                                <div class="accordion-body text-muted">
                                    Yes! All our templates are designed to be clean, professional, and compatible with
                                    Applicant Tracking Systems (ATS).
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mt-4 border-0">
                            <h2 class="accordion-header" id="faq5">
                                <button class="accordion-button btn-secondary rounded-3 text-dark collapsed"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse5"
                                    aria-expanded="false" aria-controls="collapse5">
                                    Can I use the resume for different jobs?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="faq5"
                                data-bs-parent="#support">
                                <div class="accordion-body text-muted">
                                    Absolutely! You can create and customize multiple versions of your resume tailored
                                    to different job roles or industries.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mt-4 border-0">
                            <h2 class="accordion-header" id="faq6">
                                <button class="accordion-button btn-secondary rounded-3 text-dark collapsed"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse6"
                                    aria-expanded="false" aria-controls="collapse6">
                                    Is my data safe?
                                </button>
                            </h2>
                            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="faq6"
                                data-bs-parent="#support">
                                <div class="accordion-body text-muted">
                                    Yes, your information is not stored permanently and is only used to generate your
                                    resume during your session.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="text-center mt-5">
                        <a target="_blank"
                            href="https://wa.me/917600126800?text=How%20can%20i%20get%20more%20information%20on%20Resume%20Builder%3F"
                            class="btn btn-success btn-hover mt-2">Whatsapp</a>
                        <a target="_blank" href="{{ route('form.contact.post') }}"
                            class="btn btn-primary btn-hover mt-2 ms-md-2">Contact Us</a>
                        <a target="_blank" href="mailto:support@gujjuticks.com"
                            class="btn btn-warning btn-hover mt-2 ms-md-2">Email Now</a>
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
                        <h5 class="modal-title text-warning mt-0" id="startBuildingResumeLabel">Start Resume Building</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-4">Start building your resume by entering a few basic details. No sign-up needed - just fill in your
                            name and mobile number to continue.</p>

                        <div class="mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" maxlength="128" name="firstname" id="firstname" class="form-control" placeholder="Enter your First Name">
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" maxlength="128" name="lastname" id="lastname" class="form-control" placeholder="Enter your Last Name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label @error('email') text-danger @enderror">Email</label>
                            <input type="email" maxlength="128" name="email" id="email" class="form-control" placeholder="Enter your Email">
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
