
@if(count($sliders) > 0)
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Button text</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sliders as $slider)
                    <tr>
                        <td>{{$slider->id}}</td>
                        <td>{{$slider->title}}</td>
                        <td>{{$slider->description}}</td>
                        <td>{{$slider->button_text}}</td>
                        <td>{{$slider->status == 1 ? 'Active' : 'Inactive'}}</td>
                        <td>
                            <img src="{{ URL::to(asset("/storage/frontend/images/" . $slider->image)) }}" class="admin-img-thumb"></img>
                        </td>
                        <td>{{$slider->created_at}}</td>
                        <td>{{$slider->updated_at}}</td>
                        <td>
                            <!--<a href="{{ url('category/' . $slider->id . '/edit') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i> Edit</a>-->
                            {{ Form::open(array('action'=>array('admin\SliderController@edit',$slider->id))) }}
                            {{ Form::button('<i class="glyphicon glyphicon-pencil"></i> Edit', array(
                                    'type' => 'submit',
                                    'class'=> 'btn btn-primary btn-sm'
                                ))
                            }}
                                @method('get')
                            {{ Form::close() }}

                            {{ Form::open(array('action'=>array('admin\SliderController@destroy',$slider->id))) }}
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
    <p> Nu am gasit nici un slider </p>
@endif

{{ Form::open(array('action'=>array('admin\SliderController@create'))) }}
{{ Form::button(' Adauga', array(
        'type' => 'submit',
        'class'=> 'btn btn-success btn-sm'
    ))
}}
    @method('get')
{{ Form::close() }}