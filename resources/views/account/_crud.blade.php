<table class="table table-bordered table-hover">
	<thead>
	  <tr>
	  	<th>A/C</th>
		<th>Name</th>
	  </tr>
	</thead>
	<tbody>
	  <tr v-for="account in accounts | filterBy search.name in 'name' | filterBy search.ac in 'ac'" v-on:click="Select(account.id, account)" :class="select.indexOf(account.id)!=-1?'active':''">
	  	<th>
	  		<span :class="select.indexOf(account.id)!=-1?'':'hidden'">
	  			<i class="glyphicon glyphicon-check"></i>
	  		</span>
	  		<span :class="select.indexOf(account.id)!=-1?'hidden':''">
	  			<i class="glyphicon glyphicon-unchecked"></i>
	  		</span>
	  		&nbsp; #@{{account.ac}}
	  	</th>
		<th>@{{account.name}}</th>
	  </tr>
	</tbody>
</table>