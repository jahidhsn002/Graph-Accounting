
<div class="invoice">
	<ul class="nav nav-tabs clearfix">
		<li class="active">
	   		<a href="#" v-on:click.prevent="" class="text-center">
	   			<span class="glyphicon glyphicon-erase gi-2x"></span>
	   			<br/>Accounts
	   		</a>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="date.start" placeholder="End Date" class="form-control datepicker" data-provide="datepicker" data-date-format="dd/mm/yyyy">
		    </div>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="date.end" placeholder="Start Date" class="form-control datepicker" data-provide="datepicker" data-date-format="dd/mm/yyyy">
		    </div>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="search.ac" placeholder="Account" class="form-control">
		    </div>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="search.name" placeholder="Name" class="form-control">
		    </div>
	   	</li>
	</ul>
	<br/>
	<div class="row">
		<div class="col-sm-6"></div>
		<div class="col-sm-6">
			<table class="table table-bordered">
				<thead>
				  <tr>
				  	<th class="text-right">Account</th>
				  	<th class="text-right">Name</th>
					<th class="text-right">Debit</th>
					<th class="text-right">Credit</th>
					<th class="text-right">Balance</th>
				  </tr>
				  <tr v-for="account in accounts">
					<td class="text-right">@{{account.ac}}</td>
				  	<td class="text-right">@{{account.name}}</td>
					<td class="text-right">@{{accountDebit(account.payments)}}</td>
					<td class="text-right">@{{accountCredit(account.payments)}}</td>
					<td class="text-right">@{{accountTotal(account.payments)}}</td>
				  </tr>
				</thead>
			</table>
		</div>
	</div>
	<table class="table table-bordered">
		<thead>
		  <tr>
		  	<th>#A/C</th>
		  	<th>Date</th>
		  	<th>Account</th>
			<th>Name</th>
			<th>Summery</th>
			<th>Debit</th>
			<th>Credit</th>
		  </tr>
		</thead>
		<tbody>
		  <tr
		  	v-for="payment in payments | filterBy search.ac in 'account' in 'ac' | filterBy search.name in 'account' in 'name'"
		  >
		  	<th>#@{{payment.id}}</th>
		  	<th>@{{payment.date}}</th>
		  	<th>@{{payment.account.ac}}</th>
			<th>@{{payment.account.name}}</th>
			<th>@{{payment.summery}}</th>
			<th class="text-right">
				<span v-if="payment.type=='Debit'">@{{payment.amount}}</span>
			</th>
			<th class="text-right">
				<span v-if="payment.type=='Credit'">@{{payment.amount}}</span>
			</th>
		  </tr>
		</tbody>
	</table>
</div>

