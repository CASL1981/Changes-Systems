@extends('home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Usuarios</div>
                <div class="panel-body">                    
                    <form class="form-horizontal" method="POST" action="{{ route('user.update', $user->id) }}">
                        {{ csrf_field() }}
                        {!! method_field('PUT') !!}
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="control-label">Nombre</label>
                                {{ Form::text('firstname', $user->firstname, ['class' => 'form-control', 'autofocus' => 'true']) }}
                            </div>

                            <div class=" col-md-6">
                                <label for="name" class="control-label">Apellido</label>
                                {{ Form::text('lastname', $user->lastname, ['class' => 'form-control', 'autofocus' => 'true']) }}
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="control-label">Correo</label>
                                {{ Form::text('email', $user->email, ['class' => 'form-control', 'type' => 'email']) }}
                            </div>
                            
                            <div class="col-md-6">
                                <label for="area" class="control-label">Area</label>
                                {{ Form::select('area', ['0' => 'Seleccionar Area', 'administracion' => 'Administración', 'comercial' => 'Comercial', 'farmacia' => 'Farmacia'], $user->area, ['class' => 'form-control']) }}
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">Rol</label>
                                {{ Form::select('role', ['normal' => 'Normal', 'admin' => 'Administrador', 'edit' => 'Editor'], $user->role, ['class' => 'form-control']) }}
                            </div>
                            
                            <div class="col-md-6">
                                <label for="CO" class="control-label">C. O.</label>
                                {{ Form::select('center', $center, $user->center_id, ['class' => 'form-control']) }}
                            </div>

                            <div class="col-md-6">
                                <label for="cargo" class="control-label">Cargo</label>
                                {{ Form::select('position', $position, $user->position_id, ['class' => 'form-control']) }}
                            </div>                            
                        </div>
                        <div class="row">
                            <label class="control-label">&nbsp;</label>
                            <div class="col-md-12">
                                {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
                            </div>                            
                        </div>                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
