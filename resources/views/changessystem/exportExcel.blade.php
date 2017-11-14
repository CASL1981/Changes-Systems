<div class="box-header">
  <h3 class="box-title">Listado Detallado de Solicitudes</h3>
</div>
<!-- /.box-header -->
<div class="box-body table-responsive no-padding">
  <table class="table table-hover table-striped">
    <thead>
        <tr id="cell">
            <th>Tipo Documento</th>
            <th>CO</th>
            <th># Documento</th>
            <th>RS</th>
            <th>Cliente</th>
            <th>Permios</th>
            <th>Modulo</th>
            <th>Detalle Permiso</th>
            <th>Otra Solicitud</th>
            <th>Cual</th>
            <th>Usuario</th>
        </tr>                
    </thead>
    <tbody>
        @foreach ($changes as $element)
            <tr class="">
                <td>{{ $element->document }}</td>
                <td>{{ $element->co }}</td>
                <td>{{ $element->number }}</td>
                <td>{{ $element->rs }}</td>
                <td>{{ $element->client }}</td>
                <td>{{ $element->permission }}</td>
                <td>{{ $element->module }}</td>
                <td>{{ $element->detailpermission }}</td>
                <td>{{ $element->other ? 'SI' : 'NO' }}</td>
                <td>{{ $element->which }}</td>
                <td>{{ $element->user }}</td>                        
            </tr>
            
        @endforeach
    </tbody>
  </table>          
</div>        
<!-- /.box-body -->

<style>
    #cell {
        background-color: #5882FA;
        color: #ffffff;
        text-align: center;
    }

    .cell {
        background-color: #5882FA;
        color: #ffffff;
    }

    tr td {
        background-color: #ffffff;
    }

    tr > td {
        border: 0.5px solid #000000;
    }
</style>