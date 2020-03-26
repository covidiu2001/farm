
        <div class="col-md-10 panel-default">
            <div class="content-box-header panel-heading">
                <div class="panel-title ">Imagini</div>
                <?php echo $product_id; ?>
            </div>
            <div class="content-box-large box-with-header">
                <div>
                    @if(count($product_images) > 0)
                        <div class="row form-group">
                            <div class="col-lg-12">                        
                                @foreach($product_images as $image)
                                    <div class="img-wrap">
                                        <span class="close" id="<?php echo $image->image; ?>">&times;</span>
                                        {!! Form::hidden('image_id', $image->id, array('id' => 'image_id')) !!}
                                        {!! Form::hidden('product_id', $image->product_id, array('id' => 'product_id')) !!}
                                        <img src="{{ URL::to(asset("/storage/frontend/images/" . $image->image)) }}" class="admin-img-thumb">
                                    </div>
                                @endforeach                                             
                            </div>
                        </div>

                    @else
                       <p> Nu am gasit nici o imagine </p>
                   @endif

                    <div class="row form-group">
                        {!! Form::open(['action' => 'admin\ImagesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        {{ Form::file('product_image', ['class' => 'btn btn-default']) }}
                        <p class="notification">
                            <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;Image size 250x250px
                        </p>
                        {!! Form::hidden('product_id', $product_id, array('id' => 'product_id')) !!}
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                        <a href="{{ url('/products') }}" class="btn btn-success"> Inapoi</a>
                        {!! Form::close() !!}            
                    </div>                    
                </div>

            </div>
        </div>
