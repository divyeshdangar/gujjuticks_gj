<x-layouts.front :showHeader="true" :metaData="$metaData">

    <section class="bg-home2" id="home" style="background-color: rgb(48 56 65);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="mb-4 pb-3 me-lg-5">
                        <h6 class="sub-title">Curated for creators & developers</h6>
                        <h1 class="display-5 fw-semibold mb-3"><span class="text-warning fw-bold">AI Prompts</span> Library – Image, Video, Writing, Marketing, Coding & More</h1>
                        <p class="lead text-muted mb-0">Explore a curated library of AI prompts for image generation, video creation, writing, marketing, coding, business, social media, automation, and more. Discover, copy, and share category-wise AI prompts to get better results from AI tools.</p>
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
                                                @if($item->meta_description)
                                                    <p class="text-muted small mb-3">{{ Str::limit($item->meta_description, 160) }}</p>
                                                @endif
                                                <div class="bg-light rounded p-3 mb-3 position-relative">
                                                    <pre class="mb-0 small text-dark overflow-auto" style="max-height: 180px; white-space: pre-wrap; word-break: break-word;">{{ Str::limit($item->prompt, 100) }}</pre>
                                                </div>
                                                <div class="d-flex align-items-center flex-wrap gap-2">
                                                    <button type="button" class="d-none btn btn-warning btn-sm copy-prompt-btn" style="color: rgb(19, 19, 19) !important;"
                                                            data-unique-id="{{ $item->unique_id }}"
                                                            data-prompt="{{ e($item->prompt) }}"
                                                            data-copy-url="{{ route('pages.ai_prompts.copy', ['uniqueId' => $item->unique_id]) }}">
                                                        Copy prompt
                                                    </button>
                                                    <a href="{{ route('pages.ai_prompts.detail', ['slug' => $item->slug]) }}" class="btn btn-warning btn-sm" style="color: rgb(19, 19, 19) !important;">View & share</a>
                                                    @if($item->category)
                                                        <a href="{{ route('pages.ai_prompts.category', ['slug' => $item->category->slug]) }}" class="btn btn-outline-secondary btn-sm">{{ $item->category->name }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
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
                                <div class="mb-2">
                                    <a href="{{ route('pages.ai_prompts.list') }}" class="fw-bold">All categories</a>
                                </div>
                                @foreach ($categories as $cat)
                                    <div class="mb-2 d-flex align-items-center gap-2">
                                        @if(false && $cat->image) <!--Added false condition -->
                                            <img src="{{ asset('images/ai-prompt-categories/' . $cat->image) }}" alt="" class="rounded" style="width: 24px; height: 24px; object-fit: cover;">
                                        @endif
                                        <a href="{{ route('pages.ai_prompts.category', ['slug' => $cat->slug]) }}">{{ $cat->name }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <h3 class="mb-3">AI Prompts Library for Creators, Developers & Marketers</h3>
                    <p class="text-muted">Discover a growing library of high-quality AI prompts organized by category to help you get better results from AI tools.</p>
                    <p class="text-muted">Whether you are creating viral images and videos, writing content, building products, marketing your brand, coding faster, or automating workflows - you will find ready-to-use prompts designed for real-world use cases.</p>
                    <p class="text-muted">Browse prompts by category, copy instantly, and explore trending prompts used by creators, founders, developers, and marketers. New prompts are added regularly, and community contributions are coming soon.</p>
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
