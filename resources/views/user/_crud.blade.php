<table class="table table-bordered table-hover">
	<thead>
	  <tr>
	  	<th>A/C</th>
	  	<th>Employe Id</th>
		<th>Name</th>
		<th>Designation</th>
		<th>Address</th>
		<th>Email</th>
		<th>Roll</th>
	  </tr>
	</thead>
	<tbody>
	  <tr v-for="user in users | filterBy search.name in 'name'" v-on:click="Select(user.id),element=user" :class="select.indexOf(user.id)!=-1?'active':''">
	  	<th>
	  		<span :class="select.indexOf(user.id)!=-1?'':'hidden'">
	  			<i class="glyphicon glyphicon-check"></i>
	  		</span>
	  		<span :class="select.indexOf(user.id)!=-1?'hidden':''">
	  			<i class="glyphicon glyphicon-unchecked"></i>
	  		</span>
	  		&nbsp; # @{{user.id}}
	  	</th>
	  	<th>@{{user.empid}}</th>
		<th>@{{user.name}}</th>
		<th>@{{user.designation}}</th>
		<th>@{{user.address}}</th>
		<th>@{{user.email}}</th>
		<th>@{{user.roll}}</th>
	  </tr>
	</tbody>
</table>