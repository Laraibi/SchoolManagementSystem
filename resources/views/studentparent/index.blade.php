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

</style>
@section('content')
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow ">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Liste Des Parents</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Parent</th>
                                            <th scope="col">Total Enfants</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($StudentParents as $StudentParent)


                                            <tr>
                                                <th scope="row">{{ $StudentParent->id }}</th>
                                                <td>{{ substr($StudentParent->FirstName, 0, 1) }} .
                                                    {{ $StudentParent->SecondName }}
                                                </td>
                                                <td>{{ count($StudentParent->kids->all()) }}</td>
                                                <td>
                                                    <form class="d-inline"
                                                        action="{{ Route('StudentParents.edit', $StudentParent->id) }}"
                                                        method="GET">
                                                        <button type="submit" class="btn btn-info"> <i
                                                                class="fas fa-edit"></i></button>
                                                        @method('GET')
                                                        @csrf
                                                    </form>
                                                    <form class="d-inline"
                                                        action="{{ url('/StudentParents', ['id' => $StudentParent->id]) }}"
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
                    @if (isset($SelectedParent))
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Modifier Parent</h6>
                    </div>
                    <div class="card-body">
                        @include('studentparent/edit')
                    </div>
                    @else
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Nouveau Parent</h6>
                        </div>
                        <div class="card-body">
                            @include('studentparent/create')
                        </div>
                    @endif
                </div>
            </div>
        </div>

@endsection
@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {


            $(".nav-link").eq(2).addClass("active");
        });

    </script>
@endsection
