<table class="table table-bordered table-hover">
	<thead>
	  <tr>
	  	<th>A/C</th>
		<th>Name</th>
	  </tr>
	</thead>
	<tbody>
	  <tr v-for="assetaccount in assetaccounts | filterBy search.name in 'name'" v-on:click="Select(assetaccount.id),element=assetaccount" :class="select.indexOf(assetaccount.id)!=-1?'active':''">
	  	<th>
	  		<span :class="select.indexOf(assetaccount.id)!=-1?'':'hidden'">
	  			<i class="glyphicon glyphicon-check"></i>
	  		</span>
	  		<span :class="select.indexOf(assetaccount.id)!=-1?'hidden':''">
	  			<i class="glyphicon glyphicon-unchecked"></i>
	  		</span>
	  		&nbsp; # @{{assetaccount.id}}
	  	</th>
		<th>@{{assetaccount.name}}</th>
	  </tr>
	</tbody>
</table>