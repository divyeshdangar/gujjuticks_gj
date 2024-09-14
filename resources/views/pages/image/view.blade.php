<x-layouts.simple-layout :showHeader="true" :metaData="$metaData">

    {{-- @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :isPublicPage="true" :metaData="$metaData"></x-common.breadcrumb>
    @endif --}}

    <div class="row">
        <div class="col-md-3">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.basic_info') }}</h4>                        
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 lh-1">
                                <a target="_blank" href="{{ URL::asset('/images/dynamic/' . $dataDetail->image) }}">
                                    <img src="{{ URL::asset('/images/dynamic/' . $dataDetail->image) }}"
                                        class="wh-78 rounded-10">
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
                    <p class="mb-4">{!! $dataDetail->description !!}</p>
                    <ul class="ps-0 mb-0 list-unstyled">
                        <li class="border-bottom border-color-gray mb-3 pb-3">
                            <span class="fw-semibold text-dark w-130 d-inline-block">{{ __('dashboard.date') }}:</span>
                            <span>{{ $dataDetail->created_at->format('j F, Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-5">
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
                        <div id="fabric-canvas-wrapper" class="hd-none">
                            <canvas id="canvas" width="{{ $dataDetail->width }}" height="{{ $dataDetail->height }}"
                                style="position: absolute !important;" class="rounded-10"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
                                            data-bs-target="#previewTab" type="button" role="tab"
                                            aria-controls="previewTab" aria-selected="true">{{ __('dashboard.preview') }}</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="code3-tab" data-bs-toggle="tab"
                                            data-bs-target="#codeTab" type="button" role="tab"
                                            aria-controls="codeTab" aria-selected="false">{{ __('dashboard.code') }}</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent3">
                                    <div class="tab-pane fade show active" id="previewTab" role="tabpanel"
                                        aria-labelledby="preview3-tab" tabindex="0">
                                        <ul class="ps-0 mb-0 list-unstyled o-sortable cursor-move" id="imageDataList">
                                        </ul>

                                        <form>
                                            <div class="canvasEditableElements form-group mb-4 d-none" id="canvas_image_container">
                                                <label class="label">You Photo</label>
                                                <input id="canvas_image" name="canvas_image" type="file" class="form-control text-dark file">
                                            </div>
                            
                                            <div class="canvasEditableElements form-group mb-4 d-none" id="canvas_text_container">
                                                <label class="label">text</label>
                                                <textarea onchange="updateRecord('text')" name="canvas_text" id="canvas_text" class="form-control text-dark"
                                                    placeholder="" rows="3" required></textarea>
                                            </div>
                            
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="canvasEditableElements form-group mb-4 d-none" id="canvas_fill_container">
                                                        <label class="label"><i class="ri-font-color"></i></label>
                                                        <input id="canvas_fill" onchange="updateRecord('fill')" name="canvas_fill" type="color"
                                                            class="form-control text-dark">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="canvasEditableElements form-group mb-4 mb-4 d-none" id="canvas_textAlign_container">
                                                        <label class="label"><i class="ri-align-left"></i></label>
                                                        <div class="form-group position-relative">
                                                            <select class="form-select form-control" onchange="updateRecord('textAlign')" id="canvas_textAlign" name="canvas_textAlign" aria-label="Default select example">
                                                                <option value="left" class="text-dark">left</option>
                                                                <option value="center" class="text-dark">center</option>
                                                                <option value="right" class="text-dark">right</option>
                                                                <option value="justify" class="text-dark">justify</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="canvasEditableElements form-group mb-4 d-none" id="canvas_fontSize_container">
                                                        <label class="label"><i class="ri-font-size"></i></label>
                                                        <input id="canvas_fontSize" onchange="updateRecord('fontSize')" name="canvas_fontSize" type="number" class="form-control text-dark">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="canvasEditableElements form-group mb-4 mb-4 d-none" id="canvas_fontStyle_container">
                                                        <label class="label"><i class="ri-italic"></i></label>
                                                        <div class="form-group position-relative">
                                                            <select class="form-select form-control" onchange="updateRecord('fontStyle')" id="canvas_fontStyle" name="canvas_fontStyle" aria-label="Default select example">
                                                                <option value="" class="text-dark"></option>
                                                                <option value="normal" class="text-dark">normal</option>
                                                                <option value="italic" class="text-dark">italic</option>
                                                                <option value="oblique" class="text-dark">oblique</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                            
                                            <div class="canvasEditableElements form-group mb-4 d-none" id="canvas_src_container">
                                                <label class="label">You Photo</label>
                                                <input id="canvas_src" onchange="updateRecord('src', event)"
                                                    name="canvas_src" type="file" accept="image/png, image/jpg, image/jpeg"
                                                    class="form-control text-dark file">
                                            </div>
                            
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
                                    <div class="tab-pane fade" id="codeTab" role="tabpanel"
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/2.3.6/fabric.min.js"></script>
    <script>
        var canvas;
        var objData;
        var selectedObj;
        var selectedIndex;
        window.addEventListener('load', function(event) {
            canvas = this.__canvas = new fabric.Canvas('canvas');
            // var imageSaver = document.getElementById('lnkDownload');
            // imageSaver.addEventListener('click', saveImage, false);            
            window.onresize = setResizeCanvas();
            loadFromJson();

            var snapZone = 15;
            canvas.on('object:moving', function(options) {
                var objectMiddle = options.target.left + options.target.width / 2;
                if (objectMiddle > canvas.width / 2 - snapZone &&
                    objectMiddle < canvas.width / 2 + snapZone) {
                    options.target.set({
                        left: canvas.width / 2 - options.target.width / 2,
                    }).setCoords();
                }
            });

            canvas.on('mouse:up', function(options) {
                if(options.target.unique && options.target.edit){
                    const index = findIndexByUnique(options.target.unique);
                    if(index > -1){
                        onClickData(index);
                    } else {
                        removeAllElements();
                    }
                } else {
                    removeAllElements();
                }
            });
        });

        const findIndexByUnique = (uniqueValue) => {
            return objData.objects.findIndex(obj => obj.unique === uniqueValue);
        };

        function update(getFromCode = 0) {
            canvas.clear();
            loadFromJson(getFromCode);
        }

        function loadFromJson(getFromCode = 0) {
            if (!objData || getFromCode == 1) {
                var a = document.getElementById('options').value;
                objData = JSON.parse(a);
            }

            var str = JSON.stringify(objData, undefined, 4);
            document.getElementById('options').innerHTML = str;
            canvas.loadFromJSON(objData, function() {
                setTimeout(() => {
                    canvas.renderAll();                    
                }, 100);
            }, function(o, object) {})
        }

        function removeAllElements() {
            for (let element of document.getElementsByClassName("canvasEditableElements")) {
                element.classList.add("d-none");
            }
        }

        function onClickData(index) {
            removeAllElements();
            selectedObj = objData.objects[index];
            selectedIndex = index;
            for (var prop in selectedObj) {
                if (Object.prototype.hasOwnProperty.call(selectedObj, prop)) {
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
                        
                        case 'textAlign':
                            elementContainer.classList.remove("d-none");
                            element.value = selectedObj[prop];
                            break;

                        case 'fontSize':
                            elementContainer.classList.remove("d-none");
                            element.value = selectedObj[prop];
                            break;

                        case 'fontStyle':
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
            element.classList.remove("d-none");
        }

        function hide(element = undefined) {
            if (!element) {
                element = document.getElementById('fabric-canvas-wrapper');
            }
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

                    case 'textAlign':
                        selectedObj[type] = element.value;
                        break;
                    
                    case 'fontSize':
                        selectedObj[type] = element.value;
                        break;

                    case 'fontStyle':
                        selectedObj[type] = element.value;
                        break;

                    case 'src':
                        const file = obj.target.files[0];
                        let fileReader = new FileReader();
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function() {
                            selectedObj[type] = fileReader.result;
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
        }
    </script>
</x-layouts.simple-layout>
