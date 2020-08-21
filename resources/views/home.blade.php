@extends('layouts.SmsDash')
<style>
.small-box .inner p {
    font-size:2rem;
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
@endsection
@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {

            $(".nav-link").eq(0).addClass("active");
        });

    </script>
@endsection
