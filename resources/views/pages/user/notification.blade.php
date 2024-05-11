<x-layouts.dashboard-layout :metaData="$metaData">

    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">{{ __('dashboard.notification') }}</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>{{ __('dashboard.home') }}</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">{{ __('dashboard.notification') }}</span>
            </li>
        </ul>
    </div>
    <div class="card bg-white border-0 rounded-10 mb-4">
        <div class="card-body p-4">
            <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
                <h4 class="fw-semibold fs-18 mb-sm-0">{{ __('dashboard.notification') }}</h4>
            </div>
           
            <div class="default-table-area notification-list">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <tbody>
                            @foreach ($dataList as $data)
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <span class="w-600 text-truncate fw-semibold position-relative" style="top: 1px;">
                                                {{ $data->msg }}
                                            <span>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0 fs-14">
                                        <span>{{ $data->created_at }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-layouts.dashboard-layout>