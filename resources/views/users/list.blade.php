@extends('home')

@section('content')
<div class="container">
    <div class="row">
    <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de Usuarios</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Area</th>
                <th>Rol</th>
                <th>Cargo</th>
                <th>CO</th>
                <th></th>
            </tr>
            
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->area }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ substr($user->position->description, 0, 20) }}</td>
                <td>{{ substr($user->center->description, 0, 20) }}</td>
                <td>
                    <a href="{{ route('user.edit', $user) }}" class="fa fa-pencil"></a>
                    <a href="#" onclick="confirmacion({{ $user->id }})" class="fa fa-eraser">
                    </a>
                </td>
            </tr>                            
            @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>

    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">

        function confirmacion(id){

            var mensaje = confirm('Seguro Deseas Eliminar Este Usuario');

            if (mensaje) {                
               var url = '/user/' + id;
                axios.delete(url).then(response => {                    
                    toastr.success('Usuario hinabilitado')
                });
            } else {}
        }
    </script>
@endsection