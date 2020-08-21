    <div class="container">

        {{ Form::open(['method' => 'PUT', 'action' => ['StudentParentController@update', $SelectedParent->id]]) }}
        @csrf
        <div class="form-group">
            {{ Form::label('FirstName', 'First Name :') }}
            {{ Form::text('FirstName', $SelectedParent->FirstName, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('SecondName', 'Second Name :') }}
            {{ Form::text('SecondName', $SelectedParent->SecondName, ['class' => 'form-control']) }}
        </div>
       
        <div class="form-group">
                {{ Form::submit('Edit Parent', ['class' => 'btn btn-warning w-100']) }}
            
        </div>
        {{ Form::close() }}

    </div>
