<div class="container">

    {{ Form::open(['method' => 'post', 'action' => 'TeacherController@store']) }}
    @csrf
    <div class="form-group">
        {{ Form::label('FirstName', 'First Name :') }}
        {{ Form::text('FirstName', '', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('SecondName', 'Second Name :') }}
        {{ Form::text('SecondName', '', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <label>Matiere :</label>
        <select name="Matiere_id" class="custom-select">
            @if (isset($Matieres))
                @foreach ($Matieres as $Matiere)
                    <option value="{{ $Matiere->id }}">{{ $Matiere->Name }}</option>
                @endforeach
            @endif
        </select>
    </div>



    <div class="form-group">
        <label>Date de naissance :</label>
          <div class="input-group date" id="reservationdate" data-target-input="nearest">
              <input type="text" name="DateOfBirth" class="form-control datepicker-input" data-target="#reservationdate">
              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
          </div>
      </div>




    {{-- <div class="form-group">
        {{ Form::label('DateOfBirth', 'Date Of Birth :') }}
        {{ Form::text('DateOfBirth', '', ['class' => 'form-control date']) }}
    </div> --}}
    <div class="form-group">
        {{ Form::label('Male', 'M:') }}
        {{ Form::radio('Male', 1, ['class' => 'form-check-input']) }}
        {{ Form::label('Male', 'F:') }}
        {{ Form::radio('Male', 0, ['class' => 'form-check-input']) }}
    </div>


    <div class="form-group">
        {{ Form::submit('Ajouter Professeur', ['class' => 'btn btn-primary w-100']) }}
    </div>
    {{ Form::close() }}

</div>
