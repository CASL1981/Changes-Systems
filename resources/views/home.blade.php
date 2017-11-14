
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cambios en el Sistema</title>
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet">
    {{-- <link href="css/datepicker3.css" rel="stylesheet"> --}}
    <link href="{{ url('css/styles.css') }}" rel="stylesheet">
    
    @yield('style')
    
    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
</head>
<body id="app">
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">                
                <a class="navbar-brand" href="#"><span>Cambios</span> en el Sistema</a>
                <ul class="nav navbar-top-links navbar-right">
                    
                {{-- editar perfil     --}}
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">{{ Auth()->user()->firstname }}</div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>
        
        <ul class="nav menu">
            <li class="active"><a href="{{ route('linkchangessystem') }}"><em class="fa fa-dashboard">&nbsp;</em> Solicitud de Cambio</a></li>
            <li class="parent"><a data-toggle="collapse" href="#hist-item-1">
                <em class="fa fa-search-plus" aria-hidden="true">&nbsp;</em> Historial <span data-toggle="collapse" href="#hist-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="hist-item-1">
                    <li><a class="" href="{{ route('changessystem.index') }}">
                        <span class="fa fa-tasks" aria-hidden="true">&nbsp;</span> Resumen de Cambios
                    </a></li>
                    <li><a class="" href="{{ route('listdetailedchanges') }}">
                        <span class="fa fa-list">&nbsp;</span> Listado Detallado
                    </a></li>
                    <li><a data-toggle="parent collapse" href="#hist-item-2">
                        <em class="fa fa-users">&nbsp;</em> Usuarios <span data-toggle="collapse" href="#hist-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
                        </a>
                        <ul class="children collapse" id="hist-item-2">
                            <li>
                                <a class="" href="{{ route('linkuser') }}">
                                    &nbsp;&nbsp;<span class="fa fa-user-plus"></span> Crear Usuario
                                </a></li>
                            <li>
                                <a class="" href="{{ route('user.index') }}">
                                    &nbsp;&nbsp;<span class="fa fa-list"></span> Listado de Usuarios
                                </a></li>
                        </ul>
                    </li>
                    <li><a class="" href="{{ route('linkdocument') }}">
                        <span class="fa fa-file-text">&nbsp;</span> Tipos de Documentos
                    </a></li>
                    <li><a class="" href="{{ route('linksolicitud') }}">
                        <span class="fa fa-asterisk">&nbsp;</span> Tipos de Solicitud
                    </a></li>
                </ul>
            </li>
            <li class="parent"><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-navicon">&nbsp;</em> Parametros <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li><a class="" href="{{ route('linkcenter') }}">
                        <span class="fa fa-circle">&nbsp;</span> CO
                    </a></li>
                    <li><a class="" href="{{ route('linkposition') }}">
                        <span class="fa fa-arrow-right">&nbsp;</span> Cargos
                    </a></li>
                    <li><a data-toggle="parent collapse" href="#sub-item-2">
                        <em class="fa fa-users">&nbsp;</em> Usuarios <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
                        </a>
                        <ul class="children collapse" id="sub-item-2">
                            <li>
                                <a class="" href="{{ route('linkuser') }}">
                                    &nbsp;&nbsp;<span class="fa fa-user-plus"></span> Crear Usuario
                                </a></li>
                            <li>
                                <a class="" href="{{ route('user.index') }}">
                                    &nbsp;&nbsp;<span class="fa fa-list"></span> Listado de Usuarios
                                </a></li>
                        </ul>
                    </li>
                    <li><a class="" href="{{ route('linkdocument') }}">
                        <span class="fa fa-file-text">&nbsp;</span> Tipos de Documentos
                    </a></li>
                    <li><a class="" href="{{ route('linksolicitud') }}">
                        <span class="fa fa-asterisk">&nbsp;</span> Tipos de Solicitud
                    </a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();"><em class="fa fa-power-off">&nbsp;</em>
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div><!--/.sidebar-->
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Dashboard1</li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-md-9">
                @yield('content')
            </div>
            <div class="col-md-3">
                {!! Alert::render() !!}
                @include('partials.errors')                
            </div>
        </div><!--/.row-->      
        
        
    </div>  <!--/.main-->
    
    <script src="{{ url('js/app.js') }}"></script>    

    @yield('script')
    
        
</body>
</html>