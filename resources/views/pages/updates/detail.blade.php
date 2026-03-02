<x-layouts.front :showHeader="true" :metaData="$metaData">
    <section class="section">
        <div class="container">
            @if(!$hasAccess)
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        @if($isGuest)
                            <h1 class="h4 mb-2">🔒 Login to see this update</h1>
                            <p class="text-muted mb-3">This update is private. Please login for access.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                        @else
                            <h1 class="h4 mb-2">Private update</h1>
                            <p class="text-muted mb-0">You do not have permission to view this update.</p>
                        @endif
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap justify-content-between gap-3 mb-2">
                            <div>
                                <span class="badge bg-secondary text-uppercase">{{ $dataDetail->type }}</span>
                                <span class="badge @if($dataDetail->privacy === 'public') bg-success @else bg-dark @endif">{{ $dataDetail->privacy }}</span>
                                @if($dataDetail->category?->is_important)
                                    <span class="badge bg-danger">Important</span>
                                @endif
                            </div>
                            <small class="text-muted">{{ $dataDetail->created_at?->format('j M, Y h:i A') }}</small>
                        </div>

                        <h1 class="h3 mb-2">{{ $dataDetail->title }}</h1>
                        <div class="small text-muted mb-3">
                            {{ $dataDetail->city?->name }} | {{ $dataDetail->category?->name }} | by {{ $dataDetail->creator?->name }}
                        </div>

                        @if($dataDetail->type === 'image' && $dataDetail->image)
                            <img src="{{ asset('images/updates/' . $dataDetail->image) }}" class="img-fluid rounded mb-3" alt="{{ $dataDetail->title }}">
                        @endif

                        @if($dataDetail->type === 'youtube' && $dataDetail->youtube_url)
                            <div class="ratio ratio-16x9 mb-3">
                                <iframe src="{{ $dataDetail->youtube_url }}" allowfullscreen></iframe>
                            </div>
                        @endif

                        @if($dataDetail->description)
                            <div class="mb-3">{!! nl2br(e($dataDetail->description)) !!}</div>
                        @endif

                        @if($dataDetail->external_link)
                            <div class="mb-3">
                                <a href="{{ $dataDetail->external_link }}" target="_blank" rel="nofollow noopener">Open external link</a>
                            </div>
                        @endif

                        @if(Auth::check() && Auth::id() === (int)$dataDetail->created_by)
                            <div class="d-flex gap-2 mb-3">
                                <a href="{{ route('pages.updates.edit', ['slug' => $dataDetail->slug]) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                <form method="post" action="{{ route('pages.updates.delete', ['slug' => $dataDetail->slug]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        @endif

                        <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                            <form method="post" action="{{ route('pages.updates.react', ['slug' => $dataDetail->slug]) }}">
                                @csrf
                                <input type="hidden" name="reaction" value="like">
                                <button class="btn btn-outline-primary btn-sm">Like</button>
                            </form>
                            <input type="text" class="form-control form-control-sm" style="max-width: 360px;" readonly value="{{ route('pages.updates.detail', ['slug' => $dataDetail->slug]) }}">
                        </div>
                    </div>
                </div>

                @if($dataDetail->type === 'poll')
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h3 class="h5 mb-3">{{ $dataDetail->poll_question }}</h3>
                            <form method="post" action="{{ route('pages.updates.poll.vote', ['slug' => $dataDetail->slug]) }}">
                                @csrf
                                @foreach($dataDetail->pollOptions as $option)
                                    <label class="d-flex justify-content-between border rounded p-2 mb-2">
                                        <span>
                                            <input type="radio" name="option_id" value="{{ $option->id }}" required>
                                            {{ $option->option_text }}
                                        </span>
                                        <span class="text-muted">{{ $option->votes_count }}</span>
                                    </label>
                                @endforeach
                                <button type="submit" class="btn btn-primary btn-sm">Vote</button>
                            </form>
                        </div>
                    </div>
                @endif

                @if($dataDetail->type === 'qa')
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h3 class="h5 mb-3">{{ $dataDetail->qa_question }}</h3>
                            @auth
                                <form method="post" action="{{ route('pages.updates.answer', ['slug' => $dataDetail->slug]) }}" class="mb-3">
                                    @csrf
                                    <textarea name="answer" rows="3" class="form-control mb-2" placeholder="Write your answer..." required>{{ old('answer') }}</textarea>
                                    <button type="submit" class="btn btn-primary btn-sm">Post Answer</button>
                                </form>
                            @endauth

                            @foreach($dataDetail->answers as $answer)
                                <div class="border rounded p-2 mb-2">
                                    <div class="small text-muted mb-1">{{ $answer->user?->name }} • {{ $answer->created_at?->diffForHumans() }}</div>
                                    <div>{{ $answer->answer }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-3">Comments</h3>

                        @auth
                            <form method="post" action="{{ route('pages.updates.comment.store', ['slug' => $dataDetail->slug]) }}" class="mb-4">
                                @csrf
                                <textarea name="comment" rows="3" class="form-control mb-2" placeholder="Write your comment..." required>{{ old('comment') }}</textarea>
                                <button type="submit" class="btn btn-primary btn-sm">Post Comment</button>
                            </form>
                        @else
                            <p class="text-muted">Login required to comment.</p>
                        @endauth

                        @forelse($dataDetail->comments as $comment)
                            @if($comment->status === 'active' || (Auth::check() && Auth::user()->is_admin()))
                                <div class="border rounded p-3 mb-2">
                                    <div class="small text-muted mb-1">{{ $comment->user?->name }} • {{ $comment->created_at?->diffForHumans() }}</div>
                                    <div class="mb-2">{{ $comment->comment }}</div>
                                    @auth
                                        <div class="d-flex flex-wrap gap-2">
                                            @if(Auth::id() === (int)$comment->user_id || Auth::user()->is_admin())
                                                <form method="post" action="{{ route('pages.updates.comment.delete', ['id' => $comment->id]) }}">
                                                    @csrf
                                                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                                                </form>
                                                <form method="post" action="{{ route('pages.updates.comment.edit', ['id' => $comment->id]) }}">
                                                    @csrf
                                                    <input class="form-control form-control-sm d-inline-block" style="max-width: 320px;" type="text" name="comment" value="{{ $comment->comment }}">
                                                    <button class="btn btn-outline-primary btn-sm mt-1">Edit</button>
                                                </form>
                                            @endif
                                            <form method="post" action="{{ route('pages.updates.comment.report', ['id' => $comment->id]) }}">
                                                @csrf
                                                <button class="btn btn-outline-secondary btn-sm">Report</button>
                                            </form>
                                        </div>
                                    @endauth
                                </div>
                            @endif
                        @empty
                            <p class="text-muted mb-0">No comments yet.</p>
                        @endforelse
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-layouts.front>

