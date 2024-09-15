<x-layouts.simple-layout :showHeader="true" :metaData="$metaData">

    {{-- @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :isPublicPage="true" :metaData="$metaData"></x-common.breadcrumb>
    @endif --}}
    <style>
        .locked {
            pointer-events: none;
        }
    </style>

    <div class="row">
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
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.download_images') }}</h4>
                        <div class="dropdown action-opt">
                            <button class="btn bg-transparent p-0" onclick="saveImage()" type="button">
                                <i data-feather="download"></i>
                            </button>
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
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <p>{!! $dataDetail->description !!}</p>
                </div>
            </div>
        </div>
    </div>

    <textarea class="d-none" id="options" name="options">{{ base64_encode($dataDetail->options) }}</textarea>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/2.3.6/fabric.min.js"></script>
    <script>
        var canvas;
        var objData;
        var selectedObj;
        var selectedIndex;
        window.addEventListener('load', function(event) {
            canvas = this.__canvas = new fabric.Canvas('canvas');
            window.onresize = setResizeCanvas();
            loadFromJson();
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
                objData = JSON.parse(atob(a));
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
