<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.basic_info') }}</h4>
                        <div class="dropdown action-opt">
                            <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('dashboard.template.edit', ['id' => $dataDetail->id]) }}">
                                        <i data-feather="edit-3"></i>
                                        {{ __('dashboard.edit') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a target="_blank" href="{{ URL::asset('/images/template/' . $dataDetail->image) }}">
                        <img src="{{ URL::asset('/images/template/' . $dataDetail->image) }}"
                            class="img-fluid rounded-10 mb-4">
                    </a>
                    <h4 class="fs-15 fw-semibold">{{ __('dashboard.title') }}:</h4>
                    <p class="mb-4">{!! $dataDetail->title !!}</p>
                    <h4 class="fs-15 fw-semibold">{{ __('dashboard.meta_description') }}:</h4>
                    <p class="mb-4">{!! $dataDetail->meta_description !!}</p>
                    <ul class="ps-0 mb-0 list-unstyled">
                        <li class="border-bottom border-color-gray mb-3 pb-3">
                            <span class="fw-semibold text-dark w-130 d-inline-block">{{ __('dashboard.date') }}:</span>
                            <span>{{ $dataDetail->created_at->format('j F, Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">Setup Form</h4>
                        <div class="action-opt">
                            <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i data-feather="file-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="">
                        <div id="fb-editor"></div>
                    </div>
                    <form method="post" id="formToValidate"
                        action="{{ route('dashboard.template.form.post', ['id' => $dataDetail->id]) }}">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        jQuery(function($) {
            var options = {
                formData: {!! ($dataDetail->form_data) ? $dataDetail->form_data : '{}' !!},
                onSave: function(evt, formData) {
                    sendData(formData);
                },
                disableFields: [
                    'autocomplete', 'button', 'header',
                    'hidden', 'paragraph', 'radio-group', 'starRating',
                    'checkbox', 'email', 'phone', 'range', 'url'
                ]
            };
            $(document.getElementById('fb-editor')).formBuilder(options);
        });

        function sendData(data) {
                let form = $("#formToValidate")[0]; // Get the form element
                let formData = new FormData(form); // Create FormData from form

                // Append JSON data (as an object, not a string)
                formData.append("form_data", JSON.stringify( data ));

                // Send AJAX request
                $.ajax({
                    url: form.action, // Use form's action attribute
                    type: "POST",
                    data: formData,
                    processData: false, // Important! Prevent jQuery from converting FormData into a string
                    contentType: false, // Important! Let browser set the Content-Type
                    headers: {
                        "X-CSRF-TOKEN": $("input[name='_token']").val()
                    },
                    success: function(response) {
                        Swal.fire(response.message.title, response.message.description, response.message.type);
                    },
                    error: function(xhr) {
                        if(response && response.message && response.message.type){
                            Swal.fire(response.message.title, response.message.description, response.message.type);
                        } else {
                            Swal.fire('Bad move!', 'Issue in saving record!', 'error');
                        }
                    }
                });
        }
    </script>

</x-layouts.dashboard>
