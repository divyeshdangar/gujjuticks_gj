<x-layouts.simple-layout :showHeader="true" :metaData="$metaData">

    {{-- @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :isPublicPage="true" :metaData="$metaData"></x-common.breadcrumb>
    @endif --}}
    <style>
        .locked {
            pointer-events: none;
        }

        #upload-image-image {
            width: 100%;
            max-width: 888px;
            /* Set a max width for larger screens */
            height: auto;
            margin: 0 auto;
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h1 class="fw-semibold fs-18 mb-0">{{ $dataDetail->title }}</h1>
                    </div>
                    <img src="{{ URL::asset('/images/dynamic/' . $dataDetail->image) }}" class="mb-4 rounded-10">
                    <p>{{ $dataDetail->meta_description }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 id="here" class="fw-semibold fs-18 mb-0">{{ __('dashboard.download_images') }}</h4>
                    </div>
                    <div id="fabric-canvas-wrapper" class="hd-none">
                        <canvas id="canvas" width="{{ $dataDetail->width }}" height="{{ $dataDetail->height }}"
                            style="position: absolute !important;" class="rounded-10"></canvas>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-2 mt-4">
                                <input type="file" class="form-control" id="image" name="image"
                                    accept="image/*">
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary my-2 w-100 text-white" onclick="saveImage()" type="button">
                                Download
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <p>{!! $dataDetail->description !!}</p>
                </div>
            </div>
        </div>
    </div>

    <textarea class="d-none" id="options" name="options">{{ base64_encode($dataDetail->options) }}</textarea>

    <button id="modalButton" type="button" class="d-none btn btn-primary text-white py-2 px-4 fw-semibold"
        data-bs-toggle="modal" data-bs-target="#cropperModal">
        Launch static backdrop modal
    </button>
    <div class="modal fade" id="cropperModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="cropperModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cropperModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="canvasContainer">
                    <div id="upload-image-image"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary text-white" onclick="getImage()">Set Image</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/2.3.6/fabric.min.js"></script>
    <script>
        var canvas;
        var objData;
        var selectedObj;
        var selectedIndex = 0;
        var $image_crop;
        var containerWidth;
        var viewportHeight;
        window.addEventListener('load', function(event) {
            canvas = this.__canvas = new fabric.Canvas('canvas');
            window.onresize = setResizeCanvas();
            loadFromJson();
            addCropperImage();

            var cropImageModal = document.getElementById('cropperModal');
            cropImageModal.addEventListener('shown.bs.modal', function() {
                bindCropper()
            });

            // Destroy Croppie when modal is hidden
            cropImageModal.addEventListener('hidden.bs.modal', function() {
                // if (croppieInstance) {
                //     croppieInstance.destroy();
                // }
            });

        });

        function update(getFromCode = 0) {
            canvas.clear();
            loadFromJson(getFromCode);
        }

        function getImage() {
            $('#upload-image-image').croppie('result', {
                type: 'base64',
                format: 'jpeg',
                size: {
                    width: 888,
                    height: 1536
                }, // Fixed result size
                quality: 0.7
            }).then(function(resp) {
                if (resp && isImageSelected) {
                    setTimeout(() => {
                        selectedObj['src'] = resp;
                        objData.objects[selectedIndex] = selectedObj;
                        update();
                        openClick('modalButton');
                    }, 200);
                }
            });
        }

        function bindCropper() {
            containerWidth = document.getElementById('upload-image-image').offsetWidth;
            viewportHeight = (containerWidth / 888) * 1536; // Scale height based on width

            if(!$image_crop){
                $image_crop = $('#upload-image-image').croppie({
                    //enableExif: true,
                    enableResize: true,
                    viewport: {
                        width: containerWidth, // Dynamic based on container width
                        height: viewportHeight, // Calculated to maintain 9:16 aspect ratio
                        type: 'square' // You can change this to 'circle' or 'square' as per needs
                    },
                    boundary: {
                        width: containerWidth, // Set boundary equal to container width
                        height: viewportHeight // Same height as viewport to match 9:16 ratio
                    },
                    //url: 'https://www.gujjuticks.com/images/dynamic/1727962910-1175287700.png'
                    url: 'http://127.0.0.1:8000/images/dynamic/1727961421-1649729557.png'
                });
            }
        }

        function addCropperImage() {
            $('#image').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    openClick('modalButton');
                    setTimeout(() => {                        
                        $image_crop.croppie('bind', {
                            url: e.target.result
                        }).then(function() {
                            $.ajax({
                                /* the route pointing to the post function */
                                url: '{{ route('pages.image.detail.save') }}',
                                type: 'POST',
                                /* send the csrf-token and the input to the controller */
                                data: {
                                    data: e.target.result
                                },
                                dataType: 'JSON',
                                /* remind that 'data' is the response of the AjaxController */
                                success: function(data) {
                                }
                            });
                            isImageSelected = true;
                        });
                    }, 500);
                }
                reader.readAsDataURL(this.files[0]);
            });
        }

        function openClick(id) {
            var ele = document.getElementById(id);
            if (typeof ele.click == 'function') {
                ele.click()
            } else if (typeof ele.onclick == 'function') {
                ele.onclick()
            }
        }

        function loadFromJson(getFromCode = 0) {
            if (!objData || getFromCode == 1) {
                var a = document.getElementById('options').value;
                objData = JSON.parse(atob(a));
                if (objData.objects[selectedIndex]) {
                    selectedObj = objData.objects[selectedIndex];
                }
            }

            var str = JSON.stringify(objData, undefined, 4);
            document.getElementById('options').innerHTML = str;
            canvas.loadFromJSON(objData, function() {
                setTimeout(() => {
                    canvas.renderAll();
                }, 100);
            }, function(o, object) {})
        }

        function setResizeCanvas() {
            const outerCanvasContainer = document.getElementById('fabric-canvas-wrapper');
            outerCanvasContainer.classList.add("locked");
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
            anchor.setAttribute('download', 'image.jpg');
            anchor.click();
            setResizeCanvas()
        }
    </script>
</x-layouts.simple-layout>
