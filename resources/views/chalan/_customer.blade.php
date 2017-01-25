
<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#billing">Billing</a></li>
   <li><a data-toggle="tab" href="#shiping">Shipping</a></li>
</ul>

<div class="tab-content clearfix page_content">
	<div id="billing" class="tab-pane fade in active">
		<div :class="errors['chalan.customer.name']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Customer:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="chalan.customer.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="customer in customers | filterBy chalan.customer.name in 'name'">
			            <a href="#" v-on:click.prevent="setCustomer(customer)">
			              <span class="text">@{{customer.name}} | <small class="muted text-muted">@{{customer.phone}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['chalan.customer.name']}}</div>
		</div>
		<div :class="errors['chalan.customer.company']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Company:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="chalan.customer.company" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="customer in customers | filterBy chalan.customer.company in 'company'">
			            <a href="#" v-on:click.prevent="setCustomer(customer)">
			              <span class="text">@{{customer.company}} | <small class="muted text-muted">@{{customer.name}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['chalan.customer.company']}}</div>
		</div>
		<div :class="errors['chalan.customer.phone']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Phone No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="chalan.customer.phone" value="" type="text" class="form-control">
			</div>
			<div class="col-sm-12 text-right">@{{errors['chalan.customer.phone']}}</div>
		</div>
	</div>
	<div id="shiping" class="tab-pane fade">
		<div :class="errors['chalan.customer.shipping']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Address:</label>
			<div class="col-sm-8 input-group">
				<textarea v-model="chalan.customer.shipping" value="" class="form-control"></textarea>
			</div>
			<div class="col-sm-12 text-right">@{{errors['chalan.customer.shipping']}}</div>
		</div>
		<div :class="errors['chalan.shipping_cost']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Shipping Cost:</label>
			<div class="col-sm-8 input-group">
				<input v-model="chalan.shipping_cost" value="0" type="number" step="any" class="form-control" number>
			</div>
			<div class="col-sm-12 text-right">@{{errors['chalan.shipping_cost']}}</div>
		</div>
		<div :class="errors['chalan.traking']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Traking Ref No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="chalan.traking" value="" type="text" class="form-control">
			</div>
			<div class="col-sm-12 text-right">@{{errors['chalan.traking']}}</div>
		</div>
	</div>
</div>
<!--
<div class="tab-content clearfix page_content">
	<div id="billing" class="tab-pane fade in active">
		<div class="form-group">
			<label class="col-sm-4">Customer:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="chalan.customer.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="customer in customers | filterBy chalan.customer.name in 'name'">
			            <a href="#" v-on:click.prevent="setCustomer(customer)">
			              <span class="text">@{{customer.name}}<small class="muted text-muted">@{{customer.phone}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4">Company:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="chalan.customer.company" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="customer in customers | filterBy chalan.customer.company in 'company'">
			            <a href="#" v-on:click.prevent="setCustomer(customer)">
			              <span class="text">@{{customer.company}} | <small class="muted text-muted">@{{customer.name}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4">Phone No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="chalan.customer.phone" value="" type="text" class="form-control">
			</div>
		</div>
	</div>
	<div id="shiping" class="tab-pane fade">
		<div class="form-group">
			<label class="col-sm-4">Address:</label>
			<div class="col-sm-8 input-group">
				<textarea v-model="chalan.customer.shipping" value="" class="form-control"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4">Shipping Cost:</label>
			<div class="col-sm-8 input-group">
				<input v-model="chalan.shipping_cost" value="0" type="number" step="any" class="form-control" number>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4">Traking Ref No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="chalan.traking" value="" type="text" class="form-control">
			</div>
		</div>
	</div>
</div>


<button class="btn btn-info" type="button" data-toggle="modal" data-target="#invoiceCustomerModal">New</button>
<!- Modal ->
<div id="invoiceCustomerModal" class="modal" role="dialog">
  <div class="modal-dialog">

    <!- Modal content->
    <div class="modal-content">
      <div class="modal-header text-right">
        <h4 class="modal-title">Modal Header</h4>
      </div>
	  <div class="modal-body row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-4">Name:</label>
				<div class="col-sm-8 input-group">
					<input type="text" v-model="customer.name" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4">Company:</label>
				<div class="col-sm-8 input-group">
					<input type="text" v-model="customer.company" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4">Phone No:</label>
				<div class="col-sm-8 input-group">
					<input type="text" v-model="customer.phone" class="form-control">
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-4">Billing:</label>
				<div class="col-sm-8 input-group">
					<textarea v-model="customer.billing" class="form-control"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4">Shipping:</label>
				<div class="col-sm-8 input-group">
					<textarea v-model="customer.shipping" class="form-control"></textarea>
				</div>
			</div>
		</div>

		
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button class="btn btn-default" v-on:click.prevent="invoice_addCustomer">Record</button>
      </div>
    </div>

  </div>
</div>
-->
				