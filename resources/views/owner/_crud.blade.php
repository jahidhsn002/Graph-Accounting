<table class="table table-bordered table-hover">
	<thead>
	  <tr>
	  	<th>A/C</th>
		<th>Name</th>
		<th>Address</th>
	  </tr>
	</thead>
	<tbody>
	  <tr v-for="owner in owners | filterBy search.name in 'name'" v-on:click="Select(owner.id),element=owner" :class="select.indexOf(owner.id)!=-1?'active':''">
	  	<th>
	  		<span :class="select.indexOf(owner.id)!=-1?'':'hidden'">
	  			<i class="glyphicon glyphicon-check"></i>
	  		</span>
	  		<span :class="select.indexOf(owner.id)!=-1?'hidden':''">
	  			<i class="glyphicon glyphicon-unchecked"></i>
	  		</span>
	  		&nbsp; # @{{owner.id}}
	  	</th>
		<th>@{{owner.name}}</th>
		<th>@{{owner.address}}</th>
	  </tr>
	</tbody>
</table>