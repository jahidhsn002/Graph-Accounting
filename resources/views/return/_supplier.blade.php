
<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#billing">Return From</a></li>
</ul>

<div class="tab-content clearfix page_content">
	<div id="billing" class="tab-pane fade in active">
		<div :class="errors['breturn.supplier.name']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Supplier:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="breturn.supplier.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="supplier in suppliers | filterBy breturn.supplier.name in 'name'">
			            <a href="#" v-on:click.prevent="setSupplier(supplier)">
			              <span class="text">@{{supplier.name}}<small class="muted text-muted">@{{supplier.phone}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['breturn.supplier.name']}}</div>
		</div>
		<div :class="errors['breturn.supplier.address']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Address:</label>
			<div class="col-sm-8 input-group">
				<textarea v-model="breturn.supplier.address" value="" class="form-control"></textarea>
			</div>
			<div class="col-sm-12 text-right">@{{errors['breturn.supplier.address']}}</div>
		</div>
		<div :class="errors['breturn.supplier.phone']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Phone No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="breturn.supplier.phone" value="" type="text" class="form-control">
			</div>
			<div class="col-sm-12 text-right">@{{errors['breturn.supplier.phone']}}</div>
		</div>
	</div>
</div>

				