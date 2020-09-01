<div class="container">

{{Form::open(['method'=>'post','action'=>'StudentParentController@store'])}}
@csrf
<div class="form-group">
    {{Form::label('FirstName','First Name :')}}
    {{Form::text('FirstName','',['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('SecondName','Second Name :')}}
    {{Form::text('SecondName','',['class'=>'form-control'])}}
</div>

<div class="form-group">
{{Form::submit('Ajouter Parent',['class'=>'btn btn-primary w-100'])}}
</div>
{{Form::close()}}

</div>