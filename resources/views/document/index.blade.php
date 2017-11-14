@extends('home')

@section('content')
	
	<div class="panel panel-default" id="documentID">
		<div class="panel-heading">
			Tipos de Documentos			
		</div>		
		<div class="panel-body">
		<div>
		
		@include('partials/pagination', ['function' => 'getDocument'])

			<table class="table table-hover table-striped">
				<tr>
					<th >Descripción</th>
					<th width="10px">&nbsp;</th>
					<th width="10px">&nbsp;</th>
				</tr>
				<tr v-for="document in documents">
			        <template v-if="! document.editing">
			            <td>@{{ document.description }}</td>
			            <td>
			                <a href="#" @click.prevent="editDocument(document)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
			            </td>
			            <td>
			                <a href="#" @click.prevent="deleteDocument(document)">
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
			            <td><a href="#" @click.prevent="updateDocument(draft)"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
			            <td><a href="#" @click.prevent="cancel(document)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
			        </template>
			    </tr>
			</table>

		</div>			

		<div class="panel-footer">
			<div class="input-group">
				<input type="text" name="description" class="form-control" v-model="doc.description" placeholder="Adiciona descripción" />
				<span class="input-group-btn">
					<button class="btn btn-primary btn-md" id="btn-todo" @click.prevent="storeDocument(doc)" >Add</button>
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
		    el: '#documentID',
		    created: function(){
		    	this.getDocument();		    	
		    },
		    
		    data: {
		    	doc: [],
		        documents: [],
		        errorsEdit: [],
		        errorsStore: [],
		        draft: {},
	            pagination: {}
		    },
		    methods: {
		    	getDocument: function(page_url){
		    		let vm = this;
	                page_url = page_url || '/document'
	                axios.get(page_url).then(response => {
                        vm.makePagination(response.data)
                        this.documents = response.data.data
                    });
		    	},
		        deleteDocument: function (documents) {
		        	this.errorsEdit = [];
		        	var url = '/document/' + documents.id;
					axios.delete(url).then(response => {
						this.getDocument();
						toastr.success('Eliminado correctamente')
					});
		        },
		        editDocument: function (documents) {
		        	this.errorsEdit = [];
		        	this.draft = $.extend({}, documents);		        	
		            Vue.set(documents, 'editing', true);
		        },
		        cancel: function(document){
		        	document.editing = false;
		        	this.errors = []; 
		        },
		        storeDocument: function (doc) {
		        	var url = '/document';		        	
		        	console.log(url);
		        	axios.post(url, {		        		
		        		description: doc.description
		        	}).then(response => {
		        		toastr.success('Cargo creado correctamente');		        		
		        		doc.description = '';
		        		this.errorsStore = [];
						this.getDocument()
		        	}).catch(e => {	
		        		this.errorsStore = [];
		            	this.errorsStore.push(e.response.data);
		            });
		        },
		        updateDocument: function (draft) {
		            
		            var url = '/document/' + draft.id;
		            this.errors = []; 

		            axios.put(url, {
		            	description: draft.description
		            }).then(response => {
						toastr.success('Cargo actualizado correctamente');
						this.getDocument()
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