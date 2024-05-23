<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
            <div class="col-md-10 col-lg-6">
                <a id="lnkDownload" class="btn btn-primary btn-block">Save image</a>
                <div id="fabric-canvas-wrapper" class="hd-none">
                    <canvas id="canvas" width="1811" height="2560"
                        style="border: 1px solid blue; position: absolute !important;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/fabric/dist/fabric.min.js"></script>
    <script>
        window.addEventListener('load', function(event) {
            var canvas = this.__canvas = new fabric.Canvas('canvas');
            //fabric.Object.prototype.transparentCorners = false;

            var objData = {
                "objects": [{
                        "rx": 0,
                        "ry": 0,
                        "src": "http://127.0.0.1:8000/images/dynamic/GH.jpg",
                        "top": 0,
                        "left": 0,
                        "type": "image",
                        "angle": 0,
                        "flipX": false,
                        "flipY": false,
                        "scaleX": 1,
                        "scaleY": 1,
                        "stroke": null,
                        "opacity": 1,
                        "hasBorders": false,
                        "selectable": false,
                        "hasControls": false,
                        "overlayFill": null,
                        "strokeWidth": 1,
                        "strokeDashArray": null,
                        "hasRotatingPoint": false,
                        "perPixelTargetFind": false,
                        "transparentCorners": true
                    },
                    {
                        "top": 1000,
                        "fill": "rgba(0, 0, 0, 1)",
                        "left": 200,
                        "text": "यहा लिखे Write Here આહિયા લખો",
                        "type": "textbox",
                        "width": 1411,
                        "height": 1500,
                        "textAlign": "center",
                        "fontWeight": "bold",
                        "hasBorders": true,
                        "selectable": true,
                        "hasControls": true,
                        "overlayFill": null,
                        "lockMovementX": true,
                        "backgroundColor": "rgba(255, 255, 255, 0)"
                    },
                    {
                        "top": 850,
                        "fill": "rgba(0, 0, 0, 1)",
                        "left": 1150,
                        "text": "તા - ૪ ફેબ્રુઆરી ૨૦૨૪",
                        "type": "textbox",
                        "width": 500,
                        "textAlign": "left",
                        "hasBorders": true,
                        "selectable": true,
                        "hasControls": true,
                        "overlayFill": null,
                        "lockMovementX": true,
                        "lockMovementY": true,
                        "backgroundColor": "rgba(255, 255, 255, 0)"
                    },
                    {
                        "top": 850,
                        "fill": "rgba(0, 0, 0, 1)",
                        "left": 200,
                        "text": "#1",
                        "type": "textbox",
                        "width": 300,
                        "textAlign": "left",
                        "hasBorders": true,
                        "selectable": true,
                        "hasControls": true,
                        "overlayFill": null,
                        "lockMovementX": true,
                        "lockMovementY": true,
                        "backgroundColor": "rgba(255, 255, 255, 0)"
                    },
                    {
                        "rx": 50,
                        "ry": 50,
                        "top": 1500,
                        "src": "http://127.0.0.1:8000/images/dynamic/demo-user.jpg",
                        "left": 755,
                        "type": "image",
                        "hasBorders": true,
                        "centeredScaling": false,
                        "scaleX": 0.5,
                        "scaleY": 0.5,
                        // "originX": "center",
                        // "originY": "center"
                        // "selectable": true,
                        // "hasControls": true,
                        // "overlayFill": null,
                        // "lockMovementX": true,
                        // "lockMovementY": true
                    }
                ],
                "background": "#000000"
            };

            //oCoords, aCoords

            setTimeout(() => {
                canvas.loadFromJSON(objData, function() {
                    setTimeout(() => {
                        canvas.renderAll();                        
                    }, 100);
                }, function(o, object) {
                    console.log(o, object)
                })
            }, 1000);


            var imageSaver = document.getElementById('lnkDownload');
            imageSaver.addEventListener('click', saveImage, false);

            function saveImage(e) {
                resizeCanvas(1811);
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
