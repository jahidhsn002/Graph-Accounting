<table class="table table-bordered table-hover">
	<thead>
	  <tr>
	  	<th>A/C</th>
	  	<th>IBAN/UBN/POS</th>
		<th>Description</th>
		<th>Brand/Origin</th>
		<th>Current Stock</th>
		<th>Retail Price</th>
		<th>Sell Price</th>
	  </tr>
	</thead>
	<tbody>
	  <tr v-for="product in products | filterBy search.description in 'description' | filterBy search.brand in 'brand' | filterBy search.iban in 'iban'" v-on:click="Select(product.id, product)" :class="select.indexOf(product.id)!=-1?'active':''">
	  	<th>
	  		<span :class="select.indexOf(product.id)!=-1?'':'hidden'">
	  			<i class="glyphicon glyphicon-check"></i>
	  		</span>
	  		<span :class="select.indexOf(product.id)!=-1?'hidden':''">
	  			<i class="glyphicon glyphicon-unchecked"></i>
	  		</span>
	  		&nbsp; # @{{product.id}}
	  	</th>
	  	<th>@{{product.iban}}</th>
		<th>@{{product.description}}</th>
		<th>@{{product.brand}}</th>
		<th>@{{product.stock.qty}}@{{product.unit}}</th>
		<th>@{{product.buy}}</th>
		<th>@{{product.sell}}</th>
	  </tr>
	</tbody>
</table>