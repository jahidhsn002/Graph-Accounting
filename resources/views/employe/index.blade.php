
<template id="employe">
	<div class="root">
	<div class="invoice">
		<ul class="nav nav-tabs clearfix">
			<li class="active">
		   		<a href="#" v-on:click.prevent="" class="text-center">
		   			<span class="glyphicon glyphicon-user gi-2x"></span>
		   			<br/>Employes
		   		</a>
		   	</li>
		   	<li class="pull-right">
			    <div class="btn-group">
				  <button v-show="select.length!=0" v-on:click.prevent="Delete" class="btn btn-danger">Delete</button>
	              <button v-show="select.length!=0" data-toggle="modal" data-target="#employes" class="btn btn-success">Edit</button>
	              <button data-toggle="modal" data-target="#employes" v-on:click.prevent="element={company_id:filtercompany},select=[],form=[]" class="btn btn-success">Add</button>
				</div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.name" class="form-control" placeholder="A/C Name">
			    </div>
		   	</li>
		</ul>
		<br/>
		@include('employe._crud')
	</div>

	<!-- Modal -->
	<div id="employes" class="modal" role="dialog">
	  <div class="modal-dialog modal-sm">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <form class="form-horizontal" v-on:submit.prevent="Save">
	      <div class="modal-header text-right">
	        <h4 class="modal-title">Employe Modifire</h4>
	      </div>
		  <div class="modal-body row">
			<div class="col-sm-12">
				@include('employe._form')
			</div>
	      </div>
	      <div class="modal-footer">
	        <button v-on:click.prevent="element={},form=[]" class="btn btn-default" data-dismiss="modal">Clear</button>
			<button class="btn btn-default" type="submit">Record</button>
	      </div>
	      </form>
	    </div>

	  </div>
	</div>
	</div>
</template>