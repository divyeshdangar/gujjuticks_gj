<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
