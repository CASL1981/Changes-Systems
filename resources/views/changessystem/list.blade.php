@extends('home')

@section('content')
<div class="container">
    <div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Listado de Solicitudes</h3>            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
                <th>ITEM</th>
                <th>FECHA</th>
                <th>USUARIO</th>
                <th>RESUMEN</th>
                <th style="text-align:center;">VER</th>
                <th style="text-align:center;">APROBADA</th>
                <th style="text-align:center;">EJECUTADA</th>
                <th>&nbsp;</th>
            </tr>
            
            @foreach ($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud->id }}</td>
                <td>{{ $solicitud->created_at }}</td>
                <td>{{ $solicitud->user->name }}</td>
                <td>{{ substr($solicitud->justification, 0, 20) }}</td>
                <td style="text-align:center;"><a href="#" onclick="showModal({{ $solicitud->id }})" id="#myModal"><i class="fa fa-eye fa-4" aria-hidden="true"></i></a></td>
                <td style="text-align:center;">
                    <a href="{{ route('approvechangessystem', $solicitud) }}" >{{ $solicitud->director > 0 ? "Aprobado" : "Pendiente" }}</a>
                </td>
                <td style="text-align:center;">
                    <a href="{{ route('runchangessystem', $solicitud) }}" >{{ $solicitud->state > 0 ? "Aprobado" : "Pendiente" }}</a>
                </td>
                <td style="text-align:center;"><a href="#"  onclick="showObservation({{ $solicitud->id }})">Observaciones</a></td>
            </tr>                            
            @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>

    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade " role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">      
      <div class="modal-body" id="formChangesSystem">        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">

        function showModal(id){
            var url = '/changessystem/' + id;
            axios.get(url).then(response => {                
                $("#formChangesSystem").html(response.data);
                $("#myModal").modal('show');
            })
        }

        function showObservation(id){
            var url = '/observation/' + id;
            axios.get(url).then(response => {                
                $("#formChangesSystem").html(response.data);
                $("#myModal").modal('show');
            })
        }

        // function approve(id){
        //    var url = '/approvechange/' + id;
        //     axios.get(url).then(response => {
        //         console.log(response.data);                
        //     }) 
        // }
    </script>
@endsection

@section('style')
    <style type="text/css">
        
    </style>
@endsection