<x-layouts.front :showHeader="true" :metaData="$metaData">
    <section class="bg-home2" style="background-color: rgb(48 56 65);">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h6 class="sub-title mb-2">{{ $dataDetail ? 'Edit your update' : 'Create a community update' }}</h6>
                    <h1 class="h3 mb-0">{{ $dataDetail ? 'Edit Update' : 'Post New Update' }}</h1>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ route('pages.updates.list') }}" class="btn btn-outline-light btn-sm">← Back to feed</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card border shadow-sm">
                        <div class="card-body p-4 p-md-5">
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
                                    <div class="col-12">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control form-control-lg" required value="{{ old('title', $dataDetail?->title) }}" placeholder="What is this update about?">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">City <span class="text-danger">*</span></label>
                                        <select name="city_id" class="form-select" required>
                                            <option value="">Select city</option>
                                            @foreach($cityData as $city)
                                                <option value="{{ $city->id }}" @selected((string) old('city_id', $dataDetail?->city_id) === (string) $city->id)>{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Category <span class="text-danger">*</span></label>
                                        <select name="update_category_id" class="form-select" required>
                                            <option value="">Select category</option>
                                            @foreach($categoryData as $category)
                                                <option value="{{ $category->id }}" @selected((string) old('update_category_id', $dataDetail?->update_category_id) === (string) $category->id)>
                                                    {{ $category->name }}@if($category->is_important) (Important)@endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Privacy <span class="text-danger">*</span></label>
                                        <select name="privacy" class="form-select" required>
                                            @foreach($privacyOptions as $privacy)
                                                <option value="{{ $privacy }}" @selected(old('privacy', $dataDetail?->privacy ?? 'public') === $privacy)>{{ ucfirst($privacy) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Post type <span class="text-danger">*</span></label>
                                        <select id="update-type" name="type" class="form-select" required>
                                            @foreach($types as $value => $label)
                                                <option value="{{ $value }}" @selected(old('type', $dataDetail?->type ?? 'status') === $value)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">External link (optional)</label>
                                        <input type="url" name="external_link" class="form-control" placeholder="https://..." value="{{ old('external_link', $dataDetail?->external_link) }}">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea id="description-field" name="description" rows="5" class="form-control" placeholder="Add details your community should know...">{{ old('description', $dataDetail?->description) }}</textarea>
                                        <small class="text-muted">Required for status updates. Optional for other types.</small>
                                    </div>

                                    <div class="col-md-6 update-type-section" data-types="image">
                                        <label class="form-label">Image</label>
                                        <input id="image-field" type="file" name="image" class="form-control" accept="image/*">
                                        @if($dataDetail?->image)
                                            <small class="text-muted d-block mt-1">Current: {{ $dataDetail->image }}</small>
                                        @endif
                                    </div>
                                    <div class="col-md-6 update-type-section" data-types="youtube">
                                        <label class="form-label">YouTube URL</label>
                                        <input id="youtube-field" type="url" name="youtube_url" class="form-control" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('youtube_url', $dataDetail?->youtube_url) }}">
                                    </div>

                                    <div class="col-12 update-type-section" data-types="poll">
                                        <div class="p-3 rounded border">
                                            <label class="form-label">Poll question</label>
                                            <input id="poll-question-field" type="text" name="poll_question" class="form-control mb-3" placeholder="Ask your poll question..." value="{{ old('poll_question', $dataDetail?->poll_question) }}">
                                            @php
                                                $oldOptions = old('poll_options');
                                                $options = $oldOptions ?? ($dataDetail ? $dataDetail->pollOptions->pluck('option_text')->toArray() : ['', '']);
                                                if (count($options) < 2) {
                                                    $options = array_pad($options, 2, '');
                                                }
                                            @endphp
                                            <label class="form-label">Options</label>
                                            <div id="poll-options-container">
                                                @foreach($options as $option)
                                                    <div class="input-group mb-2 poll-option-row">
                                                        <input type="text" name="poll_options[]" class="form-control poll-option-input" placeholder="Option" value="{{ $option }}">
                                                        <button class="btn btn-outline-danger remove-poll-option" type="button">Remove</button>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button type="button" id="add-poll-option" class="btn btn-sm btn-outline-warning">+ Add option</button>
                                        </div>
                                    </div>

                                    <div class="col-12 update-type-section" data-types="qa">
                                        <label class="form-label">Q&amp;A question</label>
                                        <input id="qa-question-field" type="text" name="qa_question" class="form-control" placeholder="What do you want the community to answer?" value="{{ old('qa_question', $dataDetail?->qa_question) }}">
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top">
                                    <button type="submit" class="btn btn-warning" style="color: rgb(19, 19, 19) !important;">{{ $dataDetail ? 'Save changes' : 'Publish update' }}</button>
                                    <a href="{{ route('pages.updates.list') }}" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
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
                getPollInputs().forEach(function(input, index) {
                    input.required = isPoll && index < 2;
                });
            }

            function toggleFields() {
                var type = typeField ? typeField.value : 'status';

                sections.forEach(function(section) {
                    var allowedTypes = section.getAttribute('data-types').split(',');
                    section.style.display = allowedTypes.indexOf(type) >= 0 ? '' : 'none';
                });

                if (descriptionField) descriptionField.required = (type === 'status');
                if (imageField) imageField.required = (type === 'image' && !hasExistingImage);
                if (youtubeField) youtubeField.required = (type === 'youtube');
                if (pollQuestionField) pollQuestionField.required = (type === 'poll');
                if (qaQuestionField) qaQuestionField.required = (type === 'qa');

                updatePollOptionRequirements(type === 'poll');
            }

            function addPollOption(value) {
                if (!pollOptionsContainer) return;
                var row = document.createElement('div');
                row.className = 'input-group mb-2 poll-option-row';
                row.innerHTML = '<input type="text" name="poll_options[]" class="form-control poll-option-input" placeholder="Option" value="' + (value || '') + '">' +
                    '<button class="btn btn-outline-danger remove-poll-option" type="button">Remove</button>';
                pollOptionsContainer.appendChild(row);
                toggleFields();
            }

            if (addPollOptionBtn) {
                addPollOptionBtn.addEventListener('click', function() { addPollOption(''); });
            }

            document.addEventListener('click', function(e) {
                if (!e.target.classList.contains('remove-poll-option')) return;
                var rows = pollOptionsContainer ? pollOptionsContainer.querySelectorAll('.poll-option-row') : [];
                if (rows.length <= 2) return;
                e.target.closest('.poll-option-row').remove();
                toggleFields();
            });

            if (typeField) typeField.addEventListener('change', toggleFields);
            toggleFields();
        })();
    </script>
</x-layouts.front>
