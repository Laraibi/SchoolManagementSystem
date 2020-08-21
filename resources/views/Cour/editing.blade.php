    <div class="container">

        {{ Form::open(['method' => 'PUT', 'action' => ['CourController@update', $SelectedCour->id]]) }}
        @csrf
        <div class="form-group">
            {{ Form::label('Name', 'Name :') }}
            {{ Form::text('Name', $SelectedCour->Name, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('Total_Hours', 'Total des Heures :') }}
            {{ Form::text('Total_Hours', $SelectedCour->Total_Hours, ['class' => 'form-control']) }}
        </div>


        <div class="form-group">
            {{ Form::label('Matiere_id', 'Matiere :') }}

            <?php
            if(isset($SelectedCour->Matiere)){
                $SelectedCourtMatiereID=$SelectedCour->Matiere->id;
            }else{
                $SelectedCourtMatiereID=0;
            }
            ?>
            <select name="Matiere_id" id="Matiere_id" class="form-control">
                @foreach ($Matieres as $Matiere)
                    <option  {{ $Matiere->id == $SelectedCourtMatiereID ? 'selected' : '' }}  value="{{ $Matiere->id }}">{{ $Matiere->Name }}</option>
                @endforeach
                <select>
        </div>

        <div class="form-group">
            {{ Form::submit('Modifier Cour', ['class' => 'btn btn-warning w-100']) }}
        </div>
        {{ Form::close() }}

    </div>
