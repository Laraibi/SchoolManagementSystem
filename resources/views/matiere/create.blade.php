<div class="container">

{{Form::open(['method'=>'post','action'=>'MatiereController@store'])}}
@csrf
<div class="form-group">
    {{Form::label('Name','Name :')}}
    {{Form::text('Name','',['class'=>'form-control'])}}
</div>



<div class="form-group">
{{Form::submit('Ajouter Matiere',['class'=>'btn btn-primary w-100'])}}
</div>
{{Form::close()}}

</div>