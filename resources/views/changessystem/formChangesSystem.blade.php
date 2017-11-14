@if (isset($change))
    {{ Form::model($change, ['route' => ['changessystem.update', $change], 'method' => 'PUT']) }}
@endif
        {{ Form::text('user_id', null, ['class' => 'hidden']) }}
<fieldset>
    <div class="col-md-12">
        <label for="solicitud_id" class="control-label">Tipo de Solicitud</label>
        {{ Form::select('solicitud_id', $solicitud, null, ['class' => 'form-control']) }}
    </div>                                
</fieldset>
<fieldset>
    <div class="col-md-3">
        <label for="document_id" class="control-label">Tipo de Documento</label>
        {{ Form::select('document_id', $document, null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-3">
        <label for="center_id" class="control-label">CO</label>
        {{ Form::select('center_id', $center, null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-3">
        <label for="number" class="control-label">Numero</label>
        {{ Form::text('number', null, ['class' => 'form-control input-sm']) }}
    </div>
    <div class="col-md-3">
        <label for="rs" class="control-label">RS</label>
        {{ Form::text('rs', null, ['class' => 'form-control input-sm']) }}
    </div>                                
</fieldset>
<fieldset>
    <div class="col-md-12">
        <label for="client" class="control-label">Cliente</label>
        {{ Form::text('client', null, ['class' => 'form-control input-sm']) }}
    </div>                  
</fieldset>
<fieldset>
    <div class="col-md-4">
        <label for="permission" class="control-label">Tipo de Permiso</label>
        {{ Form::select('permission', ['null' => 'Seleciona un Tipo de permiso', 'Asignar Permiso' => 'Asignar Permiso', 'Eliminar Permiso' => 'Eliminar Permiso', 'Asignar y Eliminar Permiso' => 'Asignar y Eliminar Permiso'], null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-8">
        <label for="module" class="control-label">Modulo</label>
        {{ Form::text('module', null, ['class' => 'form-control input-sm']) }}
    </div>
    <div class="col-md-12">
        <label for="detailpermission" class="control-label">Detalle Permiso</label>
        {{ Form::text('detailpermission', null, ['class' => 'form-control input-sm']) }}
    </div>
</fieldset>
<fieldset>
    <div class="col-md-2">
        <label for="other" class="control-label">Otra Solicitud</label>
        {{ Form::select('other', ['0' => 'No', '1' => 'SI'], null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-10">
        <label for="which" class="control-label">Cual?</label>
        {{ Form::text('which', null, ['class' => 'form-control input-sm']) }}
    </div>
</fieldset>
<fieldset>
    <label for="justification">Descripción:</label>                        
    {{ Form::textarea('justification', null, ['size' => '107x5', 'class' => 'form-control']) }}
</fieldset>
{{-- <div class="row">
    <div class="col-md-6">
        <label for="solicitante" class="control-label">Firma del Solicitante</label>
        {{ Form::text('solicitante', Auth()->user()->name, ['class' => 'form-control input-sm', 'disabled']) }}
    </div>
    <div class="col-md-6">
        <label for="director" class="control-label">VoBo del Director de Area</label>
        {{ Form::text('director', null, ['class' => 'form-control input-sm', 'disabled']) }}
    </div>                            
</div>
<fieldset>
    <legend> Espacio Reservado para MASTER o RESPONSABLE del cambio</legend>
    <label for="observation">Observaciones:</label>                        
    {{ Form::textarea('observation', null, ['size' => '107x5', 'class' => 'form-control']) }}
</fieldset> --}}
<div class="row">
    <label class="control-label">&nbsp;</label>
    <div class="col-md-12">
        {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
    </div>                            
</div>

{{ Form::close() }}