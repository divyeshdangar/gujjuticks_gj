<x-layouts.dashboard-layout :metaData="$metaData">

    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">{{ __('dashboard.image') }}</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>{{ __('dashboard.home') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.image') }}" class="text-decoration-none">
                    <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">{{ __('dashboard.image') }}</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">{{ $dataDetail->title }}</span>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xxl-4 col-sm-12">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.basic_info') }}</h4>
                        <div class="dropdown action-opt">
                            <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('dashboard.image.edit', ['id' => $dataDetail->id]) }}">
                                        <i data-feather="edit-3"></i>
                                        {{ __('dashboard.edit') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 lh-1">
                                <a target="_blank" href="{{ URL::asset('/images/dynamic/' . $dataDetail->image) }}">
                                    <img src="{{ URL::asset('/images/dynamic/' . $dataDetail->image) }}"
                                        class="wh-78 rounded-circle">
                                </a>
                            </div>
                            <div class="flex-grow-1 ms-10">
                                <h4 class="fw-semibold fs-16 mb-0">{{ $dataDetail->width }} x {{ $dataDetail->height }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <h4 class="fs-15 fw-semibold">{{ __('dashboard.title') }}:</h4>
                    <p class="mb-4">{{ $dataDetail->title }}</p>
                    <h4 class="fs-15 fw-semibold">{{ __('dashboard.description') }}:</h4>
                    <p class="mb-4">{{ $dataDetail->description }}</p>
                    <ul class="ps-0 mb-0 list-unstyled">
                        <li class="border-bottom border-color-gray mb-3 pb-3">
                            <span class="fw-semibold text-dark w-130 d-inline-block">{{ __('dashboard.date') }}:</span>
                            <span>{{ $dataDetail->created_at->format('j F, Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-sm-12">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.dynamic_images') }}</h4>
                        <div class="dropdown action-opt">
                            <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                <li>
                                    <a class="dropdown-item" onclick="saveImage()">
                                        <i data-feather="download"></i>
                                        {{ __('dashboard.download') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h4 class="fw-semibold fs-16 mb-0">{{ $dataDetail->width }} x {{ $dataDetail->height }}</h4>
                    </div>
                    <div class="mb-4">
                        <div id="fabric-canvas-wrapper" class="hd-none">
                            <canvas id="canvas" width="{{ $dataDetail->width }}" height="{{ $dataDetail->height }}"
                                style="position: absolute !important;" class="rounded-10"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-sm-12">
            <div class="card bg-white border-0 v mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.image_content') }}</h4>
                    </div>
                    <div class="mb-4">

                        <div class="card bg-white border-0 rounded-10 mb-4">
                            <div class="card-body p-0">
                                <ul class="nav nav-tabs mb-4" id="myTab3" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="preview3-tab" data-bs-toggle="tab"
                                            data-bs-target="#preview3-tab-pane" type="button" role="tab"
                                            aria-controls="preview3-tab-pane" aria-selected="true">{{ __('dashboard.preview') }}</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="code3-tab" data-bs-toggle="tab"
                                            data-bs-target="#code3-tab-pane" type="button" role="tab"
                                            aria-controls="code3-tab-pane" aria-selected="false">{{ __('dashboard.code') }}</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent3">
                                    <div class="tab-pane fade show active" id="preview3-tab-pane" role="tabpanel"
                                        aria-labelledby="preview3-tab" tabindex="0">
                                        <ul class="ps-0 mb-0 list-unstyled o-sortable cursor-move" id="imageDataList">
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="code3-tab-pane" role="tabpanel"
                                        aria-labelledby="code3-tab" tabindex="0">
                                        <div class="form-group mb-4">
                                            <form>
                                                <div class="form-group position-relative">
                                                    <textarea onchange="update(1)" id="options" name="options"
                                                        class="form-control ps-5 text-dark @error('options') border border-danger rounded-3 border-3 @enderror"
                                                        placeholder="{{ __('dashboard.options') }}" rows="20" required>{{ old('options', $dataDetail->options) }}</textarea>
                                                    <i
                                                        class="ri-information-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-2"></i>
                                                </div>
                                                @error('options')
                                                    <div class="text-danger">{{ $options }}</div>
                                                @enderror
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var canvas;
        var objData;
        var selectedObj;
        var selectedIndex;
        var test = 2;
        window.addEventListener('load', function(event) {
            canvas = this.__canvas = new fabric.Canvas('canvas');
            // var imageSaver = document.getElementById('lnkDownload');
            // imageSaver.addEventListener('click', saveImage, false);            
            window.onresize = setResizeCanvas();
            loadFromJson();

            var snapZone = 15;
            canvas.on('object:moving', function(options) {
                // console.log('width', options)
                // console.log('canvas width', canvas.width)
                // console.log('left', options.target.left)
                // console.log('wwwww', options.target.getScaledWidth())
                // console.log('xxxxx', options.target.scaleY)
                var objectMiddle = options.target.left + options.target.width / 2;
                // console.log('middle', objectMiddle)
                if (objectMiddle > canvas.width / 2 - snapZone &&
                    objectMiddle < canvas.width / 2 + snapZone) {
                    options.target.set({
                        left: canvas.width / 2 - options.target.width / 2,
                    }).setCoords();
                    // console.log('to be left', canvas.width / 2 - options.target.width / 2);
                }
            });
        });

        function update(getFromCode = 0) {
            canvas.clear();
            loadFromJson(getFromCode);
        }

        function loadFromJson(getFromCode = 0) {
            if (!objData || getFromCode == 1) {
                var a = document.getElementById('options').value;
                objData = JSON.parse(a);
                generateImageDataList(objData);
            }

            console.log(objData)

            var str = JSON.stringify(objData, undefined, 4);
            document.getElementById('options').innerHTML = str;
            canvas.loadFromJSON(objData, function() {
                setTimeout(() => {
                    canvas.renderAll();                    
                }, 100);
            }, function(o, object) {})
        }

        function generateImageDataList(objData) {
            if (objData.objects && objData.objects.length > 0) {
                let dataListContainer = document.getElementById("imageDataList");
                objData.objects.forEach((element, i) => {

                    let newElement = "";
                    if (element.type == 'image') {
                        newElement =
                            `<img style="max-height:44px" src="`+element.src+`">`;
                    } else if (element.type == 'textbox') {
                        newElement = `<span class="fs-16 fw-semibold text-white">` + element.text.toUpperCase() +
                            `</span>`;
                    } else {
                        newElement = `<span class="fs-16 fw-semibold text-white">` + element.type.toUpperCase() +
                            `</span>`;
                    }
                    newElement = `<li onclick="onClickData(` + i +
                        `)" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" class="bg-primary p-4 rounded-2 mb-3">` +
                        newElement + `</li>`;

                    //dataListContainer.innerHTML = newElement;
                    //dataListContainer.appendChild(newElement)
                    dataListContainer.insertAdjacentHTML('beforeend', newElement);
                });
            }
        }

        function onClickData(index) {


            for (let element of document.getElementsByClassName("canvasEditableElements")) {
                element.classList.add("d-none");
            }

            console.log(this.objData);
            console.log(objData);
            console.log(test);

            selectedObj = objData.objects[index];
            selectedIndex = index;
            for (var prop in selectedObj) {
                if (Object.prototype.hasOwnProperty.call(selectedObj, prop)) {
                    console.log(prop)
                    var element = document.getElementById('canvas_' + prop);
                    var elementContainer = document.getElementById('canvas_' + prop + '_container');
                    switch (prop) {
                        case 'text':
                            elementContainer.classList.remove("d-none");
                            element.value = selectedObj[prop];
                            break;

                        case 'fill':
                            elementContainer.classList.remove("d-none");
                            element.value = selectedObj[prop];
                            break;

                        case 'src':
                            elementContainer.classList.remove("d-none");
                            //element.value = selectedObj[prop];
                            break;

                        default:
                            break;
                    }
                }
            }

        }

        function setResizeCanvas() {
            const outerCanvasContainer = document.getElementById('fabric-canvas-wrapper');
            const newWidth = outerCanvasContainer.clientWidth;
            resizeCanvas(newWidth);
        }

        function resizeCanvas(newWidth) {
            hide();
            const ratio = canvas.getWidth() / canvas.getHeight();
            const scale = newWidth / canvas.getWidth();
            const zoom = canvas.getZoom() * scale;

            canvas.setDimensions({
                width: newWidth,
                height: newWidth / ratio
            });
            canvas.setViewportTransform([zoom, 0, 0, zoom, 0, 0]);
            show();
        }

        function show(element = undefined) {
            if (!element) {
                element = document.getElementById('fabric-canvas-wrapper');
            }
            console.log('show clicked')
            console.log(element)
            element.classList.remove("d-none");
        }

        function hide(element = undefined) {
            if (!element) {
                element = document.getElementById('fabric-canvas-wrapper');
            }
            console.log('hide clicked')
            console.log(element)
            element.classList.add("d-none");
        }

        function saveImage(e) {
            resizeCanvas({{ $dataDetail->width }});
            let href = canvas.toDataURL({
                format: 'jpeg',
                quality: 1
            });

            var anchor = document.createElement('a');
            anchor.setAttribute('href', href);
            anchor.setAttribute('download', '21.jpg');
            anchor.click();

            setResizeCanvas()
        }

        function updateRecord(type, obj = null) {
            var element = document.getElementById('canvas_' + type);
            if (element) {
                switch (type) {
                    case 'text':
                        selectedObj[type] = element.value;
                        break;

                    case 'fill':
                        selectedObj[type] = element.value;
                        break;

                    case 'src':
                        const file = obj.target.files[0];
                        console.log(file);
                        let fileReader = new FileReader();
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function() {
                            console.log(fileReader.result);
                            selectedObj[type] = fileReader.result;
                            // images[0].setAttribute('src', fileReader.result);
                            // images[0].setAttribute('style', `background-image: url('${fileReader.result}')`);
                        }
                        break;

                    default:
                        break;
                }
            }

            objData.objects[selectedIndex] = selectedObj;
            setTimeout(() => {
                update()                
            }, 200);
            console.log(objData)

        }
    </script>



    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom p-4">
            <h5 class="offcanvas-title fs-18 mb-0" id="offcanvasRightLabel">Image Data List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-4">
            <form>
                <div class="canvasEditableElements form-group mb-4" id="canvas_image_container">
                    <label class="label">You Photo</label>
                    <input id="canvas_image" name="canvas_image" type="file" class="form-control text-dark file">
                </div>

                <div class="canvasEditableElements form-group mb-4" id="canvas_text_container">
                    <label class="label">text</label>
                    <textarea onchange="updateRecord('text')" name="canvas_text" id="canvas_text" class="form-control text-dark"
                        placeholder="" rows="3" required></textarea>
                </div>

                <div class="canvasEditableElements form-group mb-4" id="canvas_fill_container">
                    <label class="label">fill</label>
                    <input id="canvas_fill" onchange="updateRecord('fill')" name="canvas_fill" type="color"
                        class="form-control text-dark">
                </div>

                <div class="canvasEditableElements form-group mb-4" id="canvas_src_container">
                    <label class="label">You Photo</label>
                    <input id="canvas_src" onchange="updateRecord('src', event)"
                        name="canvas_src" type="file" accept="image/png, image/jpg, image/jpeg"
                        class="form-control text-dark file">
                </div>


                {{-- <div class="___canvasEditableElements form-group mb-4" id="___canvas_text_container">
                    <label class="label">text</label>
                    <input id="___canvas_text" onchange="updateRecord('text')" name="canvas_text" type="text" class="form-control text-dark">
                </div> --}}

                <div class="form-group d-flex gap-3 d-none">
                    <button class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                        <span class="py-sm-1 d-block">
                            <i class="ri-add-line text-white"></i>
                            <span>Refresh</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.dashboard-layout>