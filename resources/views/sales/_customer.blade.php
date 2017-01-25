
<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#billing">Billing</a></li>
</ul>

<div class="tab-content clearfix page_content">
	<div id="billing" class="tab-pane fade in active">
		<div :class="errors['sale.customer.name']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Customer:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="sale.customer.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="customer in customers | filterBy sale.customer.name in 'name'">
			            <a href="#" v-on:click.prevent="setCustomer(customer)">
			              <span class="text">@{{customer.name}}<small class="muted text-muted">@{{customer.phone}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['sale.customer.name']}}</div>
		</div>
		<div :class="errors['sale.customer.billing']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Address:</label>
			<div class="col-sm-8 input-group">
				<textarea v-model="sale.customer.billing" value="" class="form-control"></textarea>
			</div>
			<div class="col-sm-12 text-right">@{{errors['sale.customer.billing']}}</div>
		</div>
		<div :class="errors['sale.customer.phone']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Phone No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="sale.customer.phone" value="" type="text" class="form-control">
			</div>
			<div class="col-sm-12 text-right">@{{errors['sale.customer.phone']}}</div>
		</div>
	</div>
</div>

				