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
        <div class="col-6  text-center">
            <h3 class="text-info text-bold">Gestion des Plannings</h3>
        </div>
    </div>
    <div class="row justify-content-center">
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
    </div>
    <div class="row justify-content-center" id="PlanningArea">

        <div class="col-8">
            <div class="card shadow p-3">
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
                <div class="modal fade" id="AddSeanceModal" role="dialog" aria-labelledby="AddSeanceModalTitle"
                    aria-hidden="true">
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
                                <td>Vendredi</td>
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

            //Setting up Date Pick

            $("#reservationdate").datetimepicker({
                defaultDate: Date("Y-M-D"),
                format: 'L',
                format: 'YYYY-MM-DD',
                calendarWeeks: true
            });

            $("#PlanningArea").hide();


            //Side Bar Active Item

            $(".nav-link").eq(8).addClass("active");

            // Form Classe and Select Ajax Opertations

            $('#FormClasseWeekSelect').on('submit', function(event) {
                event.preventDefault();
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
                            // alert(y);

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
                            var html = "<span class=\"badge bg-warning\">" + data[i].Type +
                                "</span>";
                            html += "<span class=\"badge bg-primary\">" + data[i].Matiere +
                                "</span>";
                            html += "<span class=\"badge bg-info\">" + data[i].TypeObjectName +
                                "</span>";
                            $("#tr_" + jours[jour.getDay()] + " td.Creneau_" + data[i].Creneau)
                                .html(html);
                        }
                    }
                });
            });

            $("#Matiere_ID").on("change", function(event) {
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



                    }
                });
            });

        });

    </script>
@endsection
