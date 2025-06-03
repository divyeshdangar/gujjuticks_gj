<x-layouts.front :showHeader="true" :metaData="$metaData">

    <div class="p-2">
        <div class="p-5 d-none d-md-block">
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row align-items-center mt-5">
                <div class="col-lg-6">
                    <div class="section-title mt-4 mt-lg-0">
                        <h3 class="title">{{ $metaData['title'] }}</h3>
                        <p class="text-muted">{{ $metaData['description'] }}</p>
                        <form method="post" class="contact-form mt-4" name="myForm" id="myForm"
                            action="{{ route('form.contact.post') }}">
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
                                            class="form-label @error('name') text-danger @enderror">Name</label>
                                        <input type="text" value="{{ old('name') }}" name="name" id="name"
                                            class="form-control @error('name') border border-danger border-1 @enderror"
                                            placeholder="Enter your name">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email"
                                            class="form-label @error('email') text-danger @enderror">Email</label>
                                        <input type="email" value="{{ old('email') }}" name="email" id="email"
                                            class="form-control @error('email') border border-danger border-1 @enderror"
                                            placeholder="Enter your email">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone"
                                            class="form-label  @error('phone') text-danger @enderror">Phone</label>
                                        <input type="tel" value="{{ old('phone') }}" name="phone" id="phone"
                                            class="form-control @error('phone') border border-danger border-1 @enderror"
                                            placeholder="Enter your phone">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="message"
                                            class="form-label @error('message') text-danger @enderror">Your
                                            Message</label>
                                        <textarea name="message" id="message" class="form-control @error('message') border border-danger border-1 @enderror"
                                            placeholder="Enter your message" rows="3">{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                            <div class="text-end">
                                <button type="submit" id="submit" name="submit" class="btn btn-primary"> Send
                                    Message <i class="uil uil-message ms-1"></i></button>
                            </div>
                        </form><!--end form-->
                    </div>
                </div><!--end col-->
                <div class="col-lg-5 ms-auto order-first order-lg-last">
                    <div class="text-center">
                        <img src="{{ asset('files/images/contact.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="mt-4 pt-3">
                        <div class="d-flex text-muted align-items-center mt-2">
                            <div class="flex-shrink-0 fs-22 text-primary">
                                <i class="uil uil-map-marker"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0">Gujarat, India</p>
                            </div>
                        </div>
                        <div class="d-flex text-muted align-items-center mt-2">
                            <div class="flex-shrink-0 fs-22 text-primary">
                                <i class="uil uil-envelope"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0">support@gujjuticks.com</p>
                            </div>
                        </div>
                        <div class="d-flex text-muted align-items-center mt-2">
                            <div class="flex-shrink-0 fs-22 text-primary">
                                <i class="uil uil-whatsapp"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0">(+91) 7600 12 6800</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- START CONTACT-PAGE -->

    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3777452.9390264275!2d68.68527999421731!3d22.394415122444837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959051f5f0ef795%3A0x861bd887ed54522e!2sGujarat!5e0!3m2!1sen!2sin!4v1746687932046!5m2!1sen!2sin"
            height="350" style="border:0;width: 100%;" allowfullscreen="" loading="lazy"></iframe>
    </div>

</x-layouts.front>
