<x-layouts.front :showHeader="true" :metaData="$metaData">

    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 pb-3 me-lg-5">
                        @if($dataDetail->category)
                            <a href="{{ route('pages.ai_prompts.category', ['slug' => $dataDetail->category->slug]) }}" class="text-warning text-decoration-none">
                                <h6 class="sub-title">{{ $dataDetail->category->name }}</h6>
                            </a>
                        @endif
                        <h1 class="display-6 fw-semibold mb-3">{{ $dataDetail->title }}</h1>
                        <p class="lead text-muted mb-0">{{ $dataDetail->meta_description ?? $dataDetail->description }}</p>
                        <ul class="list-inline mt-3 mb-0 text-muted small">
                            <li class="list-inline-item">
                                <span class="badge bg-secondary text-uppercase small">{{ $dataDetail->unique_id }}</span>
                            </li>
                            <li class="list-inline-item">Version {{ $dataDetail->prompt_version }}</li>
                            <li class="list-inline-item">{{ number_format($dataDetail->copy_count) }} copies</li>
                        </ul>
                    </div>
                </div>
                @if($dataDetail->image)
                    <div class="col-lg-5">
                        <div class="mt-4 mt-lg-0">
                            <img src="{{ asset('images/ai-prompts/' . $dataDetail->image) }}" alt="{{ $dataDetail->title }}" class="img-fluid rounded-4 shadow" loading="lazy">
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title border-bottom pb-2 mb-3">Prompt details</h5>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge bg-secondary text-uppercase small">{{ $dataDetail->unique_id }}</span>
                                <span class="badge bg-light text-dark">v{{ $dataDetail->prompt_version }}</span>
                                <span class="badge bg-info text-dark">{{ number_format($dataDetail->copy_count) }} copies</span>
                                @if($dataDetail->category)
                                    <a href="{{ route('pages.ai_prompts.category', ['slug' => $dataDetail->category->slug]) }}" class="badge bg-warning text-dark text-decoration-none">{{ $dataDetail->category->name }}</a>
                                @endif
                            </div>
                            @if($dataDetail->description)
                                <p class="text-muted mb-4">{{ $dataDetail->description }}</p>
                            @endif
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Prompt text</label>
                                <div class="bg-light rounded p-3 position-relative">
                                    <pre id="detail-prompt-text" class="mb-0 small text-dark overflow-auto" style="max-height: 400px; white-space: pre-wrap; word-break: break-word;">{{ $dataDetail->prompt }}</pre>
                                </div>
                                <button type="button" class="btn btn-warning btn-sm mt-2 copy-prompt-btn" style="color: rgb(19, 19, 19) !important;"
                                        data-unique-id="{{ $dataDetail->unique_id }}"
                                        data-prompt="{{ e($dataDetail->prompt) }}"
                                        data-copy-url="{{ route('pages.ai_prompts.copy', ['uniqueId' => $dataDetail->unique_id]) }}">
                                    Copy prompt
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card border shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title border-bottom pb-2 mb-4">Comments ({{ $dataDetail->comments->count() }})</h5>

                            @if(auth()->check())
                                <form method="post" action="{{ route('pages.ai_prompts.comment.store', ['slug' => $dataDetail->slug]) }}" class="mb-4">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Add a comment</label>
                                        <textarea name="comment" id="comment" class="form-control @error('comment') is-invalid @enderror" rows="3" placeholder="Share your experience or tips with this prompt..." maxlength="2000">{{ old('comment') }}</textarea>
                                        @error('comment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Only logged-in users can comment. Be respectful.</div>
                                    </div>
                                    <button type="submit" class="btn btn-warning" style="color: rgb(19, 19, 19) !important;">Post comment</button>
                                </form>
                            @else
                                <p class="text-muted mb-4">
                                    <a href="{{ route('login') }}" class="btn btn-outline-warning btn-sm">Log in</a> to add a comment. You can read all comments below.
                                </p>
                            @endif

                            <div class="comments-list">
                                @forelse($dataDetail->comments as $comment)
                                    <div class="d-flex gap-3 mb-4 pb-3 border-bottom">
                                        <div class="flex-shrink-0">
                                            @if($comment->user)
                                                <img src="{{ $comment->user->profile() }}" alt="" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white" style="width: 40px; height: 40px;">U</div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <span class="fw-semibold">{{ $comment->user ? $comment->user->name : 'User' }}</span>
                                                <span class="text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="mb-0 text-muted small">{{ nl2br(e($comment->comment)) }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">No comments yet. Be the first to share your experience!</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar ms-lg-4 ps-lg-4">
                        <div class="card border shadow-sm mb-4">
                            <div class="card-body">
                                <h6 class="fs-16 mb-3">Categories</h6>
                                <div class="my-2">
                                    <a href="{{ route('pages.ai_prompts.list') }}" class="d-block py-1 text-decoration-none">All categories</a>
                                    @foreach ($categories as $cat)
                                        <a href="{{ route('pages.ai_prompts.category', ['slug' => $cat->slug]) }}" class="d-block py-1 text-decoration-none {{ $dataDetail->category && $dataDetail->category->id === $cat->id ? 'fw-bold text-warning' : '' }}">{{ $cat->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @if($relatedList->isNotEmpty())
                            <div class="card border shadow-sm">
                                <div class="card-body">
                                    <h6 class="fs-16 mb-3">Related prompts</h6>
                                    <div class="d-flex flex-column gap-2">
                                        @foreach($relatedList as $rel)
                                            <a href="{{ route('pages.ai_prompts.detail', ['slug' => $rel->slug]) }}" class="text-decoration-none">
                                                <div class="p-2 rounded bg-light hover-shadow">
                                                    <span class="badge bg-secondary small">{{ $rel->unique_id }}</span>
                                                    <span class="d-block mt-1 small fw-semibold text-dark">{{ $rel->title }}</span>
                                                    <span class="small text-muted">{{ number_format($rel->copy_count) }} copies</span>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="ai-prompts-csrf" data-csrf="{{ csrf_token() }}" class="d-none"></div>
    <script>
        (function() {
            var csrfEl = document.getElementById('ai-prompts-csrf');
            var csrfToken = csrfEl ? csrfEl.getAttribute('data-csrf') : '';
            document.querySelectorAll('.copy-prompt-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var prompt = this.getAttribute('data-prompt');
                    var url = this.getAttribute('data-copy-url');
                    if (!prompt) return;
                    navigator.clipboard.writeText(prompt).then(function() {
                        var label = btn.innerHTML;
                        btn.innerHTML = 'Copied!';
                        btn.disabled = true;
                        setTimeout(function() { btn.innerHTML = label; btn.disabled = false; }, 2000);
                        if (url && csrfToken) {
                            var fd = new FormData();
                            fd.append('_token', csrfToken);
                            fetch(url, { method: 'POST', body: fd, headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } }).catch(function() {});
                        }
                    });
                });
            });
        })();
    </script>
</x-layouts.front>
