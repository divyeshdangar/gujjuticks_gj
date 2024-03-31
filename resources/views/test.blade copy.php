<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="mt-16">
                <canvas id="canvas" width="1080" height="1920" style="border: 1px solid blue; position: absolute !important;"></canvas>

                <button id="play" style="height:100px; width:300px;" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Play
                </button>
                <button id="video" style="height:100px; width:300px;" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Download
                </button>

            </div>
        </div>
    </div>
    <script src="http://unpkg.com/fabric/dist/fabric.min.js"></script>
    <script>
        window.addEventListener('load', function(event) {
            // var canvas = this.__canvas = new fabric.Canvas('canvas');
            // console.log(canvas)
            // fabric.Object.prototype.transparentCorners = false;
            // fabric.Image.fromURL('storage/images/dynamic/happy-birthday-blue-template.png', function(img) {
            //     img.set({
            //         left: 0,
            //         top: 0,
            //         angle: 0
            //     });
            //     img.perPixelTargetFind = true;
            //     img.hasControls = img.hasBorders = false;
            //     //img.scale(fabric.util.getRandomInt(50, 100) / 100);
            //     canvas.add(img);
            // });

            // fabric.Image.fromURL('storage/images/category/flower.png', function(img) {
            //     img.set({
            //         left: 1020,
            //         top: 1850,
            //         angle: 0,
            //         originX: 'center',
            //         originY: 'center',
            //     });
            //     img.perPixelTargetFind = true;
            //     img.hasControls = img.hasBorders = false;
            //     //img.scale(fabric.util.getRandomInt(50, 100) / 100);
            //     canvas.add(img);

            //     img.animate("angle", "900", {
            //         onChange: canvas.renderAll.bind(canvas),
            //         easing: fabric.util.ease.easeInBounce,
            //         duration: 12000,
            //     });
            // });


            // fabric.Image.fromURL('storage/images/category/flower-pot.png', function(img) {
            //     img.set({
            //         left: 400,
            //         top: 1700,
            //         angle: 0,
            //         originX: 'center',
            //         originY: 'center',
            //     });
            //     img.perPixelTargetFind = true;
            //     img.hasControls = img.hasBorders = false;
            //     //img.scale(fabric.util.getRandomInt(50, 100) / 100);
            //     canvas.add(img);

            //     img.animate("angle", "20", {
            //         onChange: canvas.renderAll.bind(canvas),
            //         easing: fabric.util.ease.easeInBounce,
            //         duration: 12000,
            //     });
            // });

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






























            async function asyncForEach(array, callback) {
                for (let index = 0; index < array.length; index++) {
                    await callback(array[index], index, array);
                }
            }

            function uuid() {
                return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                    let r = Math.random() * 16 | 0,
                        v = c == 'x' ? r : (r & 0x3 | 0x8);
                    return v.toString(16);
                });
            }

            // Fabricjs
            fabric.Object.prototype.originX = "center";
            fabric.Object.prototype.originY = "center";

            const canvas = new fabric.Canvas("canvas", {
                backgroundColor: "#FFFFFF"
            });

            fabric.RectWithAnimation = new fabric.util.createClass(fabric.Rect, {
                type: "RectWithAnimation",
                _isPause: false,
                _isStop: false,
                _animationList: [],
                _lastAnimationIndex: 0,
                _lastStateAnimationProperties: null,
                animationProperties: ["left", "top", "width", "height", "fill"],

                initialize(options) {
                    this.callSuper("initialize", options);
                    this.addAnimation({
                        properties: this.getPropertiesForAnimation()
                    });
                },

                addAnimation(animation) {
                    this._animationList.push(
                        Object.assign({
                            id: uuid(),
                            duration: 0,
                            easing: "linear",
                            properties: null
                        }, animation)
                    );

                    return this;
                },

                getPropertiesForAnimation() {
                    const properties = {};

                    this.animationProperties.forEach(prop => {
                        properties[prop] = this[prop];
                    })

                    return properties;
                },

                getFirstAnimation() {
                    return this._animationList[0];
                },

                async play() {
                    this._isPause = false;
                    this._isStop = false;
                    this._lastAnimationIndex = 0;
                    await this.executeAnimation(this._animationList);
                },

                async executeAnimation(animations) {
                    await asyncForEach(animations, async animation => {
                        await this._play(animation);
                    });
                },

                _play(animation) {
                    const {
                        duration,
                        easing,
                        properties
                    } = animation;
                    // skip animation
                    if (!properties || duration === 0) {
                        return Promise.resolve();
                    }

                    return new Promise(resolve => {
                        this.animate(properties, {
                            duration,
                            easing: fabric.util.ease[easing] ? fabric.util.ease[easing] : fabric.util.ease.linear,
                            onChange: this.canvas.renderAll.bind(this.canvas),
                            onComplete: () => {
                                if (!this._isPause) {
                                    this._lastAnimationIndex = this._animationList.findIndex(item => item.id === animation.id);
                                }

                                resolve()
                            },
                            abort: () => {
                                return this._isPause || this._isStop;
                            }
                        });
                    })
                },

                pause() {
                    if (this._lastAnimationIndex === this._animationList.length - 1) return;

                    this._isPause = !this._isPause;

                    if (this._isPause) {
                        this._lastStateAnimationProperties = this.getPropertiesForAnimation();
                    } else {
                        this.set(this._lastStateAnimationProperties);
                        this.setCoords();
                        this.canvas.requestRenderAll();
                        const animations = this._animationList.filter((_, i) => i > this._lastAnimationIndex);
                        this._lastStateAnimationProperties = null;
                        this.executeAnimation(animations);
                    }
                },

                stop() {
                    this._isStop = true;
                    const firstAnimation = this.getFirstAnimation();
                    this.set(firstAnimation.properties);
                    this.setCoords();
                    this.canvas.requestRenderAll();
                },

                toObject(options) {
                    options = options || [];
                    return this.callSuper("toObject", [].concat(Array.from(options), ["animationProperties", "_animationList"]));
                }
            });

            fabric.RectWithAnimation.fromObject = function(object, callback) {
                const rect = new fabric.RectWithAnimation(object);
                callback(rect);
            }

            const rect = new fabric.RectWithAnimation({
                left: canvas.width / 2,
                top: canvas.height / 2,
                width: 100,
                height: 100,
                fill: '#006666',
                angle: 45
            });

            canvas.add(rect);




            fabric.Object.prototype.transparentCorners = false;
            fabric.Image.fromURL('storage/images/dynamic/happy-birthday-blue-template.png', function(img) {
                img.set({
                    left: 540,
                    top: 960,
                    lockMovementX: true,
                    lockMovementY: true,
                });
                img.perPixelTargetFind = true;
                img.hasControls = img.hasBorders = false;
                //img.scale(fabric.util.getRandomInt(50, 100) / 100);
                canvas.add(img);
            });



            rect
                .addAnimation({
                    duration: 3000,
                    easing: "easeInBounce",
                    properties: {
                        left: 50,
                        angle: 45,
                        top: 50
                    }
                })
                .addAnimation({
                    duration: 3000,
                    easing: "easeOutBounce",
                    properties: {
                        left: 500,
                        angle: 400,
                        top: 50,
                        fill: "red"
                    }
                })
                .addAnimation({
                    duration: 3000,
                    easing: "easeOutBounce",
                    properties: {
                        left: 500,
                        angle: -45,
                        top: 500,
                        fill: "green"
                    }
                }).addAnimation({
                    duration: 3000,
                    easing: "easeOutBounce",
                    properties: {
                        left: 500,
                        angle: 2000,
                        top: 1000,
                        fill: "pink"
                    }
                }).addAnimation({
                    duration: 3000,
                    easing: "easeOutBounce",
                    properties: {
                        left: 50,
                        angle: 100,
                        top: 1500,
                        fill: "yellow"
                    }
                });

            function getActiveObject() {
                const activeObject = canvas.getActiveObject();

                if (activeObject && activeObject.type === "RectWithAnimation") {
                    return activeObject;
                }

                return null;
            }

            const playBtn = document.getElementById("play");
            const videoBtn = document.getElementById("video");

            playBtn.addEventListener("click", function() {
                const activeObject = getActiveObject();

                if (activeObject) {
                    activeObject.play();
                }
            });

            function downloadVideo(chunks) {
                const blob = new Blob(chunks, {
                    'type': 'video/mp4'
                });
                const videoURL = URL.createObjectURL(blob);
                const tag = document.createElement('a');
                tag.href = videoURL;
                tag.download = 'sample.mp4';
                document.body.appendChild(tag);
                tag.click();
                document.body.removeChild(tag);
            }

            let saving = false;

            videoBtn.addEventListener("click", function() {
                if (saving) return;

                saving = true;

                videoBtn.innerText = "Saving in progress";

                function enlivenObjects(elements) {
                    return new Promise(function(resolve) {
                        fabric.util.enlivenObjects(elements, function(objects) {
                            resolve(objects);
                        })
                    })
                };

                const canvasElement = document.createElement("canvas")
                const staticCanvas = new fabric.StaticCanvas(canvasElement, {
                    width: canvas.width,
                    height: canvas.height,
                    backgroundColor: canvas.backgroundColor,
                    skipOffscreen: false
                });

                enlivenObjects(canvas.toObject().objects).then((objects) => {
                    staticCanvas.add.apply(staticCanvas, objects);
                    const canvasStream = staticCanvas.lowerCanvasEl.captureStream(24);
                    const mediaRecorder = new MediaRecorder(canvasStream, {
                        mimeType: 'video/webm'
                    });
                    let chunks = [];

                    mediaRecorder.onstop = function() {
                        downloadVideo(chunks);
                        chunks = [];
                    };

                    mediaRecorder.ondataavailable = function(e) {
                        chunks.push(e.data);
                    };

                    mediaRecorder.start();

                    let promises = [];

                    staticCanvas.forEachObject(obj => {
                        console.log(obj.type)
                        if(obj.type=="RectWithAnimation"){
                            promises.push(obj.play());
                        }
                    });

                    Promise.all(promises).then(() => {
                        mediaRecorder.stop();
                        saving = false;
                        videoBtn.innerText = "Save in video";
                    })
                });
            });



        });
    </script>
</body>

</html>