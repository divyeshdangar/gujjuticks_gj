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

                    <form method="post" enctype="multipart/form-data" action="{{ $dataDetail ? route('pages.updates.update', ['slug' => $dataDetail->slug]) : route('pages.updates.store') }}">
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
                                <select name="type" class="form-select" required>
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
                                <textarea name="description" rows="5" class="form-control">{{ old('description', $dataDetail?->description) }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Image (for image type)</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">YouTube URL (for YouTube type)</label>
                                <input type="url" name="youtube_url" class="form-control" value="{{ old('youtube_url', $dataDetail?->youtube_url) }}">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Poll Question (for poll type)</label>
                                <input type="text" name="poll_question" class="form-control mb-2" value="{{ old('poll_question', $dataDetail?->poll_question) }}">
                                @php
                                    $oldOptions = old('poll_options');
                                    $options = $oldOptions ?? ($dataDetail ? $dataDetail->pollOptions->pluck('option_text')->toArray() : ['', '']);
                                    if (count($options) < 2) {
                                        $options = array_pad($options, 2, '');
                                    }
                                @endphp
                                @foreach($options as $option)
                                    <input type="text" name="poll_options[]" class="form-control mb-2" placeholder="Poll option" value="{{ $option }}">
                                @endforeach
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Q&A Question (for Q&A type)</label>
                                <input type="text" name="qa_question" class="form-control" value="{{ old('qa_question', $dataDetail?->qa_question) }}">
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
</x-layouts.front>

