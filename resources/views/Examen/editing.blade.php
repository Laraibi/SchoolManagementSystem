    <div class="container">

        {{ Form::open(['method' => 'PUT', 'action' => ['ExamenController@update', $SelectedExamen->id], 'files' => 'true']) }}
        @csrf
        <div class="form-group">
            {{ Form::label('Name', 'Name :') }}
            {{ Form::text('Name', $SelectedExamen->Name, ['class' => 'form-control']) }}
        </div>


        <div class="form-group">
            {{ Form::label('Matiere_id', 'Matiere :') }}

            <?php
            if(isset($SelectedExamen->Matiere)){
                $SelectedExamenID=$SelectedExamen->Matiere->id;
            }else{
                $SelectedExamenID=0;
            }
            ?>
            <select name="Matiere_id" id="Matiere_id" class="form-control">
                @foreach ($Matieres as $Matiere)
                    <option  {{ $Matiere->id == $SelectedExamenID ? 'selected' : '' }}  value="{{ $Matiere->id }}">{{ $Matiere->Name }}</option>
                @endforeach
                <select>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" name="Path_Ennonce" class="custom-file-input" id="Path_Ennonce">
                <label class="custom-file-label" for="Path_Ennonce">Enoncé de L'Examen :</label>
            </div>
        </div>
        <div class="form-group">
            {{ Form::submit('Modifier Examen', ['class' => 'btn btn-warning w-100']) }}
        </div>
        {{ Form::close() }}

    </div>
