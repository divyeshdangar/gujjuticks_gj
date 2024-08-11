<x-layouts.simple-layout :metaData="$metaData">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 100vh;
            /* min-height: 400px;
            max-height: 1000px; */
        }

        .pointer {
            cursor: pointer;
        }
        .leaflet-control-attribution,
        .leaflet-control-zoom {
            display: none !important;
        }

        .leaflet-popup-content {
            margin: 0px;
        }

        .leaflet-popup-content-wrapper {
            width: 250px;
        }

        .leaflet-popup-content-wrapper {
            border-radius: 5px;
            padding: 3px;
            padding-right: 4px;
        }
    </style>

    <div class="row justify-content-center mb-2 py-2">
        <div class="col-md-8 mb-4">
            <div class="card bg-white border-0 rounded-10">
                <div class="card-body p-4 pb-0">
                    <div class="border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-sm-0">Recent Blogs</h4>
                    </div>

                    <div class="row">
                        @foreach ($dataList as $data)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="blogBlock card bg-white border-0 rounded-10 mb-4">
                                    <a href="{{ route('pages.blog.detail', ['slug' => $data->slug]) }}">
                                        <img src="{{ URL::asset('/images/blog/' . $data->image) }}" class="rounded-2" alt="blog">
                                    </a>
                                    <div class="card-body position-relative blog-content m-0 p-3">
                                        <span class="blog-date two d-inline-block w-auto h-auto lh-1">{{ $lang[$data->lang] }}</span>
                                        <h4 class="lh-base fs-16 fw-semibold mb-3 mt-4">
                                            <img class="pointer" onclick="setView({{ $data->latitude }}, {{ $data->longitude }})" src="https://cdn-icons-png.flaticon.com/128/6097/6097374.png" height="30" width="30">
                                            <a href="{{ route('pages.blog.detail', ['slug' => $data->slug]) }}"
                                                class="text-decoration-none text-dark">{{ $data->title }}</a>
                                        </h4>
                                        <ul class="ps-0 mb-0 list-unstyled d-flex gap-3">
                                            <li>
                                                <i class="ri-user-line text-danger"></i>
                                                <a href="#" class="text-decoration-none text-gray-light ms-1">By
                                                    {{ ucwords($data->user->name) }}</a>
                                            </li>
                                            <li>
                                                <i class="ri-calendar-line text-danger"></i>
                                                <a href="{{ route('pages.blog.detail', ['slug' => $data->slug]) }}"
                                                    class="text-decoration-none text-gray-light ms-1">{{ $data->created_at->format('j F, Y') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $dataList->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>

        </div>
        <div class="col-md-4 mb-4">
            <div class="rounded-10 border border-2" id="map"></div>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map', {
            minZoom: 7,
            maxZoom: 18
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

        let customIcon = {
            iconUrl: 'https://cdn-icons-png.flaticon.com/128/6097/6097374.png',
            iconSize: [40, 40]
        }

        let myIcon = L.icon(customIcon);
        let iconOptions = {
            title: 'GujjuTicks',
            draggable: false,
            icon: myIcon
        }

        function setView(latitude, longitude, zoom = 15){
            map.setView([latitude, longitude], zoom);
        }

        var time = 1000;
        @foreach ($dataList as $data)
            setTimeout(() => {
                map.setView([{{ $data->latitude }}, {{ $data->longitude }}], 15);
                
                /* L.marker([{{ $data->latitude }}, {{ $data->longitude }}], iconOptions).addTo(map)
                    .bindPopup(`<div class="card bg-white border-0 rounded-10">
                                    <a href="{{ route('pages.blog.detail', ['slug' => $data->slug]) }}">
                                        <img src="{{ URL::asset('/images/blog/' . $data->image) }}" class="rounded-2"
                                            alt="blog">
                                    </a>
                                    <div class="card-body position-relative blog-content m-0 p-3">
                                        <span class="blog-date two d-inline-block w-auto h-auto lh-1">{{ $lang[$data->lang] }}</span>
                                        <h4 class="lh-base fs-16 fw-semibold mb-3 mt-4">
                                            <a href="{{ route('pages.blog.detail', ['slug' => $data->slug]) }}"
                                                class="text-decoration-none text-dark">{{ $data->title }}</a>
                                        </h4>
                                        <ul class="ps-0 mb-0 list-unstyled d-flex gap-3">
                                            <li>
                                                <i class="ri-user-line text-danger"></i>
                                                <a href="#" class="text-decoration-none text-gray-light ms-1">By
                                                    {{ ucwords($data->user->name) }}</a>
                                            </li>
                                            <li>
                                                <i class="ri-calendar-line text-danger"></i>
                                                <a href="{{ route('pages.blog.detail', ['slug' => $data->slug]) }}" class="text-decoration-none text-gray-light ms-1">{{ $data->created_at->format('j F, Y') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>`);
                    //.openPopup(); */
            }, time);
            time = time + 1000;
        @endforeach



        L.Control.Watermark = L.Control.extend({
            onAdd: function(map) {
                var img = L.DomUtil.create('img');
                img.src = 'https://www.gujjuticks.com/brand/full-logo-black.png';
                img.style.width = '150px';
                return img;
            },
            onRemove: function(map) {
                // Nothing to do here
            }
        });
        L.control.watermark = function(opts) {
            return new L.Control.Watermark(opts);
        }
        L.control.watermark({
            position: 'bottomleft'
        }).addTo(map);
    </script>
</x-layouts.simple-layout>
