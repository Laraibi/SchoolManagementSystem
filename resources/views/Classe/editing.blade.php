    <div class="container">

        {{ Form::open(['method' => 'PUT', 'action' => ['ClasseController@update', $SelectedClasse->id]]) }}
        @csrf
        <div class="form-group">
            {{ Form::label('Name', 'Nomination Classe :') }}
            {{ Form::text('Name', $SelectedClasse->name, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::submit('Modifier Classe', ['class' => 'btn btn-warning w-100']) }}
        </div>
        {{ Form::close() }}

    </div>
