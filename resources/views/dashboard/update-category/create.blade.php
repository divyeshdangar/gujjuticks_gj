<x-layouts.dashboard :showHeader="true" :metaData="$metaData">
    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">Create Update Category</h4>

            @if ($errors->any())
                <div class="text-danger border border-danger border-4 p-3 rounded-3 mb-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('dashboard.update.category.edit.post', ['id' => 0]) }}">
                @csrf
                @include('dashboard.update-category.partials.form', ['dataDetail' => null])
                <button class="btn btn-primary py-2 px-4 text-white">Save</button>
            </form>
        </div>
    </div>
</x-layouts.dashboard>

