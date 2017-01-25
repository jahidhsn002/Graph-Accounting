<table class="table table-bordered table-hover">
	<thead>
	  <tr>
	  	<th>A/C</th>
	  	<th>Employe Id</th>
		<th>Name</th>
		<th>Designation</th>
		<th>Phone</th>
		<th>Joining Date</th>
		<th>Address</th>
		<th>Basic Salary</th>
		<th>Note</th>
	  </tr>
	</thead>
	<tbody>
	  <tr v-for="employe in employes | filterBy search.name in 'name'" v-on:click="Select(employe.id),element=employe" :class="select.indexOf(employe.id)!=-1?'active':''">
	  	<th>
	  		<span :class="select.indexOf(employe.id)!=-1?'':'hidden'">
	  			<i class="glyphicon glyphicon-check"></i>
	  		</span>
	  		<span :class="select.indexOf(employe.id)!=-1?'hidden':''">
	  			<i class="glyphicon glyphicon-unchecked"></i>
	  		</span>
	  		&nbsp; # @{{employe.id}}
	  	</th>
	  	<th>@{{employe.empid}}</th>
		<th>@{{employe.name}}</th>
		<th>@{{employe.designation}}</th>
		<th>@{{employe.phone}}</th>
		<th>@{{employe.joining}}</th>
		<th>@{{employe.address}}</th>
		<th>@{{employe.salary}}</th>
		<th>@{{employe.note}}</th>
	  </tr>
	</tbody>
</table>