
<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#billing">Billing</a></li>
   <li><a data-toggle="tab" href="#shiping">Shipping</a></li>
</ul>

<div class="tab-content clearfix page_content">
	<div id="billing" class="tab-pane fade in active">
		<div :class="errors['invoice.customer.name']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Customer:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="invoice.customer.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="customer in customers | filterBy invoice.customer.name in 'name'">
			            <a href="#" v-on:click.prevent="setCustomer(customer)">
			              <span class="text">@{{customer.name}} | <small class="muted text-muted">@{{customer.phone}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['invoice.customer.name']}}</div>
		</div>
		<div :class="errors['invoice.customer.company']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Company:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="invoice.customer.company" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="customer in customers | filterBy invoice.customer.company in 'company'">
			            <a href="#" v-on:click.prevent="setCustomer(customer)">
			              <span class="text">@{{customer.company}} | <small class="muted text-muted">@{{customer.name}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['invoice.customer.company']}}</div>
		</div>
		<div :class="errors['invoice.customer.billing']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Address:</label>
			<div class="col-sm-8 input-group">
				<textarea v-model="invoice.customer.billing" value="" class="form-control"></textarea>
			</div>
			<div class="col-sm-12 text-right">@{{errors['invoice.customer.billing']}}</div>
		</div>
		<div :class="errors['invoice.customer.phone']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Phone No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="invoice.customer.phone" value="" type="text" class="form-control">
			</div>
			<div class="col-sm-12 text-right">@{{errors['invoice.customer.phone']}}</div>
		</div>
		<div :class="errors['invoice.user.name']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Sold by:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="invoice.user.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="user in users | filterBy invoice.user.name in 'name'">
			            <a href="#" v-on:click.prevent="setUser(user)">
			              <span class="text">@{{user.name}} | <small class="muted text-muted">@{{user.designation}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['invoice.customer.name']}}</div>
		</div>
	</div>
	<div id="shiping" class="tab-pane fade">
		<div :class="errors['invoice.customer.shipping']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Address:</label>
			<div class="col-sm-8 input-group">
				<textarea v-model="invoice.customer.shipping" value="" class="form-control"></textarea>
			</div>
			<div class="col-sm-12 text-right">@{{errors['invoice.customer.shipping']}}</div>
		</div>
		<div :class="errors['invoice.shipping_cost']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Shipping Cost:</label>
			<div class="col-sm-8 input-group">
				<input v-model="invoice.shipping_cost" value="0" type="number" step="any" class="form-control" number>
			</div>
			<div class="col-sm-12 text-right">@{{errors['invoice.shipping_cost']}}</div>
		</div>
		<div :class="errors['invoice.traking']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Traking Ref No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="invoice.traking" value="" type="text" class="form-control">
			</div>
			<div class="col-sm-12 text-right">@{{errors['invoice.traking']}}</div>
		</div>
	</div>
</div>
		

