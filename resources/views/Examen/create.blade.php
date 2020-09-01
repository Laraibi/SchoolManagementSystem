<div class="container">

    {{ Form::open(['method' => 'post', 'action' => 'ExamenController@store', 'files' => 'true']) }}
    @csrf

    <div class="form-group">
        {{ Form::label('Name', 'Name :') }}
        {{ Form::text('Name', '', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('Matiere_id', 'Matiere :') }}
        <select name="Matiere_id" id="Matiere_id" class="form-control">
            @foreach ($Matieres as $Matiere)
                <option value="{{ $Matiere->id }}">{{ $Matiere->Name }}</option>
            @endforeach
            <select>
    </div>
    <div class="form-group">
        <div class="custom-file">
            <input type="file" name="Path_Ennonce" class="custom-file-input" id="ExamenFile">
            <label class="custom-file-label" for="ExamenFile">Enoncé de L'Examen :</label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::submit('Ajouter Examen', ['class' => 'btn btn-primary w-100']) }}
    </div>
    {{ Form::close() }}

</div>
