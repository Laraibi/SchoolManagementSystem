<div class="container">

    {{ Form::open(['method' => 'post', 'action' => 'CourController@store', 'files' => 'true']) }}
    @csrf

    <div class="form-group">
        {{ Form::label('Name', 'Name :') }}
        {{ Form::text('Name', '', ['class' => 'form-control']) }}
    </div>


    <div class="form-group">
        {{ Form::label('Total_Hours', 'Total des Heures :') }}
        {{ Form::text('Total_Hours', '', ['class' => 'form-control']) }}
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
        <label for="hasfiles">Contient Des Fichiers</label>
        <input type="checkbox" name="hasfiles" id="hasfiles">
    </div>
    
    <div id="hasfileForm">
        <div class="form-group">
            {{ Form::label('FileName', 'Nom Du Fichier :') }}
            {{ Form::text('FileName', '', ['class' => 'form-control','disabled'=>'disabled']) }}
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input disabled type="file" name="CourseFile" class="custom-file-input" id="CourseFile">
                <label class="custom-file-label" for="CourseFile">Fichier du Cour :</label>
            </div>
        </div>
        <button type="button" id="addFileBtn" class="btn btn-info w-100 my-2">Ajouter un autre Fichier</button>
    </div>

   
    <div class="form-group">
        {{ Form::submit('Ajouter Cour', ['class' => 'btn btn-primary w-100']) }}
    </div>
    {{ Form::close() }}

</div>
