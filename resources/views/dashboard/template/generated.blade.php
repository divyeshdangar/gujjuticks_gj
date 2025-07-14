<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">Generated Pages</h4>
                        <div class="action-opt">
                            @php
                                $link = env('LINK_APP_URL') . '/p/' . $dataDetail->slug;
                            @endphp
                            <a href="{{ $link.'?create=true' }}" target="_blank" class="btn bg-transparent p-0">
                                <i data-feather="link"></i>
                            </a>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">
                            @if (count($dataList) > 0)
                                @foreach ($dataList as $data)
                                    <div class="col-md-4 mb-5">
                                        @php
                                            $l = $link . '?id=' . $data->link;
                                        @endphp
                                        <iframe class="rounded-10 border border-2 border-dark" height="580"
                                            width="100%" src="{{ $l }}" allowfullscreen></iframe>
                                        <div class="">
                                            <div class="btn-group w-100" role="group"
                                                aria-label="Basic mixed styles example">
                                                <a href="{{ $l . '&edit=' . md5('Gujju.Me_' . $dataDetail->id) }}"
                                                    target="_blank" class="btn btn-dark">Edit</a>
                                                <a href="{{ $l }}" target="_blank"
                                                    class="btn btn-dark">Open</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{ $dataList->links('vendor.pagination.bootstrap-5') }}
                            @else
                                <div class="col-md-12">
                                    <x-common.empty></x-common.empty>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-layouts.dashboard>
