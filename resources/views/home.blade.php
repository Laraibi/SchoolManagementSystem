@extends('layouts.SmsDash')
<style>
    .small-box .inner p {
        font-size: 2rem;
    }

</style>
@section('content')
    <div class="row mb-4">
        <div class="col-12 justify-content-center">
            <h2 class="text-center">Systeme de Gestion D'Ecole</h2>
        </div>

    </div>
    <div class="row mb-2">
        {{-- <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ __('You are logged in!') }}
            </div>
        </div> --}}

        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Professeurs</h3>
                    <p>{{ $counts['Teachers'] }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <a href="{{ route('Teachers.index') }}" class="small-box-footer">
                    Details
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Parents</h3>
                    <p>{{ $counts['Parents'] }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <a href="{{ route('StudentParents.index') }}" class="small-box-footer">
                    Details
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Etudiants</h3>
                    <p>{{ $counts['Students'] }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <a href="{{ route('Students.index') }}" class="small-box-footer">
                    Details
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>Classes</h3>
                    <p>{{ $counts['Classes'] }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-school"></i>
                </div>
                <a href="{{ route('Classes.index') }}" class="small-box-footer">
                    Details
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <input type="hidden" name="Girls" value="{{ $counts['Girls'] }}">
            <input type="hidden" name="Boys" value="{{ $counts['Boys'] }}">
            <canvas id="myChart"></canvas>
        </div>
        <div class="col-6" id="barCharArea">
            @foreach ($Matieres as $Matiere)
                <input type="hidden" name="{{ $Matiere->Name }}" value="{{ $Matiere->teachers->count() }}">
            @endforeach
            <canvas id="barCharAreaCanvas"></canvas>
        </div>

    </div>
@endsection
@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {

            $(".nav-link").eq(0).addClass("active");

            function setPieChart() {
                var ctx = $("#myChart").get(0).getContext("2d");
                var data = {

                    labels: [
                        "Filles",
                        "Garcons"
                    ],
                    datasets: [{
                        data: [$('input[name="Girls"]').val(), $('input[name="Boys"]').val()],
                        backgroundColor: [
                            "#FF6384",
                            "#4BC0C0"
                        ],
                        label: 'Nombre',
                    }]
                };
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: data,
                    options: {
                        title: {
                            display: true,
                            text: "% Sexe"
                        }
                    }
                });
            }

            function setBarChart() {
                var ctx = $("#barCharAreaCanvas").get(0).getContext("2d");
                var data = {

                    labels: [
                        $('#barCharArea input[type="hidden"]').eq(0).attr('name'),
                        $('#barCharArea input[type="hidden"]').eq(1).attr('name'),
                        $('#barCharArea input[type="hidden"]').eq(2).attr('name'),
                        $('#barCharArea input[type="hidden"]').eq(3).attr('name'),
                        $('#barCharArea input[type="hidden"]').eq(4).attr('name'),
                    ],
                    datasets: [{
                        data: [$('#barCharArea input[type="hidden"]').eq(0).val(),
                            $('#barCharArea input[type="hidden"]').eq(1).val(),
                            $('#barCharArea input[type="hidden"]').eq(2).val(),
                            $('#barCharArea input[type="hidden"]').eq(3).val(),
                            $('#barCharArea input[type="hidden"]').eq(4).val(),
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                        ],
                        label: 'Nombre de Profs',
                    }]
                };
                var myPieChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: {
                        title: {
                            display: true,
                            text: "Nombre de Profs Par Matiere"
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true // minimum value will be 0.
                                }
                            }]
                        }
                    }
                });
            }

            setPieChart();
            setBarChart();


        });

    </script>
@endsection
