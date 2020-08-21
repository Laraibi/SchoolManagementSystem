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
                            <h6 class="m-0 font-weight-bold text-primary">Liste Des Cours</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Matiere</th>
                                        <th scope="col">Nombre D'Heures</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Cours as $Cour)
                                        <tr>
                                            <th scope="row">{{ $Cour->id }}</th>
                                            <td>{{ $Cour->Name }}
                                            </td>
                                            <td>{{ $Cour->Matiere->Name }} </td>
                                            <td>{{ $Cour->Total_Hours }} </td>
                                            <td>
                                                <form class="d-inline" action="{{ Route('Cours.edit', $Cour->id) }}"
                                                    method="GET">
                                                    <button type="submit" class="btn btn-info"> <i
                                                            class="fas fa-edit"></i></button>
                                                    @method('GET')
                                                    @csrf
                                                </form>
                                                <form class="d-inline" action="{{ url('/Cours', ['id' => $Cour->id]) }}"
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
                @if (isset($SelectedCour))
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Modifier Cour</h6>
                    </div>
                    <div class="card-body">
                        @include('Cour/editing')
                    </div>
                @else
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Ajouter Cour</h6>
                    </div>
                    <div class="card-body">
                        @include('Cour/create')
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
            // $(".bootstrap-switch").bootstrapSwitch('state', true);
            $(".nav-link").eq(6).addClass("active");


            $('#hasfiles').change(function() {
                // this will contain a reference to the checkbox   
                if (this.checked) {
                    $('#hasfileForm input').removeAttr('disabled');
                    $('#hasfileForm').slideDown();
                } else {
                    // the checkbox is now no longer checked
                    $('#hasfileForm input').attr('disabled', 'disabled');
                    $('#hasfileForm').slideUp();
                }
            });

            $("#addFileBtn").click(function() {
                var count = $("#hasfileForm #CourseFile").length;
                // alert(count);
                var html1 = $("#hasfileForm .form-group").eq(0).clone();
                var newname = $(html1).children('input').attr('name') + (count + 1);
                $(html1).children('input').attr('name', newname);
                // $("#hasfileForm").append(html);
                if (count == 1) {
                    $(html1).insertAfter($("#hasfileForm .form-group").eq(1));
                } else {
                    $(html1).insertAfter($("#hasfileForm .btn").eq(count - 2));
                }
                var html2 = $("#hasfileForm .form-group").eq(1).clone();
                var newname = $(html2).children('div').children('input').attr('name') + (count + 1);
                $(html2).children('div').children('input').attr('name', newname);
                $(html2).insertAfter(html1)
                var btnremove =
                    "<button  type=\"button\" class=\"btnremove btn btn-danger w-50 m-auto\">Supprimer</button>";
                $(btnremove).insertAfter(html2);
                $(".btnremove").click(function(){
                    $(this).prev().remove();
                    $(this).prev().remove();
                    $(this).remove();
                });

            });
        });

    </script>
@endsection
