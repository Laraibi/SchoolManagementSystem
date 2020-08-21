    <div class="container">

        {{ Form::open(['method' => 'PUT', 'action' => ['StudentController@update', $SelectedStudent->id], 'files' => 'true']) }}
        @csrf
        <div class="form-group">
            {{ Form::label('FirstName', 'First Name :') }}
            {{ Form::text('FirstName', $SelectedStudent->FirstName, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('SecondName', 'Second Name :') }}
            {{ Form::text('SecondName', $SelectedStudent->SecondName, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('DateOfBirth', 'Date Of Birth :') }}
            {{ Form::text('DateOfBirth', $SelectedStudent->DateOfBirth, ['class' => 'form-control date']) }}
        </div>
        <div class="form-group">
            <label for="Male"><i class="fas fa-Male"></i></label>
            {{ Form::radio('Male', 1, ['class' => 'form-check-input','id'=>'Male', 'checked' => $SelectedStudent->Male == 1 ? 'checked' : '']) }}
            <label for="Female"><i class="fas fa-female"></i></label>
            {{ Form::radio('Male', 0, ['class' => 'form-check-input','id'=>'Female']) }}
        </div>

        <div class="form-group">
            {{ Form::label('Parent_id', 'Parent :') }}
            <select name="Parent_id" id="Parent_id" class="form-control">
                <?php
                if(isset($SelectedStudent->StudentParent)){
                    $StudentParentID=$SelectedStudent->StudentParent->id;
                }else{
                    $StudentParentID=0;
                }
                    ?>
                @foreach ($StudentParents as $StudentParent)
                    <option {{ $StudentParent->id == $StudentParentID ? 'selected' : '' }}
                        value="{{ $StudentParent->id }}">{{ $StudentParent->FirstName }}</option>
                @endforeach
                <select>
        </div>
        <div class="row ">
            <div class="col-6 d-flex align-items-center">
                <div class="form-group  w-100">
                    <div class="custom-file">
                        <input type="file" name="Photo" class="custom-file-input" id="Photo">
                        <label class="custom-file-label" for="Photo">Student Picture :</label>
                    </div>
                </div>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center"><img class="img-circle img-fluid shadow " style="width: 100px;height:100px;"
                    src="{{ asset("/storage/StudentImages/$SelectedStudent->Photo") }}" alt="" /></div>
        </div>


        <div class="form-group">
            <div class="row">
                <div class="col-6">{{ Form::submit('Edit Student', ['class' => 'btn btn-warning w-100']) }}</div>

            </div>
        </div>
        {{ Form::close() }}

    </div>
