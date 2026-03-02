<x-layouts.dashboard :showHeader="true" :metaData="$metaData">
    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">Update Categories</h4>
                <a href="{{ route('dashboard.update.category.create') }}" class="border-0 btn btn-primary py-2 px-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Update Category</span>
                    </span>
                </a>
            </div>

            <form method="get" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <input class="form-control" name="search" value="{{ request('search') }}" placeholder="Search category">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary">Search</button>
                        <a href="{{ request()->url() }}" class="btn btn-outline-secondary">Clear</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Important</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataList as $data)
                            <tr>
                                <td>#{{ $data->id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->slug }}</td>
                                <td>{!! $data->is_important ? '<span class="badge text-bg-danger">Yes</span>' : '<span class="badge text-bg-secondary">No</span>' !!}</td>
                                <td>{!! $data->is_active ? '<span class="badge text-bg-success">Yes</span>' : '<span class="badge text-bg-dark">No</span>' !!}</td>
                                <td>
                                    <a class="btn bg p-1" href="{{ route('dashboard.update.category.edit', ['id' => $data->id]) }}">
                                        <i data-feather="edit-3"></i>
                                    </a>
                                    <a class="btn bg p-1" onclick="confirmAndDelete('{{ route('dashboard.update.category.delete', ['id' => $data->id]) }}')">
                                        <i data-feather="trash-2"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $dataList->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</x-layouts.dashboard>

