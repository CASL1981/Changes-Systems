@extends('home')

@section('content')
	
	<div class="panel panel-default" id="positionID">
		<div class="panel-heading">
			Cargos
			<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
		</div>		
		<div class="panel-body">
		<div>
		
		@include('partials/pagination', ['function' => 'getPosition'])

			<table class="table table-hover table-striped">
				<tr>
					<th >Descripción</th>
					<th width="10px">&nbsp;</th>
					<th width="10px">&nbsp;</th>
				</tr>
				<tr v-for="position in positions">
                    <template v-if="! position.editing">
                        <td>@{{ position.description }}</td>
                        <td>
                            <a href="#" @click.prevent="editPosition(position)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        </td>
                        <td>
                            <a href="#" @click.prevent="deletePosition(position)">
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
                        <td><a href="#" @click.prevent="updatePosition(draft)"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
                        <td><a href="#" @click.prevent="cancel(position)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                    </template>
	            </tr>
			</table>
		</div>			

		<div class="panel-footer">
			<div class="input-group">
				<input type="text" name="description" class="form-control" v-model="posit.description" placeholder="Adiciona descripción" />
				<span class="input-group-btn">
					<button class="btn btn-primary btn-md" id="btn-todo" @click.prevent="storePosition(posit)" >Add</button>
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
		    el: '#positionID',
		    created: function(){
		    	this.getPosition();		    	
		    },
		    
		    data: {
		    	posit: [],
		        positions: [],
		        errorsEdit: [],
		        errorsStore: [],
		        draft: {},
	            pagination: {}
		    },
		    methods: {
		    	getPosition: function(page_url){
		    		let vm = this;
	                page_url = page_url || '/position'
	                axios.get(page_url).then(response => {
                        vm.makePagination(response.data)
                        this.positions = response.data.data
                    });
		    	},
		        deletePosition: function (positions) {
		        	this.errorsEdit = [];
		        	var url = '/position/' + positions.id;
					axios.delete(url).then(response => {
						this.getPosition();
						toastr.success('Eliminado correctamente')
					});
		        },
		        editPosition: function (positions) {
		        	this.errorsEdit = [];
		        	this.draft = $.extend({}, positions);		        	
		            Vue.set(positions, 'editing', true);
		        },
		        cancel: function(position){
		        	position.editing = false;
		        },
		        storePosition: function (posit) {
		        	var url = '/position';		        	
		        	axios.post(url, {		        		
		        		description: posit.description
		        	}).then(response => {
		        		toastr.success('Cargo creado correctamente');		        		
		        		posit.description = '';
		        		this.errorsStore = [];
						this.getPosition()
		        	}).catch(e => {	
		        		this.errorsStore = [];
		            	this.errorsStore.push(e.response.data);
		            });

		        },
		        updatePosition: function (draft) {
		            
		            var url = '/position/' + draft.id;
		            this.errors = []; 

		            axios.put(url, {
		            	description: draft.description
		            }).then(response => {		            	
						toastr.success('Cargo actualizado correctamente');
						this.getPosition()
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