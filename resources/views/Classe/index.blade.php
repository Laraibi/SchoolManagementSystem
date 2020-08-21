@extends('layouts.SmsDash')
<style>
    .table td,
    .table th {
        /* border: 1px dashed black;
        margin: 5px 20px; */
        font-size: 15px;
        font-family: 'Courier New', Courier, monospace;
        vertical-align: middle !important;
        height: 80px;
        text-align: center;
        font-weight: bold;
        /* padding: 0px 0px;
        padding-right: 0px; */
    }

    th img {
        width: 50px;
        height: 50px;
    }

    .fa-plus-square {
        margin-top: 2px;
        font-size: 20px;
    }

    .modal {
        width: 800px;
    }

</style>
@section('content')
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow ">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Liste Des Classes</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nomination</th>
                                        <th scope="col">Total Etudiants</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Classes as $Classe)
                                        <tr>
                                            <th scope="row">{{ $Classe->id }}</th>
                                            <td>{{ $Classe->name }}</td>
                                            <td>{{ isset($Classe->Students) ? count($Classe->Students->all()) : 0 }}
                                            </td>
                                            <td>
                                                <form class="d-inline" action="{{ Route('Classes.edit', $Classe->id) }}"
                                                    method="GET">
                                                    <button type="submit" class="btn btn-info"> <i
                                                            class="fas fa-edit"></i></button>
                                                    @method('GET')
                                                    @csrf
                                                </form>
                                                <form class="d-inline" action="{{ url('/Classes', ['id' => $Classe->id]) }}"
                                                    method="post">

                                                    <button type="submit" class="btn btn-danger"> <i
                                                            class="fas fa-trash"></i></button>
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                                <form class="d-inline" action="{{ Route('Classes.show', $Classe->id) }}"
                                                    method="GET">
                                                    <button type="submit" class="btn btn-light"> <i
                                                            class="fas fa-users"></i></button>
                                                    @method('GET')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="w-auto m-auto">
                                {{$Classes->render()}}
                            </div>
                           
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-4">
            <div class="card shadow">
                @if (isset($SelectedClasse))
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Modifier Classe</h6>
                    </div>
                    <div class="card-body">
                        @include('Classe/editing')
                    </div>
                @else
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Nouvelle Classe</h6>
                    </div>
                    <div class="card-body">
                        @include('Classe/create')
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if (isset($ClasseToShow))

        <div class="card shadow mt-5">
            <div class="card-header">
                <h4 class="m-0 font-weight-bold text-primary">Classe : {{ $ClasseToShow->name }}</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    @if (isset($ClasseToShow->Students))
                        <div class="col-10">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Etudiant </th>
                                        <th scope="col">Parent</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ClasseToShow->Students as $Student)
                                        <tr>
                                            <th scope="row"> <img
                                                    src="{{ asset("/storage/StudentImages/$Student->Photo") }}"
                                                    class="img-thumbnail rounded " alt="..."></th>
                                            <td>{{ strtoupper(substr($Student->FirstName, 0, 1)) }} .
                                                {{ $Student->SecondName }}
                                            </td>
                                            <td>
                                                @if (isset($Student->StudentParent))
                                                    {{ strtoupper(substr($Student->StudentParent->FirstName, 0, 1)) }} .
                                                    {{ $Student->StudentParent->SecondName }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('removeStudentFromClasse', ['class_id' => $ClasseToShow->id, 'student_id' => $Student->id]) }}"
                                                    class="badge badge-danger">Retirer</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-2 justify-content-center">
                            <button class="btn btn-info w-100" data-toggle="modal" data-target="#FreeStudentsModal"> <i
                                    class="fa fa-plus-square text-light float-left"></i>
                                Affecter Etudiant </button>
                            <!-- Modal -->
                            <div class="modal fade" id="FreeStudentsModal" role="dialog"
                                aria-labelledby="FreeStudentsModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-primary" id="FreeStudentsModalTitle">Etuiants
                                                Sans
                                                Classe</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        {{ Form::open(['action' => 'ClasseController@addStudents', 'method' => 'post']) }}
                                        @csrf
                                        <div class="modal-body">

                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Etudiant </th>
                                                        <th scope="col">Parent</th>
                                                        <th scope="col">Affecter</th>
                                                    </tr>
                                                </thead>
                                                <input type="hidden" name="ClasseToShow" value="{{ $ClasseToShow->id }}" />
                                                <tbody>
                                                    @foreach ($FreeStudents as $Student)
                                                        <tr>
                                                            <th scope="row"> <img
                                                                    src="{{ asset("/storage/StudentImages/$Student->Photo") }}"
                                                                    class="img-thumbnail rounded " alt="..."></th>
                                                            <td>{{ strtoupper(substr($Student->FirstName, 0, 1)) }} .
                                                                {{ $Student->SecondName }}
                                                            </td>
                                                            <td>
                                                                @if (isset($Student->StudentParent))
                                                                    {{ strtoupper(substr($Student->StudentParent->FirstName, 0, 1)) }}
                                                                    .
                                                                    {{ $Student->StudentParent->SecondName }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input name="{{ $Student->FirstName }}" type="checkbox"
                                                                    value="{{ $Student->id }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // alert('heloo');

            $(".nav-link").eq(4).addClass("active");
        });

    </script>
@endsection
