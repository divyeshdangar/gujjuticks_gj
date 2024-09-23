<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-sm-0">{{ $metaData['title'] }}</h4>                        
                    </div>
                    <div class="default-table-area notification-list">
                        <form method="get" id="form">
                            {{-- {{ csrf_field() }} --}}
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <div class="form-group">
                                            <input type="text" name="search"
                                                value="{{ old('search', Request::get('search')) }}"
                                                class="form-control text-dark" placeholder="Search here">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <button type="submit"
                                            class="border-0 btn btn-primary py-2 px-3 px-sm-4 text-white fs-16 rounded-3">
                                            <span class="py-sm-1 d-block">
                                                <span>{{ __('dashboard.search') }}</span>
                                            </span>
                                        </button>
                                        <a href="{{ Request::url() }}" type="reset"
                                            class="btn btn-outline-secondary hover-white py-2 px-3 px-sm-4 fs-16 rounded-3">
                                            <span class="py-sm-1 d-block">
                                                <span>{{ __('dashboard.clear') }}</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-primary">
                                            <label class="form-check-label ms-2"
                                                for="flexCheckDefault">#{{ __('dashboard.id') }}</label>
                                        </th>
                                        <th scope="col">{{ __('dashboard.file') }}</th>
                                        <th scope="col">{{ __('dashboard.status') }}</th>
                                        <th scope="col">{{ __('dashboard.report') }}</th>
                                        <th scope="col">{{ __('dashboard.date') }}</th>
                                        {{-- <th scope="col">{{ __('dashboard.action') }}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataList as $data)
                                        <tr>
                                            <td>
                                                #{{ $data->id }}
                                            </td>
                                            <td>
                                                <a download="{{ $data->file }}" href="{{ URL::asset('import/member/'.$data->file)}}">
                                                    {{ $data->file_original_name }}
                                                </a>
                                            </td>
                                            <td>
                                                {!! $data->status !!}
                                            </td>
                                            <td>
                                                <span class="text-success">{{ __('dashboard.success') }}: {{ $data->success_count }}</span><br>
                                                <span class="text-danger">{{ __('dashboard.failed') }}: {{ $data->failed_count }}</span>
                                            </td>
                                            <td>
                                                {{ $data->created_at->format('j F, Y') }}
                                            </td>
                                            {{-- <td>
                                                <div class="dropdown action-opt">
                                                    <a class="btn bg p-1"
                                                        href="{{ route('dashboard.blog.view', ['id' => $data->id]) }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $dataList->links('vendor.pagination.bootstrap-5') }}
                    </div>
                    @if (count($dataList) == 0)
                        <x-common.empty></x-common.empty>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.import') }}</h4>
                        <div class="dropdown action-opt">
                            <a class="btn bg-transparent p-0" download="member_import_sample.xlsx" href="{{ URL::asset('import/member/member_import_sample.xlsx')}}" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-title="Download sample file">
                                <i data-feather="download"></i>
                            </a>
                        </div>
                    </div>
                    <form method="post" enctype="multipart/form-data" id="formToValidate" action="{{ route('dashboard.member.import.post') }}">
                        {{ csrf_field() }}
                        @if ($errors->any())
                            <div class="text-danger border border-danger border-4 p-3 rounded-3 mb-3">
                                <b>{{ __('dashboard.error') }}:</b>
                                <hr>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <ul class="my-2">
                            <li>Download the file and add your data only.</li>
                            <li>Do not add or rearrange any columns.</li>
                            <li>If the email address exists in our database, a request will be sent to that user.</li>
                            <li>If the value in the <b>"Create new"</b> column is set to <b>"1"</b>, a new user will be created, and a membership request will be sent. This applies only if the email is not already linked to an existing user.</li>
                            <li>If the value in the <b>"Directly accept request"</b> column is set to <b>"1"</b>, the membership request will be automatically accepted. This is applicable only for new users.</li>
                            <li class="text-danger"><b>Please review the details above carefully before using this feature.</b></li>
                        </ul>
                        <div class="form-group mb-4">
                            <label class="label @error('excel_file') text-danger @enderror">{{ __('dashboard.file') }}</label>
                            <input type="file" class="form-control h-58" id="excel_file" name="excel_file" accept=".xlsx">
                            @error('excel_file')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group d-flex gap-3">
                            <button class="btn btn-primary py-3 px-5 fw-semibold text-white">{{ __('dashboard.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
