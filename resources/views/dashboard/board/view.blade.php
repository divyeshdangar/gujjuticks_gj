<x-layouts.dashboard-layout :showHeader="true" :metaData="$metaData">
    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif
    <style>
        .kanban-container>div {
            border-radius: 10px;
        }

        .kanban-board {
            background: #fff;
            border-radius: 20px;
        }

        .kanban-item {
            padding: 0px;
        }
    </style>
    <div class="">

        <div class="my-2">

            <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom pb-4">
                <div class="d-flex align-items-center mb-3 mb-sm-0">
                    <div class="flex-shrink-0">
                        <img src="{{ $dataDetail->user->profile }}" class="wh-60 rounded-circle" alt="user">
                    </div>

                    <div class="flex-grow-1 ms-3">
                        <h4 class="fs-16 fw-semibold mb-1">{{ ucwords($dataDetail->user->name) }}</h4>
                        <span class="fs-14 text-primary">Creator</span>
                    </div>
                </div>
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div class="mb-3 mb-sm-0">
                        <span
                            class="fs-12 mb-1 d-block fw-semibold text-gray-light">{{ $dataDetail->created_at->format('j F, Y') }}</span>
                        <span class="fw-semibold d-block">{{ $dataDetail->categories ? count($dataDetail->categories) : 0 }} Items</span>
                    </div>
                </div>
                <ul class="ps-0 mb-0 list-unstyled d-flex">
                    @foreach ($dataDetail->users as $user)
                        <li @if ($loop->index) class="ms-8" @endif>
                            <img src="{{ $user->user->profile }}"
                                class="wh-38 rounded-circle border border-2 border-color-white" alt="user"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="{{ ucwords($user->user->name) }}">
                        </li>
                    @endforeach

                    @if (count($dataDetail->users) > 3)
                        <li class="ms-1">
                            <a href="{{ route('dashboard.board.items', ['id' => $dataDetail->id]) }}"
                                class="wh-38 rounded-circle bg-success bg-opacity-10 text-success text-decoration-none d-inline-block text-center position-relative">
                                <span
                                    class="position-absolute top-50 start-50 translate-middle">+{{ count($dataDetail->users) - 3 }}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div id="GT_Board" class="table-responsive py-2 mb-5"></div>

    </div>

    <script>
        window.addEventListener('load', function(event) {
            var KanbanTest = new jKanban({
                element: "#GT_Board",
                gutter: "10px",
                widthBoard: "350px",
                class: "rounded-3",
                itemHandleOptions: {
                    enabled: false
                },
                click: function(el) {
                    //console.log(el.dataset.eid)
                },
                context: function(el, e) {
                    //console.log("Trigger on all items right-click!");
                },
                dropEl: function(el, target, source, sibling) {
                    let data = {
                        board_id : {{ $dataDetail->id }},
                        category_id : target.parentElement.getAttribute('data-id').replace("BRD-", ""),
                        item_id : el.dataset.eid.replace("GTS-", ""),
                        _token: "{{ csrf_token() }}",
                    }
                    call(data);
                },
                dragBoards: false,
                boards: {{ Js::from($populatedData) }}
            });

            function call(data) {
                fetch("https://www.gujjuticks.com/dashboard/work-item/edit", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }).then(res => {
                    //console.log("Request complete! response:", res);
                });
            }
        });
    </script>

</x-layouts.dashboard-layout>
