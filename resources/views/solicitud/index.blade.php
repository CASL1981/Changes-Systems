	@extends('home')

@section('content')
	
	<div class="panel panel-default" id="solicitudID">
		<div class="panel-heading">
			Tipos de solicitud
			<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
		</div>		
		<div class="panel-body">
		<div>
		{{-- paginacion con Paginación simple de Vue.js con Laravel --}}
		<div class="pagination">
		      <button class="btn btn-default" @click="getSolicitud(pagination.prev_page_url)"
		              :disabled="!pagination.prev_page_url">
		          Anterior
		      </button>
		      <span>Pagina @{{pagination.current_page}} de @{{pagination.last_page}}</span>
		      <button class="btn btn-default" @click="getSolicitud(pagination.next_page_url)"
		              :disabled="!pagination.next_page_url">Siguiente
		      </button>
		</div>
			<table class="table table-hover table-striped">
				<tr>
					<th >Descripción</th>
					<th width="10px">&nbsp;</th>
					<th width="10px">&nbsp;</th>
				</tr>
				<tr v-for="solicitud in solicitudes">
                    <template v-if="! solicitud.editing">
                        <td>@{{ solicitud.description }}</td>
                        <td>
                            <a href="#" @click.prevent="editSolicitud(solicitud)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        </td>
                        <td>
                            <a href="#" @click.prevent="deleteSolicitud(solicitud)">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>                        	
                        </td>
                    </template>
                    <template v-else>
                        <td><input type="text" v-model="draft.description" class="form-control">
                        <ul v-if="errorsEdit && errorsEdit.length" class="text-danger">
    						<li v-for="error of errorsEdit">@{{error.description[0]}}</li>
					    </ul>
                        </td>
                        <td><a href="#" @click.prevent="updateSolicitud(draft)"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
                        <td><a href="#" @click.prevent="cancel(solicitud)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                    </template>
	            </tr>
			</table>
		</div>			

		<div class="panel-footer">
			<div class="input-group">
				<input type="text" name="description" class="form-control" v-model="solic.description" placeholder="Adiciona descripción" />
				<span class="input-group-btn">
					<button class="btn btn-primary btn-md" id="btn-todo" @click.prevent="storeSolicitud(solic)" >Add</button>
				</span>
			</div>
			<ul v-if="errorsStore && errorsStore.length" class="text-danger">			
				<li v-for="error of errorsStore">@{{error.description[0]}}</li>
		    </ul>
		</div>		
	</div>
@endsection

@section('script')
	
	{{-- styde.net --}}
	<script type="text/javascript">
		
		var vm = new Vue({
		    el: '#solicitudID',
		    created: function(){
		    	this.getSolicitud();		    	
		    },
		    
		    data: {
		    	solic: [],
		        solicitudes: [],
		        errorsEdit: [],
		        errorsStore: [],
		        draft: {},
	            pagination: {}
		    },
		    methods: {
		    	getSolicitud: function(page_url){
		    		let vm = this;
	                page_url = page_url || '/solicitud'
	                axios.get(page_url).then(response => {
                        vm.makePagination(response.data)
                        this.solicitudes = response.data.data
                    });
		    	},
		        deleteSolicitud: function (solicitudes) {
		        	this.errorsEdit = [];
		        	var url = '/solicitud/' + solicitudes.id;
					axios.delete(url).then(response => {
						this.getSolicitud();
						toastr.success('Solicitud eliminado correctamente')
					});
		        },
		        editSolicitud: function (solicitudes) {
		        	this.errorsEdit = [];
		        	this.draft = $.extend({}, solicitudes);		        	
		            Vue.set(solicitudes, 'editing', true);
		        },
		        cancel: function(solicitud){		        	
		        	solicitud.editing = false;
		        },
		        storeSolicitud: function (solic) {
		        	var url = '/solicitud';		        	
		        	axios.post(url, {		        		
		        		description: solic.description
		        	}).then(response => {
		        		toastr.success('Solicitud creado correctamente');		        		
		        		solic.description = '';
		        		this.errorsStore = [];
						this.getSolicitud()
		        	}).catch(e => {	
		        		this.errorsStore = [];
		            	this.errorsStore.push(e.response.data);
		            });

		        },
		        updateSolicitud: function (draft) {
		            
		            var url = '/solicitud/' + draft.id;
		            this.errors = []; 

		            axios.put(url, {
		            	description: draft.description
		            }).then(response => {		            	
						toastr.success('Solicitud actualizado correctamente');
						this.getSolicitud()
		            }).catch(e => {
		            	this.errorsEdit = [];
		            	this.errorsEdit.push(e.response.data);
		            });
		        },
	            makePagination: function(data){
	                let pagination = {
	                    current_page: data.current_page,
	                    last_page: data.last_page,
	                    next_page_url: data.next_page_url,
	                    prev_page_url: data.prev_page_url
	                }
	                Vue.set(this, 'pagination', pagination)
	            }
		    }
		});
	</script>
@endsection