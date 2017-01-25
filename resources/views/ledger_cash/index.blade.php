<template id="ledgercash">
<div class="invoice">
	<ul class="nav nav-tabs clearfix">
		<li class="active">
			<a href="#" v-on:click.prevent="" class="text-center">
				<span class="glyphicon glyphicon-erase gi-2x"></span>
				<br/>@{{title}}
			</a>
		</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="search.start" placeholder="End Date" value="@{{NowDate()}}" class="form-control datepicker" data-provide="datepicker" data-date-format="yyyy/mm/dd">
		    </div>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="search.end" placeholder="Start Date" value="@{{NowDate()}}" class="form-control datepicker" data-provide="datepicker" data-date-format="yyyy/mm/dd">
		    </div>
	   	</li>
	</ul>
	<br/>
	<div class="row">
		<div class="col-sm-8"></div>
		<div class="col-sm-4">
			<table class="table table-bordered">
				<thead>
				  <tr>
					<th class="text-right">Total Debit</th>
					<th class="text-right">
						@{{totalDebit}}
					</th>
				  </tr>
				  <tr>
					<th class="text-right">Total Credit</th>
					<th class="text-right">
						@{{totalCredit}}
					</th>
				  </tr>
				</thead>
			</table>
		</div>
		<div class="col-sm-12">
			<table class="table table-bordered">
				<thead>
				  <tr>
				  	<th>Date #A/C</th>
					<th>Account Name</th>
					<th>Summery</th>
					<th class="text-right">Debit</th>
					<th class="text-right">Credit</th>
				  </tr>
				</thead>
				<tbody>
				  <tr v-for="data in datas | orderBy 'date' -1">
				  	<th>@{{data.date}} #@{{data.id}}</th>
					<th>@{{data.account.name}}</th>
					<th>@{{data.summery}}</th>
					<th class="text-right">
						<span v-if="data.type=='Debit'">
							@{{data.amount}}
						</span>
					</th>
					<th class="text-right">
						<span v-if="data.type=='Credit'">
							@{{data.amount}}
						</span>
					</th>
				  </tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
</template>

