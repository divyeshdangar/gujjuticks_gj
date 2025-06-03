    <section class="page-title-box d-none d-md-block">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">{{ $metaData['title'] }}</h3>
                        @if(!empty($metaData['breadCrumb']))
                            <div class="page-next">
                                <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>    
                                        @foreach ($metaData['breadCrumb'] as $key => $value)
                                            @if ($loop->last)
                                                <li class="breadcrumb-item active" aria-current="page">{{ $value['title'] }}</li>
                                            @else
                                                <li class="breadcrumb-item"><a href="{{ route($value['route']) }}">{{ $value['title'] }}</a></li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
