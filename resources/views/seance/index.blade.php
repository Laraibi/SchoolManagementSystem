@extends('layouts.SmsDash')
<style>
    .col-3 {
        border: 1px dashed black;
        margin: 5px 20px;
        font-size: 8px;
        font-family: 'Courier New', Courier, monospace;
        padding: 0px 0px;
        padding-right: 0px;
    }

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

</style>
@section('content')
    <div class="row  mb-3 justify-content-center">
        <div class="col-6  text-center ">
            <h3 class="text-info text-bold">Gestion des Plannings</h3>
        </div>
    </div>
    <div class="row ">
        <div class="col-4">
            <div class="card shadow p-3 rounded-50 border border-info">
                <form id="FormClasseWeekSelect" method="post" action=".">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Classe :</label>
                        <select id="Classe_ID" name="Classe_ID" class="form-control d-inline">
                            {{-- <option>Classe 1</option> --}}
                            @isset($Classes)
                                @foreach ($Classes as $Classe)
                                    <option value="{{ $Classe->id }}">{{ $Classe->name }}</option>
                                @endforeach
                            @endisset()
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Semaine :</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" name="DateBeginWeek" class="form-control datepicker-input"
                                data-target="#reservationdate">
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-info float-right"><i class="fas fa-sync"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-8" id="PlanningArea">
            <div class="card border-info border shadow p-3">
                <div class="row">
                    <div class="col-4">
                        <b>Classe : </b><span id="SelectedClasse"></span>
                    </div>
                    <div class="col-4">
                        <b>Semaine : </b><span id="SelectedWeek"></span>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-info" data-toggle="modal" data-target="#AddSeanceModal">Ajouter
                            Seance</button>
                    </div>
                </div>
                <div class="modal modal-info fade in" id="AddSeanceModal" role="dialog"
                    aria-labelledby="AddSeanceModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="AddSeanceModalTitle">Ajouter Seance</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @csrf
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="">Type de Seance :</label>
                                    <div class="custom-control custom-radio d-inline">
                                        <input class="custom-control-input" value="Cour" type="radio" id="SeanceType1"
                                            name="SeanceType">
                                        <label for="SeanceType1" class="custom-control-label">Cour</label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline">
                                        <input class="custom-control-input" value="Exam" type="radio" id="SeanceType2"
                                            name="SeanceType" checked="">
                                        <label for="SeanceType2" class="custom-control-label">Examen</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Matiere_ID">Matiere :</label>
                                    <select name="Matiere_ID" id="Matiere_ID" class="form-control">
                                        @isset($Matieres)
                                            @foreach ($Matieres as $Matiere)
                                                <option value="{{ $Matiere->id }}">{{ $Matiere->Name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Prof_ID">Professeur :</label>
                                    <select name="Prof_ID" id="Prof_ID" class="form-control" disabled>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Type_ID">Cour/Examen :</label>
                                    <select name="Type_ID" id="Type_ID" class="form-control" disabled>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Jour">Jour :</label>
                                    <select name="Jour" id="Jour" class="form-control" disabled>
                                        <option value="">Lundi</option>
                                        <option value="">Mardi</option>
                                        <option value="">Mercredi</option>
                                        <option value="">Jeudi</option>
                                        <option value="">Vendredi</option>
                                        <option value="">Samedi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Creneau">Creneau :</label>
                                    <select name="Creneau" id="Creneau" class="form-control" disabled>
                                        <option value="Matin">Matin</option>
                                        <option value="Soir">Apres-Midi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="btnAddSeance" class="btn btn-primary">Ajouter Seance</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal modal-info fade in" id="EditSeanceModal" role="dialog"
                    aria-labelledby="editSeanceModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="EditSeanceModalTitle">Modifier Seance</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="SeanceIDtoEdit" id="SeanceIDtoEdit" />
                                <div class="form-group">
                                    <label for="">Type de Seance :</label>
                                    <div class="custom-control custom-radio d-inline">
                                        <input class="custom-control-input" value="Cour" type="radio" id="editSeanceType1"
                                            name="editSeanceType">
                                        <label for="editSeanceType1" class="custom-control-label">Cour</label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline">
                                        <input class="custom-control-input" value="Exam" type="radio" id="editSeanceType2"
                                            name="editSeanceType" checked="">
                                        <label for="editSeanceType2" class="custom-control-label">Examen</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Matiere_ID">Matiere :</label>
                                    <select name="Matiere_ID" id="Matiere_ID" class="form-control">
                                        @isset($Matieres)
                                            @foreach ($Matieres as $Matiere)
                                                <option value="{{ $Matiere->id }}">{{ $Matiere->Name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Prof_ID">Professeur :</label>
                                    <select name="Prof_ID" id="EditProf_ID" class="form-control" disabled>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Type_ID">Cour/Examen :</label>
                                    <select name="Type_ID" id="EditType_ID" class="form-control" disabled>

                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="btnEditSeance" class="btn btn-warning">Modifier Seance</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <table class="table table-striped  table-bordered">
                        <thead>
                            <tr>
                                <th>Jour</th>
                                <th>Seance Matinale</th>
                                <th>Seance Apres-Midi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr" id="tr_Lundi">
                                <td>Lundi</td>
                                <td class="Creneau_Matin"></td>
                                <td class="Creneau_Soir"></td>
                            </tr>
                            <tr class="tr" id="tr_Mardi">
                                <td>Mardi</td>
                                <td class="Creneau_Matin"></td>
                                <td class="Creneau_Soir"></td>
                            </tr>
                            <tr class="tr" id="tr_Mercredi">
                                <td>Mercredi</td>
                                <td class="Creneau_Matin"></td>
                                <td class="Creneau_Soir"></td>
                            </tr>
                            <tr class="tr" id="tr_Jeudi">
                                <td>Jeudi</td>
                                <td class="Creneau_Matin"></td>
                                <td class="Creneau_Soir"></td>
                            </tr>
                            <tr class="tr" id="tr_Vendredi">
                                <td>Vendredi</td>
                                <td class="Creneau_Matin"></td>
                                <td class="Creneau_Soir"></td>
                            </tr>
                            <tr class="tr" id="tr_Samedi">
                                <td>Samedi</td>
                                <td class="Creneau_Matin"></td>
                                <td class="Creneau_Soir"></td>
                            </tr>
                            <tr class="tr" id="tr_Dimanche">
                                <td>Dimanche</td>
                                <td class="Creneau_Matin"></td>
                                <td class="Creneau_Soir"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div id="myarea">

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            function refreshPlanningTable() {
                $.ajax({
                    url: "{{ route('getPlanningClasse') }}",
                    method: "GET",
                    dataType: 'json',
                    data: $("#FormClasseWeekSelect").serialize(),
                    success: function(data) {
                        // Recupeter les Seances de la Semaine Selctionner et les Afficher sur la table..
                        $("td.Creneau_Matin,td.Creneau_Soir").html("");
                        $("#PlanningArea").slideDown('slow');
                        $("#SelectedClasse").html(data[0].Classe_Name);
                        $("#SelectedWeek").html(data[0].WeekNumber);
                        var DateBeginWeek = new Date(data[0].DateBeginWeek);
                        for (y = 0; y <= 6; y++) {
                            var datevalue = DateBeginWeek.getFullYear() + "/" + (DateBeginWeek
                                .getMonth() + 1) + "/" + (DateBeginWeek.getDate());
                            $("select#Jour option").eq(y).attr("value", datevalue);
                            DateBeginWeek.setDate(DateBeginWeek.getDate() + 1);
                        }
                        var jours = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi",
                            "Vendredi", "Samedi"
                        ];
                        for (i = 1; i < data.length; i++) {
                            var jour = new Date(data[i].DateSeance);
                            var bgBadge = (data[i].Type == 'Cour') ? "warning" : "Danger";
                            var html =
                                "<div class=\"row\"><div class=\"col-6\"><span class=\"badge bg-" +
                                bgBadge + " p-1 m-1 text-left w-100\">" +
                                data[i].Type +
                                "</span></br>";
                            html += "<span class=\"badge bg-primary p-1 m-1 text-center w-100\">" +
                                data[i].Matiere +
                                "</span></br>";
                            html += "<span class=\"badge bg-info p-1 m-1 text-right w-100\">" + data[i]
                                .TypeObjectName +
                                "</span></div>";
                            html +=
                                "<div class=\"col-6\"><a href=\"" + data[i].id +
                                "\" class=\"link-black d-block text-sm deleteSeanceLink\"><i class=\"far fa-trash-alt m-2\"></i>Effacer</a><a href=\"" +
                                data[i].id +
                                "\" class=\"link-black d-block text-sm editSeanceLink\"><i class=\"fas fa-edit m-2 \"></i></i>Modifier</a></div></div>";
                            $("#tr_" + jours[jour.getDay()] + " td.Creneau_" + data[i].Creneau)
                                .html(html);
                            $("a.deleteSeanceLink").on("click", function(e) {
                                e.preventDefault();
                                var result = confirm("Supprimer Seance ?");
                                if (result) {
                                    var mydata = {
                                        SeanceID: $(this).attr("href")
                                    }
                                    var token = $('input[name="_token"]').attr('value');
                                    $.ajaxSetup({
                                        beforeSend: function(xhr) {
                                            xhr.setRequestHeader(
                                                'Csrf-Token', token);
                                        }
                                    });
                                    $.ajax({
                                        type: 'GET',
                                        url: "{{ route('deleteSeance') }}",
                                        data: mydata,
                                        success: function(data) {
                                            if (data.Type == "Success") {
                                                var html =
                                                    "<div id=\"myalert\" class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button><h5><i class=\"icon fas fa-check\"></i>" +
                                                    data.Msg + "</h5></div>";
                                                $(".content-wrapper").append(html);
                                                $("#myalert").css({
                                                    "float": "right",
                                                    "position": "fixed",
                                                    "top": "20px",
                                                    "left": "90%",
                                                    "width": "10%",
                                                    "margin-top": "10px",
                                                    "margin-left": "10px"
                                                });
                                                refreshPlanningTable();
                                            }
                                        }
                                    });

                                }
                            });

                            $("a.editSeanceLink").on("click", function(e) {

                                e.preventDefault();
                                // alert($(this).attr("href"));
                                var SeanceID = $(this).attr("href");
                                $('#EditSeanceModal').modal('show');
                                // $('.modal').removeClass('fade');
                                //recupere les donnes de la seance a modifier 

                                var mydata = {
                                    SeanceID: $(this).attr("href")
                                }
                                var token = $('input[name="_token"]').attr('value');
                                $.ajaxSetup({
                                    beforeSend: function(xhr) {
                                        xhr.setRequestHeader(
                                            'Csrf-Token', token);
                                    }
                                });
                                $.ajax({
                                    type: 'GET',
                                    url: "{{ route('getSeance') }}",
                                    data: mydata,
                                    success: function(data) {
                                        if (data.Type == "Success") {

                                            //alert(data.SeanceData.id);

                                            $('.modal#EditSeanceModal #Matiere_ID')
                                                .val(data.SeanceData.Matiere);

                                            $("input[name='editSeanceType'][value='" +
                                                    data.SeanceData.Type + "']")
                                                .prop('checked', true);

                                            $("#EditType_ID").removeAttr(
                                                "disabled");
                                            $("#EditProf_ID").removeAttr(
                                                "disabled");
                                            $("#EditProf_ID option").remove();
                                            $("#EditType_ID option").remove();


                                            var Teachers = data.Teachers;
                                            for (i = 0; i < Teachers.length; i++) {
                                                var html = "<option value=\"" +
                                                    Teachers[i].TeacherId + "\">" +
                                                    Teachers[i].TeacherName +
                                                    "</option>";
                                                $("#EditProf_ID").append(html);

                                                // alert(html);
                                            }

                                            var CoursesOrExam = data.CoursesOrExam;
                                            for (i = 0; i < CoursesOrExam
                                                .length; i++) {
                                                var html = "<option value=\"" +
                                                    CoursesOrExam[i].CourseId +
                                                    "\">" +
                                                    CoursesOrExam[i].CourseName +
                                                    "</option>";
                                                $("#EditType_ID").append(html);
                                            }
                                            $('.modal#EditSeanceModal #EditType_ID')
                                                .val(data.SeanceData.TypeObjectid);
                                            $('.modal#EditSeanceModal #EditProf_ID')
                                                .val(data.SeanceData.Teacher);
                                            $('#SeanceIDtoEdit').val(data.SeanceData
                                                .id);
                                        }
                                    }
                                });
                            });
                        }
                    }
                });
            }

            //Setting up Date Pick

            $("#reservationdate").datetimepicker({
                defaultDate: Date("Y-M-D"),
                format: 'L',
                format: 'YYYY-MM-DD',
                calendarWeeks: true
            });

            $("#PlanningArea").hide();


            //Side Bar Active Item

            // $(".nav-link").eq(8).addClass("active");

            // Form Classe and Select Ajax Opertations

            $('#FormClasseWeekSelect').on('submit', function(event) {
                event.preventDefault();
                refreshPlanningTable();
            });

            $("#Matiere_ID, input[name='SeanceType']").on("change", function(event) {
                var radioValue = $("input[name='SeanceType']:checked").val();
                var MatiereID = $('#Matiere_ID').val();
                var mydata = {
                    Type: radioValue,
                    MatiereID: MatiereID
                }
                var token = $('input[name="_token"]').attr('value');
                $.ajaxSetup({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Csrf-Token', token);
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: "{{ route('getMatiereCoursesOrExams') }}",
                    data: mydata,
                    success: function(data) {
                        $("#Type_ID").removeAttr("disabled");
                        $("#Jour").removeAttr("disabled");
                        $("#Creneau").removeAttr("disabled");
                        $("#Prof_ID").removeAttr("disabled");
                        $("#Prof_ID option").remove();
                        $("#Type_ID option").remove();
                        var Teachers = data.Teachers;
                        for (i = 0; i < Teachers.length; i++) {
                            var html = "<option value=\"" + Teachers[i].TeacherId + "\">" +
                                Teachers[i].TeacherName + "</option>";
                            $("#Prof_ID").append(html);

                            // alert(html);
                        }

                        var CoursesOrExam = data.CoursesOrExam;
                        for (i = 0; i < CoursesOrExam.length; i++) {
                            var html = "<option value=\"" + CoursesOrExam[i].CourseId + "\">" +
                                CoursesOrExam[i].CourseName + "</option>";
                            $("#Type_ID").append(html);
                        }
                        // $("#Type_ID").append(data);
                    }
                });
            });

            $("#EditSeanceModal #Matiere_ID, input[name='editSeanceType']").on("change", function(event) {
                var radioValue = $("input[name='editSeanceType']:checked").val();
                var MatiereID = $('#Matiere_ID').val();
                var mydata = {
                    Type: radioValue,
                    MatiereID: MatiereID
                }
                var token = $('input[name="_token"]').attr('value');
                $.ajaxSetup({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Csrf-Token', token);
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: "{{ route('getMatiereCoursesOrExams') }}",
                    data: mydata,
                    success: function(data) {
                        $("#EditType_ID").removeAttr("disabled");
                        $("#EditProf_ID").removeAttr("disabled");
                        $("#EditProf_ID option").remove();
                        $("#EditType_ID option").remove();


                        var Teachers = data.Teachers;
                        for (i = 0; i < Teachers.length; i++) {
                            var html = "<option value=\"" + Teachers[i].TeacherId + "\">" +
                                Teachers[i].TeacherName + "</option>";
                            $("#EditProf_ID").append(html);

                            // alert(html);
                        }

                        var CoursesOrExam = data.CoursesOrExam;
                        for (i = 0; i < CoursesOrExam.length; i++) {
                            var html = "<option value=\"" + CoursesOrExam[i].CourseId + "\">" +
                                CoursesOrExam[i].CourseName + "</option>";
                            $("#EditType_ID").append(html);
                        }
                        // $("#Type_ID").append(data);
                    }
                });
            });


            $("#btnAddSeance").on("click", function() {
                //"Matiere_id","Classe_id","Teacher_id","Salle_id","Type_id","Type","DateSeance","Creneau"
                var SeanceData = {
                    Classe_id: $('#Classe_ID').val(),
                    Matiere_id: $('#Matiere_ID').val(),
                    Teacher_id: $('#Prof_ID').val(),
                    Salle_id: 1,
                    Type_id: $('#Type_ID').val(),
                    Type: $("input[name='SeanceType']:checked").val(),
                    DateSeance: $("select#Jour").val(),
                    Creneau: $('#Creneau').val()
                }


                var token = $('input[name="_token"]').attr('value');
                $.ajaxSetup({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Csrf-Token', token);
                    }
                });
                $.ajax({
                    type: 'GET',
                    url: "{{ route('addSeance') }}",
                    data: SeanceData,
                    success: function(data) {

                        if (data.Type == "Success") {
                            var html =
                                "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Seance Ajoutee<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";
                            $('#AddSeanceModal .modal-body').prepend(html);
                            // alert(html);
                        } else {
                            var html =
                                "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Seance Non Ajoutee<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";
                            $('#AddSeanceModal .modal-body').prepend(html);
                            // alert(html);

                        }
                    }
                });
                refreshPlanningTable();
            });
            $("#btnEditSeance").on("click", function() {
                var SeanceData = {
                    SeanceID: $('#SeanceIDtoEdit').val(),
                    Matiere_id: $('.modal#EditSeanceModal #Matiere_ID').val(),
                    Teacher_id: $('.modal#EditSeanceModal #EditProf_ID').val(),
                    Salle_id: 1,
                    Type_id: $('.modal#EditSeanceModal #EditType_ID').val(),
                    Type: $("input[name='editSeanceType']:checked").val()
                }
                var token = $('input[name="_token"]').attr('value');
                $.ajaxSetup({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Csrf-Token', token);
                    }
                });
                $.ajax({
                    type: 'GET',
                    url: "{{ route('editSeance') }}",
                    data: SeanceData,
                    success: function(data) {

                        if (data.Type == "Success") {
                            var html =
                                "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Seance Modifiee<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";
                            $('#EditSeanceModal .modal-body').prepend(html);
                            // alert(html);
                        } else {
                            var html =
                                "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">Seance Non Modifiee<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";
                            $('#EditSeanceModal .modal-body').prepend(html);
                            // alert(html);

                        }
                    }
                });
                refreshPlanningTable();
            });
        });

    </script>
@endsection
