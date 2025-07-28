<div class="job-box bookmark-post card mb-5">
    <div class="p-4">
        <div class="row align-items-center">
            <div class="col-lg-2 text-center">
                <img src="{{ route('pages.image.cool', ['slug' => 'characters-'.CommonHelper::getInitials($data->name).'.jpg']) }}" alt="" class="img-fluid rounded-3">
            </div>
            <div class="col-lg-10">
                <div class="mt-3 mt-lg-0">
                    <h5 class="fs-17 mb-1">
                        <h3 class="h4 text-dark" style="display: inline-block">
                            {{ $data->name }}
                            <small class="text-muted fw-normal fs-12">({{ $dataDetail->name }}, {{ $dataDetail->state }})</small>
                        </h3> 
                    </h5>
                    <p class="text-muted fs-14 mb-0">{{ $data->address }}</p>
                    <div class="mt-2">
                        <span class="badge bg-success mt-1">{{ $data->rating }} Ratings </span>
                        <span class="badge text-bg-warning mt-1">{{ $data->user_ratings_total }} User Ratings</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="favorite-icon d-none">
            <a href="javascript:void(0)"><i class="uil uil-heart-alt fs-18"></i></a>
        </div>
    </div>
    <div class="p-3 bg-light">
        <div class="row justify-content-between">
            <div class="col-md-8">
                <div>
                    <ul class="list-inline mb-0">
                        @php
                            $cats = explode(',', $data->category);
                        @endphp

                        @foreach($cats as $key => $value)
                            <li class="list-inline-item badge bg-info-subtle text-info">{{ ucfirst(str_replace('_', ' ', $value)) }}</li>                            
                        @endforeach
                    </ul>
                </div>
            </div>
            
            @if(false && $data->google_maps_url && $data->google_maps_url != "")
                <div class="col-md-3">
                    <div class="text-md-end text-end">
                        <a target="_BLANK" href="https://www.google.com/maps/search/?api=1&query={{ $data->latitude }},{{ $data->longitude }}" rel="noopener noreferrer nofollow" class="primary-link">Google Map</a>
                        @if(false)
                            Replace link
                            https://www.google.com/maps/search/?api=1&query=Lal+Darwaja+Ahmedabad&query_place_id=ChIJxS5EgoqEXjkRfdf98i_2u5o
                        @endif
                    </div>
                </div>                
            @endif
            
        </div>
        
    </div>
</div>
