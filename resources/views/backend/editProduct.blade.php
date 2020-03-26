
    <div class="col-md-10 panel-default">
        <div class="content-box-header panel-heading">
            <div class="panel-title ">{{ $formTitle }}</div>
        </div>
        <div class="content-box-large box-with-header">
            @include('includes.messages')
            {!! Form::open(['action' => ['admin\ProductsController@' . $controllerAction, $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="row form-group">
                    {{ Form::label('name', 'Name', ['class' => 'col-md-3']) }}
                    <div class="col-lg-9">
                        {{ Form::text('name', $product->name, ['class' => 'form-control', 'placeholder' => 'Nume']) }}
                    </div>
                </div>
                <div class="row form-group">
                    {{ Form::label('description', 'Description', ['class' => 'col-md-3']) }}
                    <div class="col-lg-9">
                        {{ Form::text('description', $product->description, ['class' => 'form-control', 'placeholder' => 'Descriere']) }}
                    </div>
                </div>
                <div class="row form-group">
                    {{ Form::label('long_description', 'Long description', ['class' => 'col-md-3']) }}
                    <div class="col-lg-9">
                        {{ Form::textarea('long_description', $product->long_description, ['class' => 'form-control', 'rows' => 10, 'placeholder' => 'Descriere mai detailata']) }}
                    </div>
                </div>            
                <div class="row form-group">
                    {{ Form::label('price', 'Pret', ['class' => 'col-md-3']) }}
                    <div class="col-lg-9">
                        {{ Form::input('number', 'price', $product->price, ['class' => 'form-control', 'placeholder' => 'Pret', 'min' => '0', 'step' => '0.1']) }}
                    </div>
                </div>
                <div class="row form-group">
                    <?php if(!empty($categories)) {
                        $categoryArr = array();
                        foreach($categories as $category) {
                            $categoryArr[$category['id']] = $category['name'];
                        }
                    } ?>

                    {{ Form::label('category', 'Categorie', ['class' => 'col-md-3']) }}
                    <div class="col-lg-9">
                        {{ Form::select('category_id', $categoryArr, $product->category_id, ['class' => 'select_category']) }}
                    </div>
                </div>
                <div class="row form-group">
                    {{ Form::label('status', 'Status', ['class' => 'col-md-3']) }}
                    <div class="col-lg-9">
                    {{ Form::checkbox('status', $product->status, ($product->status == 1 ? true : false), array('id'=>'category')) }}
                        <span id="category_status">
                            {{ $product->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            <div class="row form-group">
                {{ Form::hidden('_method', $action) }}
                {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                <a href="{{ url('/products') }}" class="btn btn-success"> Inapoi</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    
    <hr>

    <div class="row" id="product_images">
        @include('backend.productImages')
    </div>
    <div class="clearfix"></div>
        
    <hr>
    
    <div class="row">
        <div class="col-md-8 panel-default">
            <div class="content-box-header panel-heading">
                <div class="panel-title ">Fisa produsului</div>
            </div>
            <div class="content-box-large box-with-header">
                <div> 
                    <?php $stoc = 0; ?>
                    @if(count($product_activity) > 0)
                       
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Intrari</th>
                                    <th>Iesiri</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($product_activity as $activity)
                                    <tr>
                                        <td>{{ $activity->created_at }}</td>
                                        <td>{{ $activity->in }}</td>
                                        <td>{{ $activity->out }}</td>
                                    </tr>
                                    <?php $stoc = $stoc + $activity->in - $activity->out; ?>
                                @endforeach
                            </tbody>
                        </table>
                       @else
                       <p> Nu am gasit nici o activitate </p>
                   @endif
                </div>
                <div class="box-row">
                   Stoc curent: {{ $stoc }}
                </div>            
                <div class="">
                    {!! Form::open(['action' => 'admin\StocsController@store', 'method' => 'POST']) !!}
                    <div class="row form-group">
                        {{ Form::label('quantity', 'Cantitate', ['class' => 'col-md-3']) }}
                        <div class="col-lg-9">
                            {{ Form::input('number', 'quantity', 1, ['class' => 'form-control', 'placeholder' => 'Cantitate', 'min' => '0', 'step' => '1']) }}
                        </div>
                    </div>
                    {!! Form::hidden('product_id', $product->id, array('id' => 'product_id')) !!}
                    {{ Form::submit('Adauga', ['class' => 'btn btn-primary']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    
    