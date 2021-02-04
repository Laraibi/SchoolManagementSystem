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
                            <h6 class="m-0 font-weight-bold text-primary">Liste Des Professeurs</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Professeur</th>
                                        <th scope="col">Matiere</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Teachers as $Teacher)
                                        <tr>
                                            <th scope="row">{{ $Teacher->id }}</th>
                                            <td>{{ substr($Teacher->FirstName, 0, 1) }} . {{ $Teacher->SecondName }}
                                            </td>
                                            <td>
                                                @if (isset($Teacher->Matiere))
                                                    {{ $Teacher->Matiere->Name }}
                                                @endif
                                            </td>
                                            <td>
                                                <form class="d-inline" action="{{ Route('Teachers.edit', $Teacher->id) }}"
                                                    method="GET">
                                                    <button type="submit" class="btn btn-info"> <i
                                                            class="fas fa-edit"></i></button>
                                                    @method('GET')
                                                    @csrf
                                                </form>
                                                <form class="d-inline"
                                                    action="{{ url('/Teachers', ['id' => $Teacher->id]) }}" method="post">

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
                @if (isset($SelectedTeacher))
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Modifier Professeur</h6>
                    </div>
                    <div class="card-body">
                        @include('teacher/editing')
                    </div>
                @else
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Ajouter Professeur</h6>
                    </div>
                    <div class="card-body">
                        @include('teacher/create')
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // alert("Hello World");
            $("#reservationdate").datetimepicker({
                defaultDate: "01/1/1990",
                format: 'L',
                format: 'YYYY-MM-DD'
            });
            
            // $(".nav-link").eq(3).addClass("active");
        });

    </script>
@endsection
