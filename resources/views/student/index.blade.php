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
        width: 50px !important;
        height: 50px !important;
    }
label i{
    font-size: 25px;
    margin: 0 5px;
}
</style>
@section('content')
    <div class="row  mb-3">
        <div class="col-3 "></div>
        <div class="col-6  text-center ">
            <h3 class="text-info text-bold">Gestion des Etudiants</h3>
        </div>
        <div class="col-3"></div>

    </div>
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow ">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Liste Des Etudiants</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <table class="table table-striped table-bordered table-hover dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Etudiant </th>
                                            <th scope="col">Parent</th>
                                            <th scope="col">Classe</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Students as $Student)


                                            <tr>
                                                <th scope="row"> <img
                                                        src="{{ asset("/storage/StudentImages/$Student->Photo") }}"
                                                        class="profile-user-img img-fluid img-circle " alt="..."></th>
                                                <td>{{ strtoupper(substr($Student->FirstName, 0, 1)) }} .
                                                    {{ $Student->SecondName }}
                                                </td>
                                                {{-- <td>
                                                    {{ substr($Student->StudentParent->FirstName, 0, 1) }} .
                                                    {{ $Student->StudentParent->SecondName }} </td>
                                                --}}

                                                <td>
                                                    @if (isset($Student->StudentParent))
                                                        {{ strtoupper(substr($Student->StudentParent->FirstName, 0, 1)) }} .
                                                        {{ $Student->StudentParent->SecondName }}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if (isset($Student->Classe))
                                                        {{ $Student->Classe->name }}
                                                    @endif
                                                <td>
                                                    <form class="d-inline"
                                                        action="{{ Route('Students.edit', $Student->id) }}" method="GET">
                                                        <button type="submit" class="btn btn-info"> <i
                                                                class="fas fa-edit"></i></button>
                                                        @method('GET')
                                                        @csrf
                                                    </form>
                                                    <form class="d-inline"
                                                        action="{{ url('/Students', ['id' => $Student->id]) }}"
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

                            <div class="row justify-content-center">
                                {{-- <div class="col-12 "> --}}
                                    {{ $Students->render() }}
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card shadow">
                @if (isset($SelectedStudent))
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Modifier Etudiant</h6>
                    </div>
                    <div class="card-body">
                        @include('student/editing')
                    </div>
                @else
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Nouveau Etudiant</h6>
                    </div>
                    <div class="card-body">
                        @include('student/create')
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
            $("#reservationdate").datetimepicker({
                defaultDate: "01/1/1990",
                format: 'L',
                format: 'YYYY-MM-DD'
            });
            // $(".nav-link").eq(1).addClass("active");
        });

    </script>
@endsection
