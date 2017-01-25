<ul class="nav nav-tabs clearfix">
   	<li class="pull-right">
   		&nbsp;
    	<div class="btn-group">
    		<button v-if="Extselect.length>0" class="btn btn-success" v-on:click.prevent="page='printservice',print_id=Extelement.id">Slip</button>
    		<button v-if="Extselect.length>0" class="btn btn-success" type="button" data-toggle="modal" data-target="#offerModal">Add Rebate</button>
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
	        <input type="text" v-model="search.number" class="form-control" placeholder="No.">
	    </div>
   	</li>
</ul>
<table class="table table-bordered table-hover">
	<thead>
	  <tr>
		<th># A/C</th>
		<th>Date</th>
		<th>Company</th>
		<th>Customer</th>
		<th>Address</th>
		<th>Tax</th>
		<th>Total</th>
		<th>Status</th>
		<th>Note</th>
	  </tr>
	</thead>
	<tbody>
	  <tr v-for="service in services  | filterBy 'Delivered' in 'status' | filterBy search.number in 'id' |  filterBy search.date in 'date' | orderBy 'date' -1" v-on:click="ExtSelect(service.id, service)">
	  	<th>
	  		<span :class="Extselect.indexOf(service.id)!=-1?'':'hidden'">
  				<i class="glyphicon glyphicon-check"></i>
	  		</span>
	  		<span :class="Extselect.indexOf(service.id)!=-1?'hidden':''">
	  			<i class="glyphicon glyphicon-unchecked"></i>
	  		</span>
	  		&nbsp; #@{{service.id}}</th>
	  	<th>@{{service.date}}</th>
		<th>@{{service.customer.company}}</th>
		<th>
			@{{service.customer.name}}<br/>
			@{{service.customer.phone}}
		</th>
		<th>
			@{{service.customer.billing}}<br/>
		</th>
		<th>@{{service.vat}}%</th>
		<th>@{{service.total}}</th>
		<th>@{{service.status}}</th>
		<th>@{{service.note}}</th>
	  </tr>
	</tbody>
</table>

<!-- Modal -->
		<div id="offerModal" class="modal" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header text-right">
		        <h4 class="modal-title">Add Rebate</h4>
		      </div>
			  <div class="modal-body row">
				<div class="col-sm-12">
					<div class="form-group">
						<label class="col-sm-4">Rebate Text:</label>
						<div class="col-sm-8 input-group">
							<input type="text" v-model="offer.description" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4">Rebate Total:</label>
						<div class="col-sm-8 input-group">
							<input type="number" step="any" v-model="offer.value" class="form-control" number>
						</div>
					</div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class="btn btn-default" v-on:click.prevent="offerInvoice">Set Rebate</button>
		      </div>
		    </div>

		  </div>
		</div>