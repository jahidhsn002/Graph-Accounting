


<table class="table table-bordered">
	<thead>
	  <tr>
	  	<th v-if="sale.conditions.length<=0"><i class="glyphicon glyphicon-trash"></i></th>
		<th>Description</th>
		<th>Brand/Origin</th>
		<th class="text-center">Qty</th>
		<th class="text-center">Unit Price</th>
		<th class="text-right">Discount</th>
		<th class="text-right">Total</th>
	  </tr>
	</thead>
	<tbody>
	  <tr v-for="(point, item) in sale.items">
	  	<td v-if="sale.conditions.length<=0">
	  		<button class="btn btn-danger btn-sm " v-on:click.prevent="sale.items.splice(point,1)"><i class="glyphicon glyphicon-trash"></i></button>
	  	</td>
		<td>
			<div :class="errors['sale.items.'+ point +'.description']?'has-error btn-group bootstrap-select':'btn-group bootstrap-select'">
				<input type="text" v-model="item.description" class="form-control" data-toggle="dropdown">
				<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="dbproduct in products | filterBy item.description in 'description'">
			            <a href="#" v-on:click.prevent="addItem(point, sale.items[point].qty, sale.items[point].discount, dbproduct)">
			              <span class="text">@{{dbproduct.description}}<small class="muted text-muted">@{{dbproduct.brand}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
		</td>
		<td><input type="text" class="form-control" v-model="item.brand"></td>
		<td class="text-right">
			<div class="input-group">
				<input type="number" class="form-control" step="any" v-model="item.qty" number>
				<span class="input-group-addon"><i class="fa fa-ticket" aria-hidden="true"></i></span>
				<input type="text" class="form-control" v-model="item.unit">
			</div>
		</td>
		<td>
			<input type="number" class="form-control" step="any" v-model="item.sell" number>
		</td>
		<td>
			<div class="input-group">
				<input type="number" class="form-control" step="any" v-model="item.discount" number>
				<span class="input-group-addon">%</span>
			</div>
		</td>
		<td class="text-right">@{{( (item.qty * item.sell) - ((item.discount * item.qty * item.sell) / 100 ) ).toFixed(2)}}</td>
	  </tr>
	  <tr v-if="sale.conditions.length<=0">
		<td colspan="7"><button class="btn btn-default btn-block" v-on:click.prevent="setItem">Add Product</button></td>
	  </tr>
	</tbody>
</table>
