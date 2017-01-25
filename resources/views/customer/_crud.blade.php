<table class="table table-bordered table-hover">
	<thead>
	  <tr>
	  	<th>A/C</th>
		<th>Name</th>
		<th>Company</th>
		<th>Billing Address</th>
		<th>Shipping Address</th>
		<th>Phone</th>
	  </tr>
	</thead>
	<tbody>
	  <tr v-for="customer in customers | filterBy search.name in 'name' | filterBy search.company in 'company' | filterBy search.phone in 'phone' " v-on:click="Select(customer.id, customer)" :class="select.indexOf(customer.id)!=-1?'active':''">
	  	<th>
	  		<span :class="select.indexOf(customer.id)!=-1?'':'hidden'">
	  			<i class="glyphicon glyphicon-check"></i>
	  		</span>
	  		<span :class="select.indexOf(customer.id)!=-1?'hidden':''">
	  			<i class="glyphicon glyphicon-unchecked"></i>
	  		</span>
	  		&nbsp; # @{{customer.id}}
	  	</th>
		<th>@{{customer.name}}</th>
		<th>@{{customer.company}}</th>
		<th>@{{customer.billing}}</th>
		<th>@{{customer.shipping}}</th>
		<th>@{{customer.phone}}</th>
	  </tr>
	</tbody>
</table>