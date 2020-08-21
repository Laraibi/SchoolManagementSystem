<div class="container">

    {{ Form::open(['method' => 'post', 'action' => 'StudentController@store', 'files' => 'true']) }}
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
        {{-- {{ Form::label('Male', '<i class="fas fa-female"></i>') }} --}}
        <label for="Male"><i class="fas fa-Male"></i></label>
        {{ Form::radio('Male', 1, ['class' => 'form-check-input',"id"=>"Male"]) }}
        <label for="female"><i class="fas fa-female"></i></label>
        {{ Form::radio('Male', 0, ['class' => 'form-check-input',"id"=>"female"]) }}
    </div>
    <div class="form-group">
        {{ Form::label('Parent_id', 'Parent :') }}
        <select name="Parent_id" id="Parent_id" class="form-control">
            @foreach ($StudentParents as $StudentParent)
                <option value="{{ $StudentParent->id }}">{{ $StudentParent->FirstName }}</option>
            @endforeach
            <select>
    </div>
    <div class="form-group">
        <div class="custom-file">
            <input type="file" name="Photo" class="custom-file-input" id="Photo">
            <label class="custom-file-label" for="Photo">Student Picture :</label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::submit('Ajouter Etudiant', ['class' => 'btn btn-primary w-100']) }}
    </div>
    {{ Form::close() }}
</div>
