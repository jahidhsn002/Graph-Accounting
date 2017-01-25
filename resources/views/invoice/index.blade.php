
<template id="invoice">
	<div class="root">
	<ul class="nav nav-tabs np">
		<li :class="page=='invoice'?'active':''">
	   		<a href="#" v-on:click.prevent="page='invoice'" class="text-center">
	   			<span class="glyphicon glyphicon-folder-close gi-2x"></span>
	   			<br/>New Invoice
	   		</a>
	   	</li>
	   	<li :class="page=='allinvoice'?'active':''">
	   		<a href="#" v-on:click.prevent="page='allinvoice'" class="text-center">
	   			<span class="glyphicon glyphicon-book gi-2x"></span>
	   			<br/>Previous Invoice
	   		</a>
	   	</li>
	   	<li :class="page=='due_collection'?'active':''">
	   		<a href="#" v-on:click.prevent="page='due_collection'" class="text-center">
	   			<span class="glyphicon glyphicon-credit-card gi-2x"></span>
	   			<br/>Due Collection
	   		</a>
	   	</li>
	   	<li :class="page=='printInvoice'?'active disabled':'disabled'">
	   		<a href="#" v-on:click.prevent="" class="text-center">
	   			<span class="glyphicon glyphicon-duplicate gi-2x"></span>
	   			<br/>Invoice Slip
	   		</a>
	   	</li>
	</ul>
	<br/>
	<div v-if="page=='invoice'" class="invoice">
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-6">
					@include('invoice._customer')
				</div>
				<div class="col-sm-6">
					@include('invoice._invoice')
				</div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-12">
					<div class="tab-content clearfix page_cart">
						@include('invoice._cart')
						<div class="col-sm-6"></div>
						<div class="col-sm-6">
							@include('invoice._condition')
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
								<textarea v-model="invoice.comments" class="form-control"></textarea>
							</div>
						</div>
						<div id="Note" class="tab-pane fade">
							<div class="form-group">
								<textarea v-model="invoice.note" class="form-control"></textarea>
							</div>
						</div>
						<div id="Footer" class="tab-pane fade">
							<div class="form-group">
								<textarea v-model="invoice.terms" class="form-control"></textarea>
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
					<button class="btn btn-default" v-on:click="saveInvoice">Record Only</button>
					<button class="btn btn-default" type="submit">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<div v-if="page=='allinvoice'" class="invoice">
		<ul class="nav nav-tabs clearfix">
		   	<li class="pull-right"> 
		   		&nbsp;
		    	<div class="btn-group">
		    		<button v-if="Extselect.length>0" class="btn btn-success" v-on:click.prevent="page='printInvoice',print_id=Extelement.id">Slip</button>
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
			        <input type="text" v-model="search.invoice" class="form-control" placeholder="Invoice No.">
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
				<th>Invoice</th>
				<th>Date</th>
				<th>Company</th>
				<th>Customer</th>
				<th>Bill To</th>
				<th>Ship To</th>
				<th>Vat</th>
				<th>Shipping Cost</th>
				<th>Total</th>
				<th>Traking Ref No:</th>
				<th>Note</th>
			  </tr>
			</thead>
			<tbody>
			  <tr v-for="invoice in invoices | filterBy search.invoice in 'id' | filterBy search.date in 'date' | filterBy search.company in 'customer' in 'company' | filterBy search.name in 'customer' in 'name' | filterBy search.phone in 'customer.phone' | filterBy search.note in 'note' | orderBy 'date' -1" v-on:click="ExtSelect(invoice.id, invoice)">
			  	<th>
					<span :class="Extselect.indexOf(invoice.id)!=-1?'':'hidden'">
		  				<i class="glyphicon glyphicon-check"></i>
			  		</span>
			  		<span :class="Extselect.indexOf(invoice.id)!=-1?'hidden':''">
			  			<i class="glyphicon glyphicon-unchecked"></i>
			  		</span>
			  		&nbsp; # @{{invoice.id}}
			  	</th>
			  	<th>@{{invoice.date}}</th>
				<th>@{{invoice.customer.company}}</th>
				<th>
					@{{invoice.customer.name}}<br/>
					@{{invoice.customer.phone}}
				</th>
				<th>
					@{{invoice.customer.billing}}<br/>
				</th>
				<th>
					@{{invoice.customer.shipping}}<br/>
				</th>
				<th>@{{invoice.vat}}%</th>
				<th>@{{invoice.shipping_cost}}</th>
				<th>@{{invoice.total}}</th>
				<th>@{{invoice.track}}</th>
				<th>@{{invoice.note}}</th>
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
	<div v-if="page=='due_collection'">
		@include('invoice.due_collection')
	</div>
	<div v-if="page=='printInvoice'">
		<slip
			v-for="cc in invoices | filterBy print_id in 'id'"
			:data="cc"
			type="invoice"
			template="mhs"
		></slip>
	</div>
	</div>
</template>

