@if (isset($observation))
    {{ Form::model($observation, ['route' => ['showobservation', $observation], 'method' => 'POST']) }}
@else
    {{ Form::open(['route' => ['saveobservation', $id], 'method' => 'POST']) }}
@endif

<fieldset>
    <label for="justification">Observación:</label>                        
    {{ Form::textarea('observation', null, ['size' => '107x5', 'class' => 'form-control']) }}
</fieldset>

<div class="row">
    <label class="control-label">&nbsp;</label>
    <div class="col-md-12">
        {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
    </div>                            
</div>

{{ Form::close() }}