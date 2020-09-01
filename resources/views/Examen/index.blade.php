@extends('layouts.SmsDash')
<style>
    .col-3 {
        border: 1px dashed black;
        margin: 5px 20px;
        font-size: 8px;
        font-family: 'Courier New', Courier, monospace;
        padding: 5px 5px;

    }

    #hasfileForm {
        padding: 0px 40px;
        display: none;
    }

</style>
@section('content')
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow ">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Liste Des Examens</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Matiere</th>
                                        <th scope="col">Ennoncé</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Examens as $Examen)
                                        <tr>
                                            <th scope="row">{{ $Examen->id }}</th>
                                            <td>{{ $Examen->Name }}
                                            </td>
                                            <td>{{ $Examen->Matiere->Name }} </td>
                                            <td><a href="{{Storage::url( "ExamensFiles/".$Examen->Path_Ennonce) }}">{{ $Examen->Path_Ennonce }} </a></td>
                                            <td>
                                                <form class="d-inline" action="{{ Route('Examens.edit', $Examen->id) }}"
                                                    method="GET">
                                                    <button type="submit" class="btn btn-info"> <i
                                                            class="fas fa-edit"></i></button>
                                                    @method('GET')
                                                    @csrf
                                                </form>
                                                <form class="d-inline" action="{{ url('/Examens', ['id' => $Examen->id]) }}"
                                                    method="post">

                                                    <button type="submit" class="btn btn-danger"> <i
                                                            class="fas fa-trash"></i></button>
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>


                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card shadow">
                @if (isset($SelectedExamen))
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Modifier Examen</h6>
                    </div>
                    <div class="card-body">
                        @include('Examen/editing')
                    </div>
                @else
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Ajouter Examen</h6>
                    </div>
                    <div class="card-body">
                        @include('Examen/create')
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
           
            $(".nav-link").eq(7).addClass("active");


       

           
        });

    </script>
@endsection
