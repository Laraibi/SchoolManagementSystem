    <div class="container">

        {{ Form::open(['method' => 'PUT', 'action' => ['TeacherController@update', $SelectedTeacher->id]]) }}
        @csrf
        <div class="form-group">
            {{ Form::label('FirstName', 'First Name :') }}
            {{ Form::text('FirstName', $SelectedTeacher->FirstName, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('SecondName', 'Second Name :') }}
            {{ Form::text('SecondName', $SelectedTeacher->SecondName, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            <label>Matiere :</label>
            <select name="Matiere" class="custom-select">
                <?php
                if(isset($SelectedTeacher->Matiere)){
                    $TeacherMatiereId=$SelectedTeacher->Matiere->id;
                }else{
                    $TeacherMatiereId=0;
                }
                    ?>
                @if (isset($Matieres))
                    @foreach ($Matieres as $Matiere)
                        <option {{ $Matiere->id == $TeacherMatiereId ? 'selected' : '' }} value="{{ $Matiere->id }}">{{ $Matiere->Name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('DateOfBirth', 'Date Of Birth :') }}
            {{ Form::text('DateOfBirth', $SelectedTeacher->DateOfBirth, ['class' => 'form-control date']) }}
        </div>
        <div class="form-group">

            {{ Form::label('Male', 'M:') }}
            {{ Form::radio('Male', 1, ['class' => 'form-check-input', 'checked' => $SelectedTeacher->Male == 1 ? 'checked' : '']) }}
            {{ Form::label('Male', 'F:') }}
            {{ Form::radio('Male', 0, ['class' => 'form-check-input']) }}
        </div>



        <div class="form-group">
            {{ Form::submit('Modifier Professeur', ['class' => 'btn btn-warning w-100']) }}
        </div>
        {{ Form::close() }}

    </div>
