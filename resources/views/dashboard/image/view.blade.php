<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

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
        <div class="col-xxl-4 col-sm-12 d-none">
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
                                        class="wh-78 rounded-10">
                                </a>
                            </div>
                            <div class="flex-grow-1 ms-10">
                                <h4 class="fw-semibold fs-16 mb-0">{{ $dataDetail->width }} x
                                    {{ $dataDetail->height }}
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
                                    <a class="dropdown-item" id="lnkDownload">
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
                                style="position: absolute !important;" class="border border-2 rounded-10"></canvas>
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
                                            aria-controls="preview3-tab-pane"
                                            aria-selected="true">{{ __('dashboard.preview') }}</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="code3-tab" data-bs-toggle="tab"
                                            data-bs-target="#code3-tab-pane" type="button" role="tab"
                                            aria-controls="code3-tab-pane"
                                            aria-selected="false">{{ __('dashboard.code') }}</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent3">
                                    <div class="tab-pane fade show active" id="preview3-tab-pane" role="tabpanel"
                                        aria-labelledby="preview3-tab" tabindex="0">
                                        <ul class="ps-0 mb-0 list-unstyled o-sortable cursor-move" id="imageDataList">
                                        </ul>

                                        <form>
                                            <div class="canvasEditableElements form-group mb-4 d-none"
                                                id="canvas_image_container">
                                                <label class="label">You Photo</label>
                                                <input id="canvas_image" name="canvas_image" type="file"
                                                    class="form-control text-dark file">
                                            </div>

                                            <div class="canvasEditableElements form-group mb-4 d-none"
                                                id="canvas_text_container">
                                                <label class="label">text</label>
                                                <textarea onchange="updateRecord('text')" name="canvas_text" id="canvas_text" class="form-control text-dark"
                                                    placeholder="" rows="3" required></textarea>
                                            </div>

                                            <div class="canvasEditableElements form-group mb-4 d-none"
                                                id="canvas_fill_container">
                                                <label class="label">fill</label>
                                                <input id="canvas_fill" onchange="updateRecord('fill')"
                                                    name="canvas_fill" type="color" class="form-control text-dark">
                                            </div>

                                            <div class="canvasEditableElements form-group mb-4 d-none"
                                                id="canvas_src_container">
                                                <label class="label">You Photo</label>
                                                <input id="canvas_src" onchange="updateRecord('src', event)"
                                                    name="canvas_src" type="file"
                                                    accept="image/png, image/jpg, image/jpeg"
                                                    class="form-control text-dark file">
                                            </div>

                                            <div class="form-group d-flex gap-3 d-none">
                                                <button
                                                    class="btn btn-primary text-white fw-semibold py-2 px-2 px-sm-3">
                                                    <span class="py-sm-1 d-block">
                                                        <i class="ri-add-line text-white"></i>
                                                        <span>Refresh</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="code3-tab-pane" role="tabpanel"
                                        aria-labelledby="code3-tab" tabindex="0">
                                        <div class="form-group mb-4">
                                            <form method="post" id="formToValidate"
                                                action="{{ route('dashboard.image.update.post', ['id' => $dataDetail->id]) }}">
                                                {{ csrf_field() }}
                                                <button
                                                    class="btn btn-primary text-white mb-2">{{ __('dashboard.save') }}</button>
                                                <button type="button" onclick="canvasToJSON()"
                                                    class="btn btn-primary text-white mb-2">{{ __('dashboard.canvas_to_json') }}</button>
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
        <div class="col-xxl-4 col-sm-12">
            <div class="card bg-white border-0 v mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.image_content') }}</h4>
                    </div>
                    <div class="card bg-white border-0 rounded-10">
                        <div class="card-body p-0">
                            <ul class="list-unstyled activity-timeline max-h-554" data-simplebar>
                                <li class="activity-item">
                                    <h4>Add Text</h4>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-group mb-4">
                                                <input type="text" class="form-control h-58" id="add-text"
                                                    name="add-text">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <button type="submit" onclick="addText(this)"
                                                    class="btn btn-primary d-block py-3 px-4 fw-semibold text-white">+</button>
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Add Image</h4>
                                    <p>Upload image first, than you can use it in image</p>
                                    <form method="post" id="formToValidate"
                                        action="{{ route('dashboard.image.image.post', ['id' => $dataDetail->id]) }}"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-group" id="imageFormGroup">
                                                    <input type="file" class="form-control h-58" id="image"
                                                        name="image" accept="image/*" required>
                                                    @error('image')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <button type="submit"
                                                        class="btn btn-primary d-block py-3 px-4 fw-semibold text-white">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </li>

                                <li class="activity-item">
                                    <div class="row">
                                        @foreach ($dataUploads as $key => $value)
                                            <div class="col-4 mb-4">
                                                <img src="{{ URL::asset('/images/dynamic/' . $value->image) }}"
                                                    onclick="addImage(this)" style="cursor: pointer" class="rounded">
                                            </div>
                                        @endforeach
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/fabric/dist/fabric.min.js"></script>
    {{-- <script src="{{ asset('assets/js/fabric.js') }}"></script> --}}
    <script>
        var canvas;
        var objData;
        var selectedObj;
        var selectedIndex;
        window.addEventListener('load', function(event) {
            canvas = this.__canvas = new fabric.Canvas('canvas');

            var imageSaver = document.getElementById('lnkDownload');
            imageSaver.addEventListener('click', saveImage, false);            
            
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
                if (options.target) { // && options.target.unique && options.target.edit){ //Remove to test
                    const index = findIndexByUnique(options.target.unique);
                    if (index > -1) {
                        onClickData(index, options.target);
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
            console.log(6)
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

        function onClickData(index, selectedObjDirect = undefined) {
            removeAllElements();
            if (!selectedObjDirect) {
                selectedObj = objData.objects[index];
                selectedIndex = index;
            } else {
                selectedObj = selectedObjDirect;
                selectedIndex = objData.objects.findIndex(obj =>
                    obj.type === selectedObj.type &&
                    obj.left === selectedObj.left &&
                    obj.top === selectedObj.top &&
                    obj.fill === selectedObj.fill &&
                    obj.text === selectedObj.text
                );
            }

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

        function addImage(obj) {
            var url = $(obj).attr('src');
            var data = {
                "src": url,
                "edit": true,
                "unique": Date.now(),
                "type": "image"
            };
            if (objData) {
                if (objData.objects) {
                    objData.objects.push(data);
                } else {
                    objData.objects = [];
                    objData.objects.push(data);
                }

                var str = JSON.stringify(objData, undefined, 4);
                document.getElementById('options').innerHTML = str;
                update(0);
            }
        }

        function addText(obj) {
            var text = $("#add-text").val();
            var data = {
                "top": 100,
                "edit": true,
                "unique": Date.now(),
                "fill": "rgba(0, 0, 0, 1)",
                "left": 100,
                "text": text,
                "type": "textbox",
                "angle": 0,
                "fontSize": 55,
                "fontStyle": "normal",
                "textAlign": "right",
                "fontWeight": "bold",
                "backgroundColor": "rgba(255, 255, 255, 0)"
            };
            if (objData) {
                if (objData.objects) {
                    objData.objects.push(data);
                } else {
                    objData.objects = [];
                    objData.objects.push(data);
                }

                var str = JSON.stringify(objData, undefined, 4);
                document.getElementById('options').innerHTML = str;
                update(0);
            }
        }

        function canvasToJSON() {
            var str = JSON.stringify(canvas.toJSON(), undefined, 4);
            document.getElementById('options').innerHTML = str;
        }

        function updateRecord(type, obj = null) {
            console.log(type);
            var element = document.getElementById('canvas_' + type);
            var src;
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
                        let fileReader = new FileReader();
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function() {
                            src = fileReader.result;
                        }
                        break;

                    default:
                        break;
                }
            }
            console.log(3)
            setTimeout(() => {                
                selectedObj = selectedObj.toJSON()

                selectedObj['src'] = src;

                objData.objects[selectedIndex] = selectedObj;
                update()
            }, 200);
        }
    </script>
</x-layouts.dashboard>
