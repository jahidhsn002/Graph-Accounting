
<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#billing">Return From</a></li>
</ul>

<div class="tab-content clearfix page_content">
	<div id="billing" class="tab-pane fade in active">
		<div :class="errors['breturn.customer.name']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Customer:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="breturn.customer.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="customer in customers | filterBy breturn.customer.name in 'name'">
			            <a href="#" v-on:click.prevent="setCustomer(customer)">
			              <span class="text">@{{customer.name}}<small class="muted text-muted">@{{customer.phone}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['breturn.customer.name']}}</div>
		</div>
		<div :class="errors['breturn.customer.billing']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Address:</label>
			<div class="col-sm-8 input-group">
				<textarea v-model="breturn.customer.billing" value="" class="form-control"></textarea>
			</div>
			<div class="col-sm-12 text-right">@{{errors['breturn.customer.billing']}}</div>
		</div>
		<div :class="errors['breturn.customer.phone']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Phone No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="breturn.customer.phone" value="" type="text" class="form-control">
			</div>
			<div class="col-sm-12 text-right">@{{errors['breturn.customer.phone']}}</div>
		</div>
	</div>
</div>

				