<table class="table table-bordered table-hover">
	<thead>
	  <tr>
	  	<th>A/C</th>
		<th>Name</th>
		<th>Company</th>
		<th>Address</th>
		<th>Phone</th>
	  </tr>
	</thead>
	<tbody>
	  <tr v-for="supplier in suppliers | filterBy search.name in 'name' | filterBy search.company in 'company' | filterBy search.phone in 'phone'" v-on:click="Select(supplier.id, supplier)" :class="select.indexOf(supplier.id)!=-1?'active':''">
	  	<th>
	  		<span :class="select.indexOf(supplier.id)!=-1?'':'hidden'">
	  			<i class="glyphicon glyphicon-check"></i>
	  		</span>
	  		<span :class="select.indexOf(supplier.id)!=-1?'hidden':''">
	  			<i class="glyphicon glyphicon-unchecked"></i>
	  		</span>
	  		&nbsp; # @{{supplier.id}}
	  	</th>
		<th>@{{supplier.name}}</th>
		<th>@{{supplier.company}}</th>
		<th>@{{supplier.address}}</th>
		<th>@{{supplier.phone}}</th>
	  </tr>
	</tbody>
</table>