
<template id="supplier">
	<div class="root">
	<div class="invoice">
		<ul class="nav nav-tabs clearfix">
			<li class="active">
		   		<a href="#" v-on:click.prevent="" class="text-center">
		   			<span class="glyphicon glyphicon-user gi-2x"></span>
		   			<br/>Suppliers
		   		</a>
		   	</li>
		   	<li class="pull-right">
			    <div class="btn-group">
				  <button v-show="select.length!=0" v-on:click.prevent="Delete" class="btn btn-danger">Delete</button>
	              <button v-show="select.length!=0" data-toggle="modal" data-target="#suppliers" class="btn btn-success">Edit</button>
	              <button data-toggle="modal" data-target="#suppliers" v-on:click.prevent="element={company_id:filtercompany},select=[],form=[],errors=[]" class="btn btn-success">Add</button>
				</div>
		   	</li>
			<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.phone" class="form-control" placeholder="Phone">
			    </div>
			</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.company" class="form-control" placeholder="Company">
			    </div>
			</li>
			<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.name" class="form-control" placeholder="Name">
			    </div>
		   	</li>
		</ul>
		<br/>
		@include('supplier._crud')
	</div>

	<!-- Modal -->
	<div id="suppliers" class="modal" role="dialog">
	  <div class="modal-dialog modal-sm">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <form class="form-horizontal" v-on:submit.prevent="Save">
	      <div class="modal-header text-right">
	        <h4 class="modal-title">Supplier Modifire</h4>
	      </div>
		  <div class="modal-body row">
			<div class="col-sm-12">
				@include('supplier._form')
			</div>
	      </div>
	      <div class="modal-footer">
	        <button v-on:click.prevent="element={},form=[],errors=[]" class="btn btn-default">Clear</button>
			<button class="btn btn-default" type="submit">Record</button>
	      </div>
	      </form>
	    </div>

	  </div>
	</div>
	</div>
</template>