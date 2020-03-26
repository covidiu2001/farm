
<?php 
// id, name, description, price, category_id, status, image, created_at, updated_at
?>

@if(count($products) > 0)
    <div class="panel-body">
        <table class="table table-striped">
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            <span class="product_table_span">Id:</span>{{ $product->id }}<br>
                            <span class="product_table_span">Imagine:</span><img src="{{ URL::to(asset("/storage/frontend/images/" . $product->image)) }}" class="admin-img-thumb"><br>
                            <span class="product_table_span">ID categorie / nume:</span>{{ $product->category_name }} <br>
                            <span class="product_table_span">Nume:</span>{{ $product->name }} <br>
                            <span class="product_table_span">Pret:</span>{{ $product->price }} <br>
                            <span class="product_table_span">Status</span>{{ $product->status == 1 ? 'Active' : 'Inactive' }}
                        </td>
                        <td>
                            {{ Form::open(array('action'=>array('admin\ProductsController@edit',$product->id))) }}
                            {{ Form::button('<i class="glyphicon glyphicon-pencil"></i> Edit', array(
                                    'type' => 'submit',
                                    'class'=> 'btn btn-primary btn-sm'
                                ))
                            }}
                                @method('get')
                            {{ Form::close() }}

                            {{ Form::open(array('action'=>array('admin\ProductsController@destroy',$product->id))) }}
                            {{ Form::button('<i class="glyphicon glyphicon-remove"></i> Delete', array(
                                    'type' => 'submit',
                                    'class'=> 'btn btn-danger btn-sm',
                                    'onclick'=>'return confirm("Are you sure?")'
                                ))
                            }}
                                @method('delete')
                            {{ Form::close() }}                            
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>
{{ $products->links() }}
@else
    <p> Nu am gasit nici un produs </p>
@endif

{{ Form::open(array('action'=>array('admin\ProductsController@create'))) }}
{{ Form::button(' Adauga', array(
        'type' => 'submit',
        'class'=> 'btn btn-success btn-sm'
    ))
}}
    @method('get')
{{ Form::close() }}



<!-- -->
<?php return; ?>
@if(count($products) > 0)
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Imagine</th>
                    <th>ID categorie / nume</th>
                    <th>Nume</th>
                    <!--<th>Descriere</th>-->
                    <th>Pret</th>                    
                    <th>Status</th>                    
                    <!--<th>Created</th>-->
                    <!--<th>Updated</th>-->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            <img src="{{ URL::to(asset("/storage/frontend/images/" . $product->image)) }}" class="admin-img-thumb"></img>
                        </td>
                        <td>{{ $product->category_name }}</td>                        
                        <td>{{ $product->name }}</td>
                        <!--<td>{{ $product->description }}</td>-->
                        <td>{{ $product->price }}</td>
                        
                        <td>{{ $product->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <!--<td>{{ $product->created_at }}</td>-->
                        <!--<td>{{ $product->updated_at }}</td>-->
                        <td>
                            {{ Form::open(array('action'=>array('admin\ProductsController@edit',$product->id))) }}
                            {{ Form::button('<i class="glyphicon glyphicon-pencil"></i> Edit', array(
                                    'type' => 'submit',
                                    'class'=> 'btn btn-primary btn-sm'
                                ))
                            }}
                                @method('get')
                            {{ Form::close() }}

                            {{ Form::open(array('action'=>array('admin\ProductsController@destroy',$product->id))) }}
                            {{ Form::button('<i class="glyphicon glyphicon-remove"></i> Delete', array(
                                    'type' => 'submit',
                                    'class'=> 'btn btn-danger btn-sm',
                                    'onclick'=>'return confirm("Are you sure?")'
                                ))
                            }}
                                @method('delete')
                            {{ Form::close() }}                            
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>
{{ $products->links() }}
@else
    <p> Nu am gasit nici un produs </p>
@endif

{{ Form::open(array('action'=>array('admin\ProductsController@create'))) }}
{{ Form::button(' Adauga', array(
        'type' => 'submit',
        'class'=> 'btn btn-success btn-sm'
    ))
}}
    @method('get')
{{ Form::close() }}