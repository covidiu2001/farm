
@if(count($users) > 0)
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nume</th>
                    <th>Email</th>
                    <th>Email verificat la</th>
                    <th>Rol</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email_verified_at }}</td>
                        <td>{{ $user->user_role }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <!--<a href="{{ url('category/' . $user->id . '/edit') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i> Edit</a>-->
                            {{ Form::open(array('action'=>array('admin\UsersController@edit',$user->id))) }}
                            {{ Form::button('<i class="glyphicon glyphicon-pencil"></i> Edit', array(
                                    'type' => 'submit',
                                    'class'=> 'btn btn-primary btn-sm'
                                ))
                            }}
                                @method('get')
                            {{ Form::close() }}

                            {{ Form::open(array('action'=>array('admin\UsersController@destroy',$user->id))) }}
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
    <p> Nu am gasit nici un user </p>
@endif

{{ Form::open(array('action'=>array('admin\UsersController@create'))) }}
{{ Form::button(' Adauga', array(
        'type' => 'submit',
        'class'=> 'btn btn-success btn-sm'
    ))
}}
    @method('get')
{{ Form::close() }}