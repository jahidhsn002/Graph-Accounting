
<template id="product">
	<div class="root">
	<div class="invoice">
		<ul class="nav nav-tabs clearfix">
			<li class="active">
		   		<a href="#" v-on:click.prevent="" class="text-center">
		   			<span class="glyphicon glyphicon-erase gi-2x"></span>
		   			<br/>Products
		   		</a>
		   	</li>
		   	<li class="pull-right">
			    <div class="btn-group">
				  <button v-show="select.length!=0" v-on:click.prevent="Delete" class="btn btn-danger">Delete</button>
	              <button v-show="select.length!=0" data-toggle="modal" data-target="#Accounts" class="btn btn-success">Edit</button>
	              <button data-toggle="modal" data-target="#Accounts" v-on:click.prevent="element={stock:{}},select=[],form=[],errors=[]" class="btn btn-success">Add</button>
				</div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.description" class="form-control" placeholder="Description">
			    </div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.brand" class="form-control" placeholder="Brand/Origin">
			    </div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.iban" class="form-control" placeholder="IBAN/UBN/POS">
			    </div>
		   	</li>
		</ul>
		<br/>
		@include('product._crud')
	</div>

	<!-- Modal -->
	<div id="Accounts" class="modal" role="dialog">
	  <div class="modal-dialog modal-sm">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <form class="form-horizontal" v-on:submit.prevent="Save">
	      <div class="modal-header text-right">
	        <h4 class="modal-title">Product Options &nbsp;</h4>
	      </div>
		  <div class="modal-body row">
			<div class="col-sm-12">
				@include('product._form')
			</div>
	      </div>
	      <div class="modal-footer">
	        <button v-on:click.prevent="element={stock:{}},form=[],errors=[]" class="btn btn-default">Clear</button>
			<button class="btn btn-default" type="submit" data-toggle="confirmation" data-placement="top">Record</button>
	      </div>
	      </form>
	    </div>

	  </div>
	</div>
	</div>
</template>