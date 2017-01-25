
<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#billing">Billing</a></li>
</ul>

<div class="tab-content clearfix page_content">
	<div id="billing" class="tab-pane fade in active">
		<div class="form-group">
			<label class="col-sm-4">Customer:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="service.customer.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="customer in customers | filterBy service.customer.name in 'name'">
			            <a href="#" v-on:click.prevent="setcustomer(customer)">
			              <span class="text">@{{customer.name}} | <small class="muted text-muted">@{{customer.phone}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4">Company:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="service.customer.company" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="customer in customers | filterBy service.customer.company in 'company'">
			            <a href="#" v-on:click.prevent="setcustomer(customer)">
			              <span class="text">@{{customer.company}} | <small class="muted text-muted">@{{customer.name}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4">Address:</label>
			<div class="col-sm-8 input-group">
				<textarea v-model="service.customer.billing" value="" class="form-control"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4">Phone No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="service.customer.phone" value="" type="text" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4">Vat:</label>
			<div class="col-sm-8 input-group">
				<input v-model="service.vat" value="0" type="number" step="any" class="form-control" number>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4">Status:</label>
			<div class="col-sm-8 input-group">
				<label class="radio-inline text-info"><input type="radio" v-model="service.status" value="Estimate">Estimate</label>
				<label class="radio-inline text-danger"><input type="radio" v-model="service.status" value="Working">Working</label>
				<label class="radio-inline text-success"><input type="radio" v-model="service.status" value="Delivered">Delivered</label>
			</div>
		</div>
	</div>
</div>
				