@extends('layouts.SmsDash')
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
                <table class="table" id="studentsTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Etudiant</th>
                            <th scope="col">Etat de Presence</th>
                            <th scope="col">Etat de Retard</th>
                            <th scope="col">Temps du Retard</th>
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
                            <td><input type="text" name="TempsRetard" id="TempsRetard" placeholder="Durée"></td>
                        </tr>

                    </tbody>
                </table>
                <div class="card-footer">
                    <button class="btn btn-primary save">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#reservationdate").datetimepicker({
                defaultDate: Date("Y-M-D"),
                format: 'L',
                format: 'YYYY-MM-DD',
                calendarWeeks: true
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
                        if(data[0].SeanceID == -1){
                            $('button.save').attr("disabled",'disabled');
                            alert('aucune Seance Planifie dans ce creneau a cette date');
                        }else{
                            $('button.save').removeAttr("disabled");
                            $('.card-header').html(data[0].SeanceMatiere.Name);
                            // alert('aucune Seance Planifie dans ce creneau a cette date');
                        }
                        for (i = 1; i < Students.length; i++) {
                            var $NewRow = $("#basic").clone();
                            $NewRow.attr('id', "StudentRow" + Students[i].id)
                                .appendTo('table#studentsTable tbody');

                            $("#StudentRow" + Students[i].id + ' td.StudentName').html(Students[
                                i].Name);
                            $NewRow.find('td.StudentPresence input[type="radio"]').attr("name","Presence"+Students[i].id);
                            $('input[name="Presence'+Students[i].id+'"]').change(function() {
                                if ($(this).val() == "Present") {
                                    $(this).parent().next().find('input[name="Retard"]')
                                        .removeAttr("disabled");
                                        $(this).parent().next().next().find('input[name="TempsRetard"]')
                                        .removeAttr("disabled");
                                }else{
                                    $(this).parent().next().find('input[name="Retard"]')
                                        .attr("disabled","true");
                                        $(this).parent().next().next().find('input[name="TempsRetard"]')
                                        .attr("disabled","true");
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
