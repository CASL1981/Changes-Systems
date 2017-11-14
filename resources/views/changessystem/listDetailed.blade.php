@extends('home')

@section('content')
<div class="container" id="listdetailed">
    <div class="row">
    <div class="box">
        <div class="box-header">
          <h3 class="box-title">Listado Detallado de Solicitudes</h3>
          
            <div class="form-group has-feedback">                        
                <input type="text" class="form-control" v-model="search" placeholder="Buscar Por Solicitante">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
            <p>
                <a href="{{ route('changes.excel') }}" class="btn btn-sm btn-primary">
                    Descargar Excel
                </a>
            </p>               
            
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Docum</th>
                    <th>CO</th>
                    <th># Doc.</th>
                    <th>RS</th>
                    <th>Cliente</th>
                    <th>Permios</th>
                    <th>Modulo</th>
                    <th>Detalle Permiso</th>
                    <th>Otra S.</th>
                    <th>Cual</th>
                    <th>Usuario</th>
                </tr>                
            </thead>
            <tbody>
                <tr v-for="change in searchUser">
                    @verbatim
                        <td>{{ change.document }}</td>
                        <td>{{ change.co }}</td>
                        <td>{{ change.number }}</td>
                        <td>{{ change.rs }}</td>
                        <td>{{ change.client }}</td>
                        <td>{{ change.permission }}</td>
                        <td>{{ change.module }}</td>
                        <td>{{ change.detailpermission }}</td>
                        <td>{{ change.other ? 'SI' : 'NO' }}</td>
                        <td>{{ change.which }}</td>
                        <td>{{ change.user }}</td>
                    @endverbatim
                </tr>
            </tbody>
          </table>
          <nav>            
               <ul class="pagination">
                   <li v-if="pagination.current_page > 1">
                        <a href="#" @@click.prevent="changePage(pagination.current_page - 1)"><span>Atras</span></a>
                   </li>
                   <li v-for="page in pagesNumber" :class="[ page == isActived ? 'active' : '' ]">
                        <a href="#" @@click.prevent="changePage(page)">
                            @{{ page }}
                        </a>
                    </li>
                   <li v-if="pagination.current_page < pagination.last_page">
                        <a href="#" @click.prevent="changePage(pagination.current_page + 1)"><span>Siguiente</span></a>
                    </li>
               </ul>
          </nav>
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
    
        var vm = new Vue({
            el: '#listdetailed',
            created:function(){
                this.getChanges();
            },
            data: {
                changes: [],
                search: '',
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0
                },
                offset: 1          
            },
            computed: {
                isActived: function(){
                    return this.pagination.current_page;
                },
                pagesNumber: function(){
                    if (!this.pagination.to) {
                        return [];
                    }

                    var form = this.pagination.current_page - this.offset;
                    if (form < 1) {
                        form = 1;
                    }

                    var to = form + (this.offset * 2);
                    if (to >= this.pagination.last_page) {
                        to = this.pagination.last_page;
                    }

                    var pagesArray = [];
                    while(form <= to){
                        pagesArray.push(form);
                        form++;
                    }

                    return pagesArray;
                },
                searchUser: function () {
                    
                    return this.changes.filter((change) => change.user.includes(this.search));
                },
                truncate: function(str, value){                    
                    return str.substring(0, value);
                }
            },
            methods: {
                getChanges: function(page){                    
                    page_url = '/listdetailedchanges?page='+page;
                    axios.get(page_url).then(response => {
                      this.changes = response.data.solicitudes.data;
                      this.pagination = response.data.pagination;
                    });
                },
                changePage: function(page) {
                    this.pagination.current_page = page;
                    this.getChanges(page);
                }
            }
        });
    </script>
@endsection

@section('style')
    <style type="text/css">
        
    </style>
@endsection