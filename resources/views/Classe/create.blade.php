<div class="container">

{{Form::open(['method'=>'post','action'=>'ClasseController@store'])}}
@csrf
<div class="form-group">
    {{Form::label('Name','Nomination Classe :')}}
    {{Form::text('Name','',['class'=>'form-control'])}}
</div>


<div class="form-group">
{{Form::submit('Ajouter Classe',['class'=>'btn btn-primary w-100'])}}
</div>
{{Form::close()}}

</div>