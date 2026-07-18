<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">Review business</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard.business') }}" class="text-decoration-none">
                    <span>Business submissions</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Detail</span>
            </li>
        </ul>
    </div>

    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
                <div>
                    <h4 class="fw-semibold mb-1">{{ $dataDetail->name }}</h4>
                    <p class="text-muted mb-0">
                        @if ($dataDetail->status === 'success')
                            <span class="badge bg-success">Approved (public)</span>
                        @elseif ($dataDetail->status === 'failed')
                            <span class="badge bg-danger">Rejected</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending review</span>
                        @endif
                    </p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    @if ($dataDetail->status !== 'success')
                        <a href="{{ route('dashboard.business.approve', $dataDetail->id) }}"
                            class="btn btn-success"
                            onclick="return confirm('Publish this business to the city directory?')">
                            Approve &amp; publish
                        </a>
                    @endif
                    @if ($dataDetail->status !== 'failed')
                        <a href="{{ route('dashboard.business.reject', $dataDetail->id) }}"
                            class="btn btn-outline-danger"
                            onclick="return confirm('Reject this submission? It will stay off public listings.')">
                            Reject
                        </a>
                    @endif
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <p class="mb-1 text-muted small">City</p>
                    <p class="fw-semibold">{{ $dataDetail->city?->name ?? '—' }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted small">Category</p>
                    <p class="fw-semibold">{{ $dataDetail->placeCategory?->label ?? '—' }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted small">Phone</p>
                    <p class="fw-semibold">
                        @if ($dataDetail->phone)
                            <a href="tel:{{ $dataDetail->phone }}">{{ $dataDetail->phone }}</a>
                        @else
                            —
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted small">Website</p>
                    <p class="fw-semibold">
                        @if ($dataDetail->website)
                            <a href="{{ $dataDetail->website }}" target="_blank" rel="noopener noreferrer">{{ $dataDetail->website }}</a>
                        @else
                            —
                        @endif
                    </p>
                </div>
                <div class="col-12">
                    <p class="mb-1 text-muted small">Address</p>
                    <p class="fw-semibold">{{ $dataDetail->address ?: '—' }}</p>
                </div>
                <div class="col-12">
                    <p class="mb-1 text-muted small">Description</p>
                    <p>{{ $dataDetail->description ?: '—' }}</p>
                </div>
                @if ($dataDetail->icon)
                    <div class="col-12">
                        <p class="mb-1 text-muted small">Logo</p>
                        <img src="{{ asset(config('paths.images.business_logo') . $dataDetail->icon) }}"
                            alt="" width="120" height="120" class="rounded border">
                    </div>
                @endif
                <div class="col-md-6">
                    <p class="mb-1 text-muted small">Submitted</p>
                    <p>{{ $dataDetail->created_at?->format('M j, Y g:i A') }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted small">Slug</p>
                    <p><code>{{ $dataDetail->slug }}</code></p>
                </div>
            </div>
        </div>
    </div>

</x-layouts.dashboard>
