@extends('layouts.SmsDash')
@section('styles')
    <style>
        h2 {
            font-size: 2rem;
        }

    </style>
@endsection
@section('content')
    <div class="row  mb-3">
        <div class="col-3 "></div>
        <div class="col-6  text-center ">
            <h3 class="text-info text-bold">Gestion de Presence</h3>
        </div>
        <div class="col-3"></div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            <div class="card shadow p-3 rounded-50 border border-info">
                <form id="FormClasseDateSelect" method="post" action=".">
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
                        <label>Jour :</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" name="DateSeance" id="DateSeance" class="form-control datepicker-input"
                                data-target="#reservationdate">
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Creneau :</label>
                        <select id="CreneauSeance" name="CreneauSeance" class="form-control d-inline">
                            {{-- <option>Classe 1</option> --}}
                            <option value="Matin">Matin</option>
                            <option value="Soir">Apres-Midi</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-info float-right"><i class="fas fa-sync"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-8">
            <div class="card shadow p-3 rounded-50 border border-info">
                <div class="card-header"></div>
                <h2 class="display-5 my-2">Information Seance :</h2>
                <table class="table  table-info " id="SeanceInfosTable">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Date</th>
                            <th scope="col">Creneau</th>
                            <th scope="col">Matiere</th>
                            <th scope="col">Professeur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td><input type="hidden" id="SelectedSeanceID" name="SelectedSeanceID"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tbody>
                </table>
                <h2 class="display-5 my-2">Liste Des Etudiants :</h2>
                <table class="table" id="studentsTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Etudiant</th>
                            <th scope="col">Etat de Presence</th>
                            <th scope="col">Etat de Retard</th>
                            <th scope="col">Temps du Retard<small>(Minutes)</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="basic">
                            <th scope="row">1</th>
                            <td class="StudentName">Mark</td>
                            <td class="StudentPresence"><label for="Present">Present :</label>
                                <input type="radio" name="Presence" id="Present" value="Present">
                                <label for="Absent">Absent :</label>
                                <input type="radio" name="Presence" id="Absent" value="Absent">
                            </td>
                            <td><label for="Retard">Retard :</label>
                                <input type="checkbox" disabled name="Retard" id="Retard">
                            </td>
                            <td><input type="number" min=5 disabled name="TempsRetard" id="TempsRetard" placeholder="Durée">
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="card-footer">
                    <button class="btn btn-primary save" disabled>Enregistrer</button>
                    <button class="btn btn-warning allpresent" disabled>Presence totale</button>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.nav-treeview').parent().addClass('menu-open');
            $('.nav-treeview').find('li').find('a').eq(0).addClass('active');
            $("#reservationdate").datetimepicker({
                defaultDate: Date("Y-M-D"),
                format: 'L',
                format: 'YYYY-MM-DD',
                calendarWeeks: true
            });
            $('.allpresent').click(function() {
                $('input:radio[name^="Presence"]').each(function() {
                    if ($(this).val() == 'Present') {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });
                $('table input').removeAttr('disabled');
                // alert('all present');
            });
            $('.save').click(function() {
                event.preventDefault();
                var mydata = {
                    SeanceID: $('input#SelectedSeanceID').val(),
                    StudentsData: Array()
                }
                $('table#studentsTable tbody tr').each(function() {
                    if ($(this).attr('id') !== 'basic') {
                        var Student = {
                            id: parseInt($(this).find('td').eq(1).find('input').eq(0).attr(
                                'name').replace('Presence', '')),
                            EtatPresence: $(this).find('td').eq(1).find(
                                    'input[name^="Presence"]:checked').val() == "Present" ?
                                true : false,
                            EtatRetard: $(this).find('td').eq(2).find('input#Retard').is(
                                ':checked'),
                            TempsRetard: $(this).find('td').eq(3).find('input#TempsRetard')
                            .val()
                        }
                        mydata.StudentsData.push(Student);
                    }
                });
                // console.log(mydata);
                // Stocke l'etat de presence de la seance selectionner par etudiant ..
                var token = $('input[name="_token"]').attr('value');
                $.ajaxSetup({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Csrf-Token', token);
                    }
                });
                $.ajax({
                    type: 'GET',
                    url: "{{ route('SetSeancePresence') }}",
                    data: mydata,
                    success: function(data) {
                        msgStr = `<div class="alert alert-success alert-dismissible fade show" role="alert" w-75 mx-auto>
                                        Mise a jour Enregsitree.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>`;
                        $('.content-wrapper').prepend(msgStr);

                    },
                    error: function(jqXHR, exception) {
                        // msgStr=`<div class="alert alert-success alert-dismissible fade show" role="alert" w-75 mx-auto>
                        //             Status:`+jqXHR.status+`Expetion:`+expetion+`\nMise a jour NON  Enregsitree.
                        //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        //                 <span aria-hidden="true">&times;</span>
                        //             </button>
                        //         </div>`;

                        msgStr = `<div class="alert alert-danger alert-dismissible fade show" role="alert" w-75 mx-auto>
                                         <strong>Mise a jour Non Enregsitree.</strong><br>
                                        Une Edition de presence est deja sauvegradee pour cette seance. <br>
                                        Status : (?staus) <br>Expetion : (?exep)
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>`;
                        msgStr = msgStr.replace('(?staus)', jqXHR.status);
                        msgStr = msgStr.replace('(?exep)', jqXHR.responseJSON.message);
                        // console.log( exception);
                        // alert('error');
                        // $('.content-wrapper').prepend(msgStr);
                        $('.content-wrapper').prepend(msgStr);

                    }

                });

            });
            $('#FormClasseDateSelect').on('submit', function(event) {
                event.preventDefault();

                $("#basic").show();
                $("#basic").removeClass('StudentRow');
                $(".StudentRow").remove();
                $("#basic").addClass('StudentRow');

                var SelectedClasseID = $("#Classe_ID").val();
                var UserSelectedDate = $("#DateSeance").val();
                var UserSelectedCreneau = $("#CreneauSeance").val();
                //alert(ClasseID);
                var token = $('input[name="_token"]').attr('value');
                $.ajaxSetup({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Csrf-Token', token);
                    }
                });
                var mydata = {
                    Classe_ID: SelectedClasseID,
                    SelectedDate: UserSelectedDate,
                    SelectedCreneau: UserSelectedCreneau
                }
                $.ajax({
                    type: 'GET',
                    url: "{{ route('GetClasseStudents') }}",
                    data: mydata,
                    success: function(data) {
                        var Students = data;
                        if (data[0].SeanceID == -1) {

                            var html =
                                "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">aucune Seance Planifie dans ce creneau a cette date<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";
                            $('.card-header').html(html);

                            $('button.save,button.allpresent').attr("disabled", 'disabled');
                            $("table#SeanceInfosTable tbody td").eq(0).find('input').val(-1);
                            $("table#SeanceInfosTable").removeClass('table-info');
                            $("table#SeanceInfosTable").addClass('table-danger');
                            for (j = 1; j <= 4; j++) {
                                $("table#SeanceInfosTable tbody td").eq(j).html('');
                            }
                            // alert('aucune Seance Planifie dans ce creneau a cette date');
                        } else {
                            $('.card-header').html('');
                            $('button.save,button.allpresent').removeAttr("disabled");
                            // $('.card-header').html(data[0].SeanceMatiere.Name);
                            $("table#SeanceInfosTable tbody td").eq(0).find('input').val(data[0]
                                .SeanceID);
                            $("table#SeanceInfosTable tbody td").eq(1).html(mydata
                            .SelectedDate);
                            $("table#SeanceInfosTable tbody td").eq(2).html(mydata
                                .SelectedCreneau);
                            $("table#SeanceInfosTable tbody td").eq(3).html(data[0]
                                .SeanceMatiere);
                            $("table#SeanceInfosTable tbody td").eq(4).html(data[0]
                                .SeanceTeacher);
                            $("table#SeanceInfosTable").removeClass('table-danger');
                            $("table#SeanceInfosTable").addClass('table-info');
                            // alert('aucune Seance Planifie dans ce creneau a cette date');
                        }
                        for (i = 1; i < Students.length; i++) {
                            var $NewRow = $("#basic").clone();
                            $NewRow.attr('id', "StudentRow" + Students[i].id)
                                .appendTo('table#studentsTable tbody');

                            $("#StudentRow" + Students[i].id + ' td.StudentName').html(Students[
                                i].Name);
                            $NewRow.find('td.StudentPresence input[type="radio"]').attr("name",
                                "Presence" + Students[i].id);
                            $NewRow.find('th').html(i);
                            $('input[name="Presence' + Students[i].id + '"]').change(
                        function() {
                                if ($(this).val() == "Present") {
                                    $(this).parent().next().find('input[name="Retard"]')
                                        .removeAttr("disabled");
                                    $(this).parent().next().next().find(
                                            'input[name="TempsRetard"]')
                                        .removeAttr("disabled");
                                } else {
                                    $(this).parent().next().find('input[name="Retard"]')
                                        .attr("disabled", "true");
                                    $(this).parent().next().find('input[name="Retard"]')
                                        .prop('checked', false);
                                    // $(this).prop('checked', false);
                                    $(this).parent().next().next().find(
                                            'input[name="TempsRetard"]')
                                        .attr("disabled", "true");

                                }

                            });
                        }
                        $("#basic").hide();
                    }
                });


            });


        });

    </script>
@endsection
