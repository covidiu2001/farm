    @include('includes.messages')    
    <h3>{{ $formTitle }}</h3>
    {!!Form::open(['action' => ['admin\SliderController@' . $controllerAction, $slider->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $slider->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::text('description', $slider->description, ['class' => 'form-control', 'placeholder' => 'Description text'])}}
        </div>
        <div class="form-group">
            {{Form::label('button_text', 'Text for button')}}
            {{Form::text('button_text', $slider->button_text, ['class' => 'form-control', 'placeholder' => 'Text for button'])}}
        </div>
        <div class="form-group">
            {{Form::label('status', 'Status')}}
            {{Form::checkbox('status', $slider->status, ($slider->status == 1 ? true : false), array('id'=>'category') )}}
            <span id="category_status">
                {{$slider->status == 1 ? 'Active' : 'Inactive' }}
            </span>
        </div>
        <div class="form-group">
            {{Form::label('image', 'Image')}}
            @if(!empty($slider->image))
                <img src="{{ URL::to(asset("/storage/frontend/images/" . $slider->image)) }}" class="admin-img-thumb"></img>
            @endif
            {{Form::file('slider_image')}}
            <span class="notification">
                <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;Image size 1920x1000px
            </span>
        </div>
        {{Form::hidden('_method', $action)}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}   
        <a href="{{ url('/slider') }}" class="btn btn-success"> Inapoi</a>
    {!! Form::close() !!}
    