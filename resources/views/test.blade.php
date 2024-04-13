<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        @font-face {
            font-family: InstrumentSerif;
            src: url('font/InstrumentSerif.ttf');
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a id="lnkDownload" class="btn btn-primary btn-block">Save image</a>
                <div id="fabric-canvas-wrapper" class="hd-none">
                    <canvas id="canvas" width="1080" height="1920" style="border: 1px solid blue; position: absolute !important;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="http://unpkg.com/fabric/dist/fabric.min.js"></script>
    <script>
        window.addEventListener('load', function(event) {
            var canvas = this.__canvas = new fabric.Canvas('canvas');
            //fabric.Object.prototype.transparentCorners = false;

            var objData = {
                "objects": [{
                    "type": "image",
                    "left": 50,
                    "top": 305,
                    "fill": null,
                    "overlayFill": null,
                    "stroke": null,
                    "strokeWidth": 1,
                    "strokeDashArray": null,
                    "src":"images/dynamic/demo-user.jpg",
                    "scaleX": 1,
                    "scaleY": 1,
                    "angle": 0,
                    "flipX": false,
                    "flipY": false,
                    "opacity": 1,
                    "selectable": false,
                    "hasControls": false,
                    "hasBorders": false,
                    "hasRotatingPoint": false,
                    "transparentCorners": true,
                    "perPixelTargetFind": false,
                    "rx": 0,
                    "ry": 0
                }, {
                    "type": "image",
                    "left": 0,
                    "top": 0,
                    "fill": null,
                    "overlayFill": null,
                    "stroke": null,
                    "strokeWidth": 1,
                    "strokeDashArray": null,
                    "src":"images/dynamic/happy-birthday-blue-template.png",
                    "scaleX": 1,
                    "scaleY": 1,
                    "angle": 0,
                    "flipX": false,
                    "flipY": false,
                    "opacity": 1,
                    "selectable": false,
                    "hasControls": false,
                    "hasBorders": false,
                    "hasRotatingPoint": false,
                    "transparentCorners": true,
                    "perPixelTargetFind": false,
                    "rx": 0,
                    "ry": 0
                }, {
                    "type": "image",
                    "left": 332,
                    "top": 160,
                    "fill": null,
                    "overlayFill": null,
                    "stroke": null,
                    "strokeWidth": 1,
                    "strokeDashArray": null,
                    "src":"images/dynamic/logo_gujjuticks_white.png",
                    "scaleX": 1,
                    "scaleY": 1,
                    "angle": 0,
                    "flipX": false,
                    "flipY": false,
                    "opacity": 1,
                    "selectable": false,
                    "hasControls": false,
                    "hasBorders": false,
                    "hasRotatingPoint": false,
                    "transparentCorners": true,
                    "perPixelTargetFind": false,
                    "rx": 0,
                    "ry": 0
                }, 
                // {
                //     "type": "rect",
                //     "left": 50,
                //     "top": 50,
                //     "width": 200,
                //     "height": 200,
                //     "fill": "green",
                //     "overlayFill": null,
                //     "stroke": null,
                //     "strokeWidth": 1,
                //     "strokeDashArray": null,
                //     "scaleX": 1,
                //     "scaleY": 1,
                //     "angle": 0,
                //     "flipX": false,
                //     "flipY": false,
                //     "opacity": 1,
                //     "selectable": true,
                //     "hasControls": false,
                //     "hasBorders": false,
                //     "hasRotatingPoint": false,
                //     "transparentCorners": true,
                //     "perPixelTargetFind": false,
                //     "rx": 0,
                //     "ry": 0
                // }, {
                //     "type": "circle",
                //     "left": 100,
                //     "top": 150,
                //     "width": 600,
                //     "height": 600,
                //     "fill": "red",
                //     "overlayFill": null,
                //     "stroke": null,
                //     "strokeWidth": 1,
                //     "strokeDashArray": null,
                //     "scaleX": 1,
                //     "scaleY": 1,
                //     "angle": 0,
                //     "flipX": false,
                //     "flipY": false,
                //     "opacity": 1,
                //     "selectable": true,
                //     "hasControls": false,
                //     "hasBorders": false,
                //     "hasRotatingPoint": false,
                //     "transparentCorners": true,
                //     "perPixelTargetFind": false,
                //     "radius": 50
                // }
                ],
                "background": "rgba(255, 150, 10, 1)"
            };
            canvas.loadFromJSON(objData, function() {
                canvas.renderAll();
            }, function(o, object) {
                console.log(o, object)
            })


            var imageSaver = document.getElementById('lnkDownload');
            imageSaver.addEventListener('click', saveImage, false);

            function saveImage(e) {
                resizeCanvas(1080);
                this.href = canvas.toDataURL({
                    format: 'jpeg',
                    quality: 1
                });
                this.download = 'canvas.jpeg'
                setResizeCanvas()
            }

            window.onresize = setResizeCanvas();

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

            function show() {
                console.log("show");
                const element = document.getElementById('fabric-canvas-wrapper');
                element.classList.remove("d-none");
            }

            function hide() {
                console.log("hide");
                const element = document.getElementById('fabric-canvas-wrapper');
                element.classList.add("d-none");
            }

        });
    </script>
</body>

</html>