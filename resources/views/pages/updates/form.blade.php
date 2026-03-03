<x-layouts.front :showHeader="true" :metaData="$metaData">
    <section class="section">
        <div class="container">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h4 mb-3">{{ $dataDetail ? 'Edit Update' : 'Post New Update' }}</h1>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" enctype="multipart/form-data" action="{{ $dataDetail ? route('pages.updates.update', ['citySlug' => $dataDetail->city?->slug, 'postType' => $dataDetail->type, 'publicId' => $dataDetail->public_id ?? $dataDetail->slug]) : route('pages.updates.store') }}">
                        @csrf
                        @if($dataDetail && $dataDetail->image)
                            <input type="hidden" name="existing_image" value="{{ $dataDetail->image }}">
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" required value="{{ old('title', $dataDetail?->title) }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">City</label>
                                <select name="city_id" class="form-select" required>
                                    <option value="">Select city</option>
                                    @foreach($cityData as $city)
                                        <option value="{{ $city->id }}" @if((string)old('city_id', $dataDetail?->city_id) === (string)$city->id) selected @endif>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Category</label>
                                <select name="update_category_id" class="form-select" required>
                                    <option value="">Select category</option>
                                    @foreach($categoryData as $category)
                                        <option value="{{ $category->id }}" @if((string)old('update_category_id', $dataDetail?->update_category_id) === (string)$category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Type</label>
                                <select id="update-type" name="type" class="form-select" required>
                                    @foreach($types as $value => $label)
                                        <option value="{{ $value }}" @if(old('type', $dataDetail?->type ?? 'status') === $value) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Privacy</label>
                                <select name="privacy" class="form-select" required>
                                    @foreach($privacyOptions as $privacy)
                                        <option value="{{ $privacy }}" @if(old('privacy', $dataDetail?->privacy ?? 'public') === $privacy) selected @endif>{{ ucfirst($privacy) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">External Link (Optional)</label>
                                <input type="url" name="external_link" class="form-control" value="{{ old('external_link', $dataDetail?->external_link) }}">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea id="description-field" name="description" rows="5" class="form-control" placeholder="Write your update details...">{{ old('description', $dataDetail?->description) }}</textarea>
                                <small class="text-muted">For status updates, this is the main content users read.</small>
                            </div>

                            <div class="col-md-6 update-type-section" data-types="image">
                                <label class="form-label">Image</label>
                                <input id="image-field" type="file" name="image" class="form-control" accept="image/*">
                                @if($dataDetail?->image)
                                    <small class="text-muted d-block mt-1">Current image: {{ $dataDetail->image }}</small>
                                @endif
                            </div>
                            <div class="col-md-6 update-type-section" data-types="youtube">
                                <label class="form-label">YouTube URL</label>
                                <input id="youtube-field" type="url" name="youtube_url" class="form-control" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('youtube_url', $dataDetail?->youtube_url) }}">
                            </div>

                            <div class="col-md-12 update-type-section" data-types="poll">
                                <label class="form-label">Poll Question</label>
                                <input id="poll-question-field" type="text" name="poll_question" class="form-control mb-2" placeholder="Ask your poll question..." value="{{ old('poll_question', $dataDetail?->poll_question) }}">
                                @php
                                    $oldOptions = old('poll_options');
                                    $options = $oldOptions ?? ($dataDetail ? $dataDetail->pollOptions->pluck('option_text')->toArray() : ['', '']);
                                    if (count($options) < 2) {
                                        $options = array_pad($options, 2, '');
                                    }
                                @endphp
                                <div id="poll-options-container">
                                    @foreach($options as $option)
                                        <div class="input-group mb-2 poll-option-row">
                                            <input type="text" name="poll_options[]" class="form-control poll-option-input" placeholder="Poll option" value="{{ $option }}">
                                            <button class="btn btn-outline-danger remove-poll-option" type="button">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-poll-option" class="btn btn-sm btn-outline-primary">+ Add option</button>
                            </div>

                            <div class="col-md-12 update-type-section" data-types="qa">
                                <label class="form-label">Q&A Question</label>
                                <input id="qa-question-field" type="text" name="qa_question" class="form-control" placeholder="Ask a question for the community..." value="{{ old('qa_question', $dataDetail?->qa_question) }}">
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">{{ $dataDetail ? 'Update' : 'Post' }}</button>
                            <a href="{{ route('pages.updates.list') }}" class="btn btn-outline-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        (function() {
            var typeField = document.getElementById('update-type');
            var sections = document.querySelectorAll('.update-type-section');
            var descriptionField = document.getElementById('description-field');
            var imageField = document.getElementById('image-field');
            var youtubeField = document.getElementById('youtube-field');
            var pollQuestionField = document.getElementById('poll-question-field');
            var qaQuestionField = document.getElementById('qa-question-field');
            var pollOptionsContainer = document.getElementById('poll-options-container');
            var addPollOptionBtn = document.getElementById('add-poll-option');
            var hasExistingImage = {{ $dataDetail && $dataDetail->image ? 'true' : 'false' }};

            function getPollInputs() {
                return pollOptionsContainer ? pollOptionsContainer.querySelectorAll('.poll-option-input') : [];
            }

            function updatePollOptionRequirements(isPoll) {
                var inputs = getPollInputs();
                inputs.forEach(function(input, index) {
                    input.required = isPoll && index < 2;
                });
            }

            function toggleFields() {
                var type = typeField ? typeField.value : 'status';

                sections.forEach(function(section) {
                    var allowedTypes = section.getAttribute('data-types').split(',');
                    var show = allowedTypes.indexOf(type) >= 0;
                    section.style.display = show ? '' : 'none';
                });

                if (descriptionField) {
                    descriptionField.required = (type === 'status');
                }
                if (imageField) {
                    imageField.required = (type === 'image' && !hasExistingImage);
                }
                if (youtubeField) {
                    youtubeField.required = (type === 'youtube');
                }
                if (pollQuestionField) {
                    pollQuestionField.required = (type === 'poll');
                }
                if (qaQuestionField) {
                    qaQuestionField.required = (type === 'qa');
                }

                updatePollOptionRequirements(type === 'poll');
            }

            function addPollOption(value) {
                if (!pollOptionsContainer) return;

                var row = document.createElement('div');
                row.className = 'input-group mb-2 poll-option-row';
                row.innerHTML =
                    '<input type="text" name="poll_options[]" class="form-control poll-option-input" placeholder="Poll option" value="' + (value || '') + '">' +
                    '<button class="btn btn-outline-danger remove-poll-option" type="button">Remove</button>';
                pollOptionsContainer.appendChild(row);
                toggleFields();
            }

            if (addPollOptionBtn) {
                addPollOptionBtn.addEventListener('click', function() {
                    addPollOption('');
                });
            }

            document.addEventListener('click', function(e) {
                if (!e.target.classList.contains('remove-poll-option')) return;
                var rows = pollOptionsContainer ? pollOptionsContainer.querySelectorAll('.poll-option-row') : [];
                if (rows.length <= 2) return;
                e.target.closest('.poll-option-row').remove();
                toggleFields();
            });

            if (typeField) {
                typeField.addEventListener('change', toggleFields);
            }

            toggleFields();
        })();
    </script>
</x-layouts.front>

