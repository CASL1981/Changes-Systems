@extends('home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div>
                            <center>
                                <h4>SOLICITUD DE PERMISOS Y OTROS CAMBIOS EN EL SOFTWARE</h3>                                    
                            </center>
                        </div>
                        <div class="col-md-4">
                            <center>Fecha Solicitud</center>
                            <div>{{ date("m/d/Y") }}</div>
                        </div>
                        <div class="col-md-4">
                            <center>Nombre Solicitante</center>
                            <div>{{ Auth()->user()->name }}</div>
                        </div>
                        <div class="col-md-4">
                            <center>Cargo</center>
                            <div>{{ substr(Auth()->user()->position['description'],0,20) }}</div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    {{ Form::open(['route' => 'changessystem.store', 'method' => 'POST']) }}
                        @include('ChangesSystem/formChangesSystem')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
    <style type="text/css">
        .cabecera {
            height: 50px;
        }

        .panel-heading {
            height: 5%;
            line-height: 20px;
            text-align: center;
            font-size: 16px;
        }

        .panel-heading center {
            font-size: 12px;     
            font-weight: bold;
            padding: 0;
        }

        .panel-heading center div {
            margin:0 auto 0 auto; width:390px;            
        }
    </style>
@endsection