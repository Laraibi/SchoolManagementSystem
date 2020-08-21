@extends('layouts.SmsDash')
<style>
    .col-3 {
        border: 1px dashed black;
        margin: 5px 20px;
        font-size: 8px;
        font-family: 'Courier New', Courier, monospace;
        padding: 5px 5px;

    }

</style>
@section('content')
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow ">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Liste Des Matiere</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Nombre de Professeurs</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Matieres as $Matiere)
                                            <tr>
                                                <th scope="row">{{ $Matiere->id }}</th>
                                                <td>{{ $Matiere->Name}} 
                                                </td>
                                                <td>{{count( $Matiere->Teachers->all())}} </td>
                                                <td>
                                                    <form class="d-inline"
                                                        action="{{ Route('Matieres.edit', $Matiere->id) }}" method="GET">
                                                        <button type="submit" class="btn btn-info"> <i
                                                                class="fas fa-edit"></i></button>
                                                        @method('GET')
                                                        @csrf
                                                    </form>
                                                    <form class="d-inline"
                                                        action="{{ url('/Matieres', ['id' => $Matiere->id]) }}"
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
                    @if (isset($SelectedMatiere))
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Modifier Matiere</h6>
                        </div>
                        <div class="card-body">
                            @include('matiere/editing')
                        </div>
                    @else
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Ajouter Matiere</h6>
                    </div>
                    <div class="card-body">
                        @include('matiere/create')
                    </div>
                    @endif
                </div>
            </div>
        </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // alert('heloo');

            $(".nav-link").eq(5).addClass("active");
        });

    </script>
@endsection
