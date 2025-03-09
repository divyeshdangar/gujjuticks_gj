<x-layouts.dashboard :showHeader="true" :metaData="$metaData">

    @if ($metaData['breadCrumb'])
        <x-common.breadcrumb :metaData="$metaData"></x-common.breadcrumb>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.basic_info') }}</h4>
                        <div class="dropdown action-opt">
                            <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                <li>
                                    <a class="dropdown-item"
                                        href="">
                                        <i data-feather="rotate-cw"></i>
                                        {{ __('dashboard.refresh') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <a target="_blank" href="{{ $dataDetail->profile_pic }}">
                                    <img src="{{ $dataDetail->profile_pic }}" class="img-fluid rounded-10 border shadow mb-4">
                                </a>
                            </div>
                            <ul class="ps-0 mb-0 list-unstyled">
                                <li class="border-bottom border-color-gray mb-1 pb-2">
                                    <span class="fw-semibold text-dark w-130 d-inline-block">{{ __('dashboard.name') }}:</span>
                                    <span>{{ $dataDetail->name }}</span>
                                </li>
                                <li class="border-bottom border-color-gray mb-1 pb-2">
                                    <span class="fw-semibold text-dark w-130 d-inline-block">{{ __('dashboard.username') }}:</span>
                                    <span><a target="_BLANK" href="https://www.instagram.com/{{ $dataDetail->username }}">{{ '@'.$dataDetail->username }}</a></span>
                                </li>
                                <li class="border-bottom border-color-gray mb-1 pb-2">
                                    <span class="fw-semibold text-dark w-130 d-inline-block">{{ __('dashboard.followers') }}:</span>
                                    <span>{{ $dataDetail->followers }}</span>
                                </li>
                                <li class="border-bottom border-color-gray mb-1 pb-2">
                                    <span class="fw-semibold text-dark w-130 d-inline-block">{{ __('dashboard.follows') }}:</span>
                                    <span>{{ $dataDetail->follows }}</span>
                                </li>
                                <li class="border-bottom border-color-gray mb-1 pb-2">
                                    <span class="fw-semibold text-dark w-130 d-inline-block">{{ __('dashboard.media') }}:</span>
                                    <span>{{ $dataDetail->media }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">{{ __('dashboard.user') }} {{ __('dashboard.posts') }}</h4>
                        <div class="dropdown action-opt">
                            <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('dashboard.blog.edit', ['id' => $dataDetail->id]) }}">
                                        <i data-feather="edit-3"></i>
                                        {{ __('dashboard.edit') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @php
                        
                        $var = [[
                            "id" => "18117872977395708",
                            "caption" => "🚀 Exciting News! GujjuTicks.com is launching soon! 🎉 A platform dedicated to supporting small and medium businesses in Gujarat! 🌍 Whether you're a local business or a service provider, get ready to connect and grow with our exclusive features for business listings, online notice boards, and more, based on district, tehsil, and villages! Stay tuned for the official launch! 💼💻 #GujjuTicks #ComingSoon #SupportLocal #SmallBusinessGujarat #MediumBusiness #GujaratEntrepreneurs #BusinessGrowth #LocalBusinesses #GujaratiCommunity #GrowWithGujjuTicks",
                            "media_type" => "VIDEO",
                            "media_url" => "https://instagram.fjga1-1.fna.fbcdn.net/o1/v/t16/f2/m86/AQPJftlleOxXMNONdT2v0L6ou3ZBczF-ux7B7FwlXOLIly6BqPjDQYyj5O0zzZIeOCqiNl8HGk5i9nHR-lGEWLJrAXuuKr3YUK16jTc.mp4?efg=eyJ4cHZfYXNzZXRfaWQiOjQwMTQ5NDgyMzAyOTE5MSwidmVuY29kZV90YWciOiJ4cHZfcHJvZ3Jlc3NpdmUuSU5TVEFHUkFNLkNMSVBTLkMzLjcyMC5kYXNoX2Jhc2VsaW5lXzFfdjEifQ&_nc_ht=instagram.fjga1-1.fna.fbcdn.net&_nc_cat=100&vs=e85e130475482ccc&_nc_vs=HBksFQIYUmlnX3hwdl9yZWVsc19wZXJtYW5lbnRfc3JfcHJvZC9BNDRDRjJGQjczNkQzNEMwM0Q5QkFEQUM0Q0RCMTg4MF92aWRlb19kYXNoaW5pdC5tcDQVAALIAQAVAhg6cGFzc3Rocm91Z2hfZXZlcnN0b3JlL0dDYTZuaHN0cWR3cTZNOEJBSUh3OW1zQ3JiQUlicV9FQUFBRhUCAsgBACgAGAAbAogHdXNlX29pbAExEnByb2dyZXNzaXZlX3JlY2lwZQExFQAAJo6n8sSJyrYBFQIoAkMzLBdATSZmZmZmZhgSZGFzaF9iYXNlbGluZV8xX3YxEQB1_gcA&ccb=9-4&oh=00_AYA7x0YjWOCJa2so54C5JJVz1AuvrlNFedFwTyTnsUjw3w&oe=6764BCD9&_nc_sid=1d576d",
                            "thumbnail_url" => "https://scontent.cdninstagram.com/v/t51.71878-15/463785696_2265951940436159_1476026117575497365_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=110&ccb=1-7&_nc_sid=18de74&_nc_ohc=WGO4ZpRTo4gQ7kNvgEq2Vd1&_nc_zt=23&_nc_ht=scontent.cdninstagram.com&edm=ANo9K5cEAAAA&_nc_gid=A7KQQgYB3WCJ3AX75LWLYms&oh=00_AYDyw9FGnH9vXk9o2odLb9QrHshyqztAvWZXHV5a3U59Kw&oe=6768D5E5",
                            "timestamp" => "2024-10-16T16:24:38+0000",
                            "permalink" => "https://www.instagram.com/reel/DBMQjPmoKuZ/",
                            "username" => "gujjuticks",
                            "like_count" => 37,
                            "comments_count" => 3,
                            "is_comment_enabled" => 1
                        ],
                        [
                            "id" => "18026189339111556",
                            "caption" => "🌟 Get Ready for GujjuTicks! 🌟Hello everyone! We're excited to announce that GujjuTicks is launching soon! Your ultimate platform for all things Gujarati is almost here. From events and cultural highlights to the best local spots and tips, we've got you covered. Follow us for updates and be part of our vibrant community celebrating Gujarati culture. Stay tuned for the big launch! #GujjuTicks #GujaratiCulture #ComingSoon #Community #StayTuned #NewBeginnings",
                            "media_type" => "IMAGE",
                            "media_url" => "https://scontent.cdninstagram.com/v/t51.29350-15/443734817_417468797925110_2639386699823557518_n.webp?stp=dst-jpg_e35_tt6&_nc_cat=102&ccb=1-7&_nc_sid=18de74&_nc_ohc=hAJ8N773qVIQ7kNvgG2ZxCo&_nc_zt=23&_nc_ht=scontent.cdninstagram.com&edm=ANo9K5cEAAAA&_nc_gid=A7KQQgYB3WCJ3AX75LWLYms&oh=00_AYCxELdRrxpeDucBM4AsSChBi5QXcY-31pDdI36PwXqjEQ&oe=6768AA6D",
                            "timestamp" => "2024-05-24T07:01:24+0000",
                            "permalink" => "https://www.instagram.com/p/C7V5LT-NVZ0/",
                            "username" => "gujjuticks",
                            "like_count" => 10,
                            "comments_count" => 3,
                            "is_comment_enabled" => 1
                        ]];

                    @endphp

                    <div class="row">

                        @foreach ($var as $item)
                            <div class="col-md-4">
                                @switch($item["media_type"])
                                    @case("IMAGE")
                                        
                                        <img src="{{ $item["media_url"] }}" class="img-fluid rounded bg-dark" alt="{{ $item["caption"] }}">
                                        @break

                                    @case("VIDEO")
                                        <video src="{{ $item["media_url"] }}" class="img-fluid rounded bg-dark" alt="{{ $item["caption"] }}">
                                        @break

                                    @default
                                @endswitch
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.dashboard>
