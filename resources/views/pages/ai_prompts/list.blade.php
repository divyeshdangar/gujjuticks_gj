<x-layouts.front :showHeader="true" :metaData="$metaData">

    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 pb-3 me-lg-5">
                        <h6 class="sub-title">Curated for creators & developers</h6>
                        <h1 class="display-5 fw-semibold mb-3">Quality <span class="text-warning fw-bold">AI Prompts</span> by Category</h1>
                        <p class="lead text-muted mb-0">Browse, filter, and copy ready-to-use prompts. Find the right prompt for writing, coding, marketing, and more.</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mt-5 mt-lg-0">
                        <a class="btn btn-warning" href="#prompts-list" style="color: rgb(19, 19, 19) !important;">Browse Prompts</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="prompts-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="blog-post">
                        <form method="get" action="{{ route('pages.ai_prompts.list') }}" class="mb-4">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search by title, description or prompt..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-warning" style="color: rgb(19, 19, 19) !important;">Search</button>
                            </div>
                        </form>

                        @if (count($dataList) > 0)
                            <div class="row mt-2">
                                @foreach ($dataList as $item)
                                    <div class="col-12 mb-4">
                                        <div class="card blog-grid-box h-100 border shadow-sm">
                                            @if($item->image)
                                                <a href="{{ route('pages.ai_prompts.detail', ['slug' => $item->slug]) }}">
                                                    <img src="{{ asset('images/ai-prompts/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 180px; object-fit: cover;" loading="lazy">
                                                </a>
                                            @endif
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                                                    <div>
                                                        <span class="badge bg-secondary text-uppercase small">{{ $item->unique_id }}</span>
                                                        <span class="badge bg-light text-dark ms-1">v{{ $item->prompt_version }}</span>
                                                    </div>
                                                    <span class="text-muted small">{{ number_format($item->copy_count) }} copies</span>
                                                </div>
                                                <h5 class="card-title mb-2">
                                                    <a href="{{ route('pages.ai_prompts.detail', ['slug' => $item->slug]) }}" class="text-decoration-none text-dark">{{ $item->title }}</a>
                                                </h5>
                                                @if($item->description)
                                                    <p class="text-muted small mb-3">{{ Str::limit($item->description, 160) }}</p>
                                                @endif
                                                <div class="bg-light rounded p-3 mb-3 position-relative">
                                                    <pre class="mb-0 small text-dark overflow-auto" style="max-height: 180px; white-space: pre-wrap; word-break: break-word;">{{ Str::limit($item->prompt, 400) }}</pre>
                                                    @if(strlen($item->prompt) > 400)
                                                        <button type="button" class="btn btn-link btn-sm p-0 mt-1" data-bs-toggle="modal" data-bs-target="#promptModal{{ $item->id }}">Show full prompt</button>
                                                        <span class="mx-1">|</span>
                                                        <a href="{{ route('pages.ai_prompts.detail', ['slug' => $item->slug]) }}" class="btn btn-link btn-sm p-0 mt-1">View & share link</a>
                                                    @endif
                                                </div>
                                                <div class="d-flex align-items-center flex-wrap gap-2">
                                                    <button type="button" class="btn btn-warning btn-sm copy-prompt-btn" style="color: rgb(19, 19, 19) !important;"
                                                            data-unique-id="{{ $item->unique_id }}"
                                                            data-prompt="{{ e($item->prompt) }}"
                                                            data-copy-url="{{ route('pages.ai_prompts.copy', ['uniqueId' => $item->unique_id]) }}">
                                                        Copy prompt
                                                    </button>
                                                    <a href="{{ route('pages.ai_prompts.detail', ['slug' => $item->slug]) }}" class="btn btn-outline-primary btn-sm">View & share</a>
                                                    @if($item->category)
                                                        <a href="{{ route('pages.ai_prompts.list', ['category' => $item->category->slug]) }}" class="btn btn-outline-secondary btn-sm">{{ $item->category->name }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if(strlen($item->prompt) > 400)
                                        <div class="modal fade" id="promptModal{{ $item->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ $item->title }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <pre class="bg-light p-3 rounded small" style="white-space: pre-wrap; word-break: break-word;">{{ $item->prompt }}</pre>
                                                        <button type="button" class="btn btn-warning btn-sm copy-prompt-btn mt-2" style="color: rgb(19, 19, 19) !important;"
                                                                data-unique-id="{{ $item->unique_id }}"
                                                                data-prompt="{{ e($item->prompt) }}"
                                                                data-copy-url="{{ route('pages.ai_prompts.copy', ['uniqueId' => $item->unique_id]) }}">Copy prompt</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <div class="col-12 text-center mt-3">
                                    {{ $dataList->links('vendor.pagination.bootstrap-5-new') }}
                                </div>
                            </div>
                        @else
                            <x-common.empty></x-common.empty>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4 col-md-5">
                    <div class="sidebar ms-lg-4 ps-lg-4 mt-5 mt-lg-0">
                        <div class="pt-2">
                            <div class="sd-title">
                                <h6 class="fs-16 mb-3">Categories</h6>
                            </div>
                            <div class="my-3">
                                @php
                                    $queryWithoutCategory = request()->except('category');
                                    $queryWithoutCategory['page'] = 1;
                                @endphp
                                <div class="mb-2">
                                    <a href="{{ route('pages.ai_prompts.list', $queryWithoutCategory) }}" class="{{ !request('category') ? 'fw-bold' : '' }}">All categories</a>
                                </div>
                                @foreach ($categories as $cat)
                                    @php
                                        $queryWithCategory = request()->except('category');
                                        $queryWithCategory['category'] = $cat->slug;
                                        $queryWithCategory['page'] = 1;
                                    @endphp
                                    <div class="mb-2 d-flex align-items-center gap-2">
                                        @if($cat->image)
                                            <img src="{{ asset('images/ai-prompt-categories/' . $cat->image) }}" alt="" class="rounded" style="width: 24px; height: 24px; object-fit: cover;">
                                        @endif
                                        <a href="{{ route('pages.ai_prompts.list', $queryWithCategory) }}" class="{{ request('category') === $cat->slug ? 'fw-bold' : '' }}">{{ $cat->name }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
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
