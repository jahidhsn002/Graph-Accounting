
<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#billing">Billing</a></li>
</ul>

<div class="tab-content clearfix page_content">
	<div id="billing" class="tab-pane fade in active">
		<div :class="errors['perchase.supplier.name']?'form-group has-error':'form-group'">
			<label class="col-sm-4">supplier:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="perchase.supplier.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="supplier in suppliers | filterBy perchase.supplier.name in 'name'">
			            <a href="#" v-on:click.prevent="setsupplier(supplier)">
			              <span class="text">@{{supplier.name}} | <small class="muted text-muted">@{{supplier.phone}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['perchase.supplier.name']}}</div>
		</div>
		<div :class="errors['perchase.supplier.company']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Company:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="perchase.supplier.company" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="supplier in suppliers | filterBy perchase.supplier.company in 'company'">
			            <a href="#" v-on:click.prevent="setsupplier(supplier)">
			              <span class="text">@{{supplier.company}} | <small class="muted text-muted">@{{supplier.name}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['perchase.supplier.company']}}</div>
		</div>
		<div :class="errors['perchase.supplier.address']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Address:</label>
			<div class="col-sm-8 input-group">
				<textarea v-model="perchase.supplier.address" value="" class="form-control"></textarea>
			</div>
			<div class="col-sm-12 text-right">@{{errors['perchase.supplier.address']}}</div>
		</div>
		<div :class="errors['perchase.supplier.phone']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Phone No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="perchase.supplier.phone" value="" type="text" class="form-control">
			</div>
			<div class="col-sm-12 text-right">@{{errors['perchase.supplier.phone']}}</div>
		</div>
	</div>
</div>
		

