<!-- Start All Title Box / Breadcrumbs -->
@if(!empty($breadcrumbs))
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{ $breadcrumbs['header'] }}</h2>
                    @if( count($breadcrumbs['items']) >0 )
                        <ul class="breadcrumb">
                            <?php $endKeyArray = array_key_last($breadcrumbs['items']); ?>
                            @foreach($breadcrumbs['items'] as $key => $val)
                                @if($key != $endKeyArray)
                                    <li class="breadcrumb-item"><a href="{{ $val['href'] }}">{{ trans($val['text']) }}</a></li>
                                @else 
                                    <li class="breadcrumb-item active">{{ trans($val['text']) }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

<!-- End All Title Box -->