<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">Business submissions</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>{{ __('dashboard.home') }}</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Business submissions</span>
            </li>
        </ul>
    </div>

    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-flex flex-wrap gap-2 mb-3">
                <a href="{{ route('dashboard.business', ['status' => 'pending']) }}"
                    class="btn btn-sm {{ $status === 'pending' ? 'btn-warning' : 'btn-outline-secondary' }}">
                    Pending ({{ $counts['pending'] }})
                </a>
                <a href="{{ route('dashboard.business', ['status' => 'success']) }}"
                    class="btn btn-sm {{ $status === 'success' ? 'btn-success' : 'btn-outline-secondary' }}">
                    Approved ({{ $counts['success'] }})
                </a>
                <a href="{{ route('dashboard.business', ['status' => 'failed']) }}"
                    class="btn btn-sm {{ $status === 'failed' ? 'btn-danger' : 'btn-outline-secondary' }}">
                    Rejected ({{ $counts['failed'] }})
                </a>
            </div>

            <form method="get" class="row mb-3">
                <input type="hidden" name="status" value="{{ $status }}">
                <div class="col-lg-4">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control text-dark"
                        placeholder="Search name, phone, address">
                </div>
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-primary">{{ __('dashboard.search') }}</button>
                    <a href="{{ route('dashboard.business', ['status' => $status]) }}" class="btn btn-outline-secondary">{{ __('dashboard.clear') }}</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Business</th>
                            <th>City</th>
                            <th>Category</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataList as $data)
                            <tr>
                                <td>#{{ $data->id }}</td>
                                <td class="fw-semibold">{{ $data->name }}</td>
                                <td>{{ $data->city?->name ?? '—' }}</td>
                                <td>{{ $data->placeCategory?->label ?? '—' }}</td>
                                <td>{{ $data->phone ?: '—' }}</td>
                                <td>
                                    @if ($data->status === 'success')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif ($data->status === 'failed')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>{{ $data->created_at?->format('M j, Y') }}</td>
                                <td>
                                    <a href="{{ route('dashboard.business.view', $data->id) }}" class="link-primary">Review</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-muted text-center py-4">No submissions in this filter.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $dataList->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

</x-layouts.dashboard>
