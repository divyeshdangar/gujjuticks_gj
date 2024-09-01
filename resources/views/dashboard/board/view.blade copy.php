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

        /* @foreach ($dataDetail->categories as $data)
            .ct_bg_color_{{ $data->id }} {
                background-color: {{ $data->color }} !important;
            }
        @endforeach */
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

        <div id="myKanban" class="table-responsive py-2"></div>

    </div>

    <script>
        window.addEventListener('load', function(event) {
            var KanbanTest = new jKanban({
                element: "#myKanban",
                gutter: "10px",
                widthBoard: "350px",
                class: "rounded-3",
                itemHandleOptions: {
                    enabled: false
                },
                click: function(el) {
                    //console.log("Trigger on all items click!");
                },
                context: function(el, e) {
                    //console.log("Trigger on all items right-click!");
                },
                dropEl: function(el, target, source, sibling) {
                    //console.log(target.parentElement.getAttribute('data-id'));
                    //console.log(el.dataset.eid)
                },
                dragBoards: false,
                boards: [
                    @foreach ($dataDetail->categories as $data)
                        {
                            id: "{{ $data->id }}",
                            title: "{{ $data->title }}",
                            class: "text-light,rounded-3,ct_bg_color_{{ $data->id }}",
                            item: [
                                @foreach ($data->items as item)
                                    {
                                        id: "{{ $item->id }}",
                                        title: "{{ $item->title }}",
                                    },
                                @endforeach
                            ]
                        },
                    @endforeach
                    // {
                    //     id: "_todo",
                    //     title: "To Do (Can drop item only in working)",
                    //     class: "bg-success,text-light,rounded-3",
                    //     dragTo: ["_working"],
                    //     item: [{
                    //             id: "1",
                    //             title: `<div class="bg-gray-div p-4 rounded-10 border border-grey">                                    
                //                     <h4 class="fs-16 fw-semibold body-font mb-2">Mobile App Development</h4>
                //                     <span class="fs-14 fw-semibold d-block mb-3 text-gray-light">Mobile App</span>
                //                     <div class="d-flex justify-content-between align-items-center">
                //                         <span>0/10</span>
                //                         <ul class="ps-0 mb-0 list-unstyled d-flex">
                //                             <li>
                //                                 <img src="{{ asset('assets/images/user-1.jpg') }}" class="wh-25 rounded-circle border border-2 border-color-white" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Jordan Stevenson">
                //                             </li>
                //                             <li class="ms-8">
                //                                 <img src="{{ asset('assets/images/user-2.jpg') }}" class="wh-25 rounded-circle border border-2 border-color-white" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                //                             </li>
                //                             <li class="ms-8">
                //                                 <img src="{{ asset('assets/images/user-3.jpg') }}" class="wh-25 rounded-circle border border-2 border-color-white" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                //                             </li>                                            
                //                         </ul>
                //                     </div>
                //                 </div>`,
                    //         },
                    //         {
                    //             id: "2",
                    //             title: `<div class="bg-gray-div p-4 rounded-10 border border-grey">                                    
                //                     <h4 class="fs-16 fw-semibold body-font mb-2">Mobile App Development</h4>
                //                     <span class="fs-14 fw-semibold d-block mb-3 text-gray-light">Mobile App</span>
                //                     <div class="d-flex justify-content-between align-items-center">
                //                         <span>0/10</span>
                //                         <ul class="ps-0 mb-0 list-unstyled d-flex">
                //                             <li>
                //                                 <img src="{{ asset('assets/images/user-1.jpg') }}" class="wh-25 rounded-circle border border-2 border-color-white" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Jordan Stevenson">
                //                             </li>
                //                             <li class="ms-8">
                //                                 <img src="{{ asset('assets/images/user-2.jpg') }}" class="wh-25 rounded-circle border border-2 border-color-white" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Easin Arafat">
                //                             </li>
                //                             <li class="ms-8">
                //                                 <img src="{{ asset('assets/images/user-3.jpg') }}" class="wh-25 rounded-circle border border-2 border-color-white" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Francis Frank">
                //                             </li>
                //                         </ul>
                //                     </div>
                //                 </div>`,
                    //         }
                    //     ]
                    // }
                ]
            });

            // var toDoButton = document.getElementById("addToDo");
            // toDoButton.addEventListener("click", function() {
            //     KanbanTest.addElement("_todo", {
            //         title: "Test Add"
            //     });
            // });

            // var toDoButtonAtPosition = document.getElementById("addToDoAtPosition");
            // toDoButtonAtPosition.addEventListener("click", function() {
            //     KanbanTest.addElement("_todo", {
            //         title: "Test Add at Pos"
            //     }, 1);
            // });

            // var addBoardDefault = document.getElementById("addDefault");
            // addBoardDefault.addEventListener("click", function() {
            //     KanbanTest.addBoards([{
            //         id: "_default",
            //         title: "Kanban Default",
            //         item: [{
            //                 title: "Default Item"
            //             },
            //             {
            //                 title: "Default Item 2"
            //             },
            //             {
            //                 title: "Default Item 3"
            //             }
            //         ]
            //     }]);
            // });

            // var removeBoard = document.getElementById("removeBoard");
            // removeBoard.addEventListener("click", function() {
            //     KanbanTest.removeBoard("_done");
            // });

            // var removeElement = document.getElementById("removeElement");
            // removeElement.addEventListener("click", function() {
            //     KanbanTest.removeElement("_test_delete");
            // });

            // var allEle = KanbanTest.getBoardElements("_todo");
            // allEle.forEach(function(item, index) {
            //     //console.log(item);
            // });
        });
    </script>

</x-layouts.dashboard-layout>
