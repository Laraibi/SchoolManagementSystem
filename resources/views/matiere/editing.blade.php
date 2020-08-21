    <div class="container">

        {{ Form::open(['method' => 'PUT', 'action' => ['MatiereController@update', $SelectedMatiere->id]]) }}
        @csrf
        <div class="form-group">
            {{ Form::label('Name', 'Name :') }}
            {{ Form::text('Name', $SelectedMatiere->Name, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::submit('Modifier Matiere', ['class' => 'btn btn-warning w-100']) }}
        </div>
        {{ Form::close() }}

    </div>
