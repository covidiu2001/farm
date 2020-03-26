
@if(count($categories) > 0)
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->description}}</td>
                        <td>{{$category->status == 1 ? 'Active' : 'Inactive'}}</td>
                        <td>
                            <img src="{{ URL::to(asset('/storage/frontend/images/' . $category->image)) }}" class="admin-img-thumb"></img>
                        </td>
                        <td>{{$category->created_at}}</td>
                        <td>{{$category->updated_at}}</td>
                        <td>
                            <!--<a href="{{ url('category/' . $category->id . '/edit') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i> Edit</a>-->
                            {{ Form::open(array('action'=>array('admin\CategoryController@edit',$category->id))) }}
                            {{ Form::button('<i class="glyphicon glyphicon-pencil"></i> Edit', array(
                                    'type' => 'submit',
                                    'class'=> 'btn btn-primary btn-sm'
                                ))
                            }}
                                @method('get')
                            {{ Form::close() }}

                            {{ Form::open(array('action'=>array('admin\CategoryController@destroy',$category->id))) }}
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
@else
    <p> Nu am gasit nici o categorie </p>
@endif

{{ Form::open(array('action'=>array('admin\CategoryController@create'))) }}
{{ Form::button(' Adauga', array(
        'type' => 'submit',
        'class'=> 'btn btn-success btn-sm'
    ))
}}
    @method('get')
{{ Form::close() }}