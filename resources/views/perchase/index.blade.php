<template id="perchase">
	<div class="root">
	<ul class="nav nav-tabs np">
		<li :class="page=='perchase'?'active':''">
	   		<a href="#" v-on:click.prevent="page='perchase'" class="text-center">
	   			<span class="glyphicon glyphicon-folder-close gi-2x"></span>
	   			<br/>New Purchase
	   		</a>
	   	</li>
	   	<li :class="page=='allperchase'?'active':''">
	   		<a href="#" v-on:click.prevent="page='allperchase'" class="text-center">
	   			<span class="glyphicon glyphicon-book gi-2x"></span>
	   			<br/>Previous Purchase
	   		</a>
	   	</li>
	   	<li :class="page=='due_payment'?'active':''">
	   		<a href="#" v-on:click.prevent="page='due_payment'" class="text-center">
	   			<span class="glyphicon glyphicon-credit-card gi-2x"></span>
	   			<br/>Due Payment
	   		</a>
	   	</li>
	   	<li :class="page=='printperchase'?'active disabled':'disabled'">
	   		<a href="#" v-on:click.prevent="" class="text-center">
	   			<span class="glyphicon glyphicon-duplicate gi-2x"></span>
	   			<br/>Purchase Slip
	   		</a>
	   	</li>
	</ul>
	<br/>
	<div v-if="page=='perchase'" class="invoice">
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-6">
					@include('perchase._supplier')
				</div>
				<div class="col-sm-6">
					@include('perchase._perchase')
				</div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-12">
					<div class="tab-content clearfix page_cart">
						@include('perchase._cart')
						<div class="col-sm-6"></div>
						<div class="col-sm-6">
							@include('perchase._condition')
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-6">
					<ul class="nav nav-tabs">
					   <li class="active"><a data-toggle="tab" href="#Comments">Comments</a></li>
					   <li><a data-toggle="tab" href="#Note">Note</a></li>
					   <li><a data-toggle="tab" href="#Footer">Terms &amp; Conditions</a></li>
					</ul>

					<div class="tab-content clearfix page_content">
						<div id="Comments" class="tab-pane fade in active">
							<div class="form-group">
								<textarea v-model="perchase.comments" class="form-control"></textarea>
							</div>
						</div>
						<div id="Note" class="tab-pane fade">
							<div class="form-group">
								<textarea v-model="perchase.note" class="form-control"></textarea>
							</div>
						</div>
						<div id="Footer" class="tab-pane fade">
							<div class="form-group">
								<textarea v-model="perchase.terms" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
	                <table class="table">
						<tbody>
							<tr>
								<td class="text-center">Subtotal : @{{subTotal.toFixed(2)}}</td>
							</tr>
							<tr>
								<th class="text-center">Total : @{{Total.toFixed(2)}}</th>
							</tr>
						</tbody>
					</table>
	            </div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-12 text-right">
					<button class="btn btn-default" v-on:click="saveperchase">Record Only</button>
					<button class="btn btn-default" type="submit">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<div v-if="page=='allperchase'" class="perchase">
		<ul class="nav nav-tabs clearfix">
		   	<li class="pull-right">
		   		&nbsp;
		    	<div class="btn-group">
					<button v-if="Extselect.length>0" class="btn btn-success" v-on:click.prevent="page='printperchase',print_id=Extelement.id">Slip</button>
					<button v-if="Extselect.length>0" class="btn btn-success" type="button" data-toggle="modal" data-target="#offerModal">Add Discount</button>
		        	<button v-if="Extselect.length>0" v-on:click.prevent="Delete" class="btn btn-danger">Delete</button>
				</div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.date" placeholder="Date" class="form-control datepicker" data-provide="datepicker" data-date-format="dd/mm/yyyy">
			    </div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.perchase" class="form-control" placeholder="perchase No.">
			    </div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.name" class="form-control" placeholder="Name">
			    </div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.company" class="form-control" placeholder="Company">
			    </div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.phone" class="form-control" placeholder="Phone">
			    </div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.note" class="form-control" placeholder="Note">
			    </div>
		   	</li>
		</ul>
		<table class="table table-bordered">
			<thead>
			  <tr>
				<th>Date #perchase</th>
				<th>Company</th>
				<th>supplier</th>
				<th>Address</th>
				<th>Tax</th>
				<th>Shipping Cost</th>
				<th>Total</th>
				<th>Note</th>
			  </tr>
			</thead>
			<tbody>
			  <tr v-for="perchase in perchases | filterBy search.perchase in 'id' | filterBy search.date in 'date' | filterBy search.company in 'supplier' in 'company' | filterBy search.name in 'supplier' in 'name' | filterBy search.phone in 'supplier' in 'phone' | filterBy search.note in 'note' | orderBy 'date' -1" v-on:click="ExtSelect(perchase.id, perchase)">
			  	<th>
					<span :class="Extselect.indexOf(perchase.id)!=-1?'':'hidden'">
		  				<i class="glyphicon glyphicon-check"></i>
			  		</span>
			  		<span :class="Extselect.indexOf(perchase.id)!=-1?'hidden':''">
			  			<i class="glyphicon glyphicon-unchecked"></i>
			  		</span>
			  		@{{perchase.date}} # @{{perchase.id}}
			  	</th>
				<th>@{{perchase.supplier.company}}</th>
				<th>
					@{{perchase.supplier.name}}<br/>
					@{{perchase.supplier.phone}}
				</th>
				<th>
					@{{perchase.supplier.address}}<br/>
				</th>
				<th>@{{perchase.tax}}</th>
				<th>@{{perchase.shipping_cost}}</th>
				<th>@{{perchase.total}}</th>
				<th>@{{perchase.note}}</th>
			  </tr>
			</tbody>
		</table>
		<!-- Modal -->
		<div id="offerModal" class="modal" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header text-right">
		        <h4 class="modal-title">Add Discount</h4>
		      </div>
			  <div class="modal-body row">
				<div class="col-sm-12">
					<div class="form-group">
						<label class="col-sm-4">Name:</label>
						<div class="col-sm-8 input-group">
							<input type="text" v-model="offer.description" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4">Value:</label>
						<div class="col-sm-8 input-group">
							<input type="number" step="any" v-model="offer.value" class="form-control" number>
						</div>
					</div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class="btn btn-default" v-on:click.prevent="offerInvoice">Set Offer</button>
		      </div>
		    </div>

		  </div>
		</div>
	</div>
	<div v-if="page=='due_payment'">
		@include('perchase.due_payment')
	</div>
	<div v-if="page=='printperchase'">
		<slip
			v-for="cc in perchases | filterBy print_id in 'id'"
			:data="cc"
			type="perchase"
			template="mhs"
		></slip>
	</div>
	</div>
</template>

