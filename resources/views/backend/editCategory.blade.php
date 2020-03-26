    @include('includes.messages')    
    <h3>{{ $formTitle }}</h3>
    {!!Form::open(['action' => ['admin\CategoryController@' . $controllerAction, $category->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::text('description', $category->description, ['class' => 'form-control', 'placeholder' => 'description text'])}}
        </div>
        <div class="form-group">
            {{Form::label('status', 'Status')}}
            {{Form::checkbox('status', $category->status, ($category->status == 1 ? true : false), array('id'=>'category') )}}
            <span id="category_status">
                {{$category->status == 1 ? 'Active' : 'Inactive' }}
            </span>
        </div>
        <div class="form-group">
            {{Form::label('image', 'Image')}}
            @if(!empty($category->image))
                <img src="{{ URL::to(asset("/storage/frontend/images/" . $category->image)) }}" class="admin-img-thumb"></img>
            @endif
            {{Form::file('category_image')}}
            <span class="notification">
                <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;Image size 500x500px
            </span>
        </div>
        {{Form::hidden('_method', $action)}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}   
        <a href="{{ url('/category') }}" class="btn btn-success"> Inapoi</a>
    {!! Form::close() !!}
    