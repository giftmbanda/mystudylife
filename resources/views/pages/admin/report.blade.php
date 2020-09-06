@extends('layouts.app')

@section('css')
<style>
    .card-weather .card-body:first-child {
        background-image: url(/images/dashboard-image.png);
        height: 500px;
    }
</style>
<style>
    .ct-chart {
        /* height: 300px; */
    }
    .dataTables_wrapper .dt-buttons a.dt-button {
        background-color: #607D8B;
        color: #fff;
        padding: 7px 12px;
        margin-right: 5px;
        text-decoration: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.16), 0 2px 10px rgba(0, 0, 0, 0.12);
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        -ms-border-radius: 2px;
        border-radius: 2px;
        border: none;
        font-size: 13px;
        outline: none;
    }


    .dataTables_wrapper .dt-buttons a.dt-button {
        background-color: #4f9ee1;
    }
</style>
@endsection
@section('content')
    
    <div class="content-wrapper">
        <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <i class="mdi mdi-cube text-danger icon-lg"></i>
                </div>
                <div class="float-right">
                    <p class="mb-0 text-right">Translations</p>
                    <div class="fluid-container">
                    <h3 class="font-weight-medium text-right mb-0">{{ $allTranslations }}</h3>
                    </div>
                </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total translations
                </p>
            </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-poll-box text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Translations</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $weeklyTranslations }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Weekly Translations
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <i class="mdi mdi-account-location text-warning icon-lg"></i>
                </div>
                <div class="float-right">
                    <p class="mb-0 text-right">Users</p>
                    <div class="fluid-container">
                    <h3 class="font-weight-medium text-right mb-0">{{  $weeklyUsers }}</h3>
                    </div>
                </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Registered users this week
                </p>
            </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-account-location text-info icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Users</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $allUsers }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> All users in system
                    </p>
                </div>
            </div>
        </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Translations</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered data-table dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Original Text
                                        </th>
                                        <th>
                                            Translated Text
                                        </th>
                                        <th>
                                            Translatable
                                        </th>
                                        <th>
                                            Suggested Text
                                        </th>
                                        <th>
                                            From Language
                                        </th>
                                        <th>
                                            To Language
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($translations as $index => $translation)
                                    <tr>
                                        <td class="font-weight-medium">
                                            {{ $index + 1 }}
                                        </td>
                                        <td>
                                            {{ $translation->original_text }}
                                        </td>
                                        <td>
                                            {{ $translation->translated_text }}
                                        </td>
                                        <td>
                                        {{ $translation->translatable ? 'Yes' : 'No' }}
                                        </td>
                                        <td>
                                            {{ $translation->suggested_text ? $translation->suggested_text : 'None' }}
                                        </td>
                                        <td>
                                            {{ $translation->getFromLanguage() }}
                                        </td>
                                        <td>
                                            {{ $translation->getToLanguage() }}
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
        
        <div class="row">
            <div class="col-lg-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Words By Popularity</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered data-table dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Word</th>
                                        <th>Translations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mostTranslatedWords as $word => $collection)
                                    <tr>
                                        <td>{{ $word }}</td>
                                        <td>{{ $collection->count() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Users</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered data-table dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Email</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>ID Number</th>
                                        <th>Gender</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $index => $user)
                                    <tr>
                                        <td class="font-weight-medium">{{ $index + 1 }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->id_number }}</td>
                                        <td>{{ $user->gender }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Male Users</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered data-table dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Email</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>ID Number</th>
                                        <th>Gender</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($maleUsers as $index => $user)
                                    <tr>
                                        <td class="font-weight-medium">{{ $index + 1 }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->id_number }}</td>
                                        <td>{{ $user->gender }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Female Users</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered data-table dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Email</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>ID Number</th>
                                        <th>Gender</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($femaleUsers as $index => $user)
                                    <tr>
                                        <td class="font-weight-medium">{{ $index + 1 }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->id_number }}</td>
                                        <td>{{ $user->gender }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    
    <script>
    $(function () {

        //Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            paging: false,
            searching: false,
            buttons: [
                'csv', 'excel', 'pdf'
            ]
        });
    });
    </script>
@endsection