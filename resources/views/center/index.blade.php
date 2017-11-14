@extends('home')

@section('content')
	
	<div class="panel panel-default" id="centerID">
		<div class="panel-heading">
			Centros de Operaciones			
			<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
		</div>		
		<div class="panel-body">
		<div>

		@include('partials/pagination', ['function' => 'getCenters'])

		<table class="table table-hover table-striped">
			<tr>
				<th width="10px">Codigo</th>
				<th >Descripción</th>
				<th width="10px">&nbsp;</th>
				<th width="10px">&nbsp;</th>
			</tr>
			
			<tr v-for="center in centers">
			    <template v-if="! center.editing">
                    <td>@{{ center.code }}</td>
                    <td>@{{ center.description }}</td>
                    <td>
                        <a href="#" @click.prevent="editCenter(center)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    </td>
                    <td>
                        <a href="#" @click.prevent="deleteCenter(center)">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>                        	
                    </td>
                </template>
                <template v-else>
                    <td><input type="text" v-model="center.code" disabled="true" class="form-control"></td>
                    <td><input type="text" v-model="draft.description" class="form-control">
                    <ul v-if="errorsEdit && errorsEdit.length" class="text-danger">
						<li v-for="error of errorsEdit">@{{error.description[0]}}</li>
				    </ul>
                    </td>
                    <td><a href="#" @click.prevent="updateCenter(center, draft)"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
                    <td><a href="#" @click.prevent="cancel(center)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </template>
            </tr>
		</table>

		<div class="panel-footer">
			<div class="col-md-3">
				<div class="input-group">
					<input type="text" name="code" class="form-control" v-model="CO.code" placeholder="Adiciona CO" />					
				</div>
			</div>
			<div class="col-md-9">
				<div class="input-group">
					<input type="text" name="description" class="form-control" v-model="CO.description" placeholder="Adiciona descripción" />
					<span class="input-group-btn">
						<button class="btn btn-primary btn-md" id="btn-todo" @click.prevent="storeCenter(CO)" >Add</button>
					</span>
				</div>
			</div>
			<ul v-if="errorsStore && errorsStore.length" class="text-danger">
				<li v-for="error of errorsStore">@{{error.code[0]}}</li>
				<li v-for="error of errorsStore">@{{error.description[0]}}</li>
		    </ul>
		</div>
	</div>
@endsection

@section('script')
	
	  {{-- styde.net --}}
	<script type="text/javascript">
		
		var vm = new Vue({
		    el: '#centerID',
		    created: function(){
		    	this.getCenters();
		    },
		    
		    data: {
		    	CO: [],
		        centers: [],
		        errorsEdit: [],
		        errorsStore: [],
		        draft: {},
		        pagination: {}
		    },
		    methods: {
		    	getCenters: function(page_url){

		    		let vm = this;
	                page_url = page_url || '/center'
	                axios.get(page_url).then(response => {
                        vm.makePagination(response.data)
                        this.centers = response.data.data
                    });
		    	},
		        deleteCenter: function (center) {
		        	this.errorsEdit = [];
		        	this.errorsStore = [];
		        	var url = '/center/' + center.id;
					axios.delete(url).then(response => {
						this.getCenters();
						toastr.success('Eliminado correctamente')
					});
		        },
		        editCenter: function (center) {
		        	this.errorsEdit = [];
		        	this.errorsStore = [];
		        	this.draft = $.extend({}, center);		        	
		            Vue.set(center, 'editing', true);
		        },
		        cancel: function(center){
		        	center.editing = false;
		        },
		        storeCenter: function (CO) {
		        	var url = '/center';
		        	this.errorsStore = [];

		        	axios.post(url, {
		        		code: CO.code,
		        		description: CO.description
		        	}).then(response => {
		        		toastr.success('C.O. creado correctamente');
		        		CO.code = '';
		        		CO.description = '';		        		
						this.getCenters()
		        	}).catch(e => {
		            	this.errorsStore.push(e.response.data);
		            });

		        },
		        updateCenter: function (center, draft) {
		            
		            var url = '/center/' + draft.id;
		            this.errors = []; 

		            axios.put(url, {
		            	description: draft.description
		            }).then(response => {		            	
						toastr.success('C.O. actualizado correctamente');
						this.getCenters()
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