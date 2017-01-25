<table class="table table-bordered table-hover">
	<thead>
	  <tr>
	  	<th>A/C</th>
		<th>Name</th>
	  </tr>
	</thead>
	<tbody>
	  <tr v-for="loanaccount in loanaccounts | filterBy search.name in 'name'" v-on:click="Select(loanaccount.id),element=loanaccount" :class="select.indexOf(loanaccount.id)!=-1?'active':''">
	  	<th>
	  		<span :class="select.indexOf(loanaccount.id)!=-1?'':'hidden'">
	  			<i class="glyphicon glyphicon-check"></i>
	  		</span>
	  		<span :class="select.indexOf(loanaccount.id)!=-1?'hidden':''">
	  			<i class="glyphicon glyphicon-unchecked"></i>
	  		</span>
	  		&nbsp; # @{{loanaccount.id}}
	  	</th>
		<th>@{{loanaccount.name}}</th>
	  </tr>
	</tbody>
</table>