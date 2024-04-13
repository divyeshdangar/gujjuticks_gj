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
        <div class="row">
            <div class="col-md-4">
                <a id="lnkDownload" class="btn btn-primary btn-block">Save image</a>
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
            fabric.Object.prototype.transparentCorners = false;

            fabric.Image.fromURL('images/dynamic/demo-user.jpg', function(img) {
                img.set({
                    left: 50,
                    top: 305,
                    angle: 0,
                    lockMovementX: false,
                    lockMovementY: false,
                });
                img.perPixelTargetFind = true;
                img.hasControls = img.hasBorders = true;
                //img.scale(fabric.util.getRandomInt(50, 100) / 100);
                canvas.add(img);
            });

            fabric.Image.fromURL('images/dynamic/happy-birthday-blue-template.png', function(img) {
                img.set({
                    left: 0,
                    top: 0,
                    angle: 0,
                    lockMovementX: true,
                    lockMovementY: true,
                });
                img.perPixelTargetFind = true;
                img.hasControls = img.hasBorders = false;
                //img.scale(fabric.util.getRandomInt(50, 100) / 100);
                canvas.add(img);
            });

            fabric.Image.fromURL('images/dynamic/logo_indiastic_white.png', function(img) {
                img.set({
                    left: 332,
                    top: 160,
                    angle: 0,
                    lockMovementX: true,
                    lockMovementY: true,
                });
                img.perPixelTargetFind = true;
                img.hasControls = img.hasBorders = true;
                //img.scale(fabric.util.getRandomInt(50, 100) / 100);
                canvas.add(img);
            });


            setTimeout(() => {
                var textPath = new fabric.Text('Text on a path', {
                    fontFamily: "InstrumentSerif",
                    top: 1400,
                    left: 50,
                    fontSize: 200,
                    angle: 0,
                    fill: '#ffffff',
                    textAlign: 'center',
                    lockMovementX: true,
                    lockMovementY: true,
                });
                canvas.add(textPath);
            }, 100);


            canvas.renderAll();


            // canvas.add(rect1, circle, triangle);
            // canvas.on({
            //     'object:moving': onChange,
            //     'object:scaling': onChange,
            //     'object:rotating': onChange,
            // });

            // function onChange(options) {
            //     options.target.setCoords();
            //     canvas.forEachObject(function(obj) {
            //         if (obj === options.target) return;
            //         obj.set('opacity', options.target.intersectsWithObject(obj) ? 0.5 : 1);
            //     });
            // }

            // function record(canvas, time) {
            //     var recordedChunks = [];
            //     return new Promise(function(res, rej) {
            //         var stream = canvas.captureStream(25 /*fps*/ );
            //         mediaRecorder = new MediaRecorder(stream, {
            //             mimeType: "video/webm; codecs=vp9"
            //         });

            //         //ondataavailable will fire in interval of `time || 4000 ms`
            //         mediaRecorder.start(time || 4000);

            //         mediaRecorder.ondataavailable = function(event) {
            //             recordedChunks.push(event.data);
            //             // after stop `dataavilable` event run one more time
            //             if (mediaRecorder.state === 'recording') {
            //                 mediaRecorder.stop();
            //             }

            //         }

            //         mediaRecorder.onstop = function(event) {
            //             var blob = new Blob(recordedChunks, {
            //                 type: "video/webm"
            //             });
            //             var url = URL.createObjectURL(blob);
            //             res(url);
            //         }
            //     })
            // }

            // function download(canvas) {
            //     const recording = record(canvas, 8000)

            //     // play it on another video element
            //     // var video$ = document.createElement('video')
            //     // document.body.appendChild(video$)
            //     // recording.then(url => video$.setAttribute('src', url))

            //     // download it
            //     var link$ = document.createElement('a')
            //     link$.setAttribute('download', 'recordingVideo')
            //     recording.then(url => {
            //         console.log("Record Completed..!")
            //         link$.setAttribute('href', url)
            //         link$.click()
            //     })
            // }

            // const videoBtn = document.getElementById("video");
            // videoBtn.addEventListener("click", function() {
            //     download(document.getElementById("canvas"))
            // });


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
                //hide();
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