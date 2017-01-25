


<table class="table table-bordered">
	<thead>
	  <tr>
	  	<th><i class="glyphicon glyphicon-trash"></i></th>
		<th>Description</th>
		<th>Brand/Origin</th>
		<th>Qty</th>
	  </tr>
	</thead>
	<tbody>
	  <tr v-for="(point, item) in chalan.items">
	  	<td>
	  		<button class="btn btn-danger btn-sm " v-on:click.prevent="chalan.items.splice(point,1)"><i class="glyphicon glyphicon-trash"></i></button>
	  	</td>
		<td>
			<div class="btn-group bootstrap-select">
				<input type="text" v-model="item.description" class="form-control" data-toggle="dropdown">
				<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="dbproduct in products | filterBy item.description in 'description'">
			            <a href="#" v-on:click.prevent="addItem(point, chalan.items[point].qty, 0, dbproduct)">
			              <span class="text">@{{dbproduct.description}}<small class="muted text-muted">@{{dbproduct.brand}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
		</td>
		<td><input type="text" class="form-control" v-model="item.brand"></td>
		<td>
			<div class="input-group">
				<input type="number" class="form-control" step="any" v-model="item.qty" number>
				<span class="input-group-addon"><i class="fa fa-ticket" aria-hidden="true"></i></span>
				<input type="text" class="form-control" v-model="item.unit">
			</div>
		</td>
	  </tr>
	  <tr>
		<td colspan="6"><button class="btn btn-default btn-block" v-on:click.prevent="setItem">Add Product</button></td>
	  </tr>
	</tbody>
</table>
