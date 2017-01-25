<template id="report">
<div class="invoice">
<div v-if="state=='T/B'">
	<ul class="nav nav-tabs clearfix">
		<li class="active">
			<a href="#" v-on:click.prevent="" class="text-center">
				<span class="glyphicon glyphicon-erase gi-2x"></span>
				<br/>Trial Balance
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
					<th>Account Name</th>
					<th class="text-right">Debit</th>
					<th class="text-right">Credit</th>
				  </tr>
				</thead>
				<tbody>
					<tr>
						<th>Asset</th>
						<th class="text-right">@{{accCalc('Debit', 'assets')}}</th>
						<th class="text-right">@{{accCalc('Credit', 'assets')}}</th>
					</tr>
					<tr>
						<th>Capital</th>
						<th class="text-right">@{{accCalc('Debit', 'capitals')}}</th>
						<th class="text-right">@{{accCalc('Credit', 'capitals')}}</th>
					</tr>
					<tr>
						<th>Drawing</th>
						<th class="text-right">@{{accCalc('Debit', 'drawings')}}</th>
						<th class="text-right">@{{accCalc('Credit', 'drawings')}}</th>
					</tr>
					<tr>
						<th>Expense</th>
						<th class="text-right">@{{accCalc('Debit', 'expenses')}}</th>
						<th class="text-right">@{{accCalc('Credit', 'expenses')}}</th>
					</tr>
					<tr>
						<th>Liabality</th>
						<th class="text-right">@{{accCalc('Debit', 'loans')}}</th>
						<th class="text-right">@{{accCalc('Credit', 'loans')}}</th>
					</tr>
					<tr>
						<th>Invoice</th>
						<th class="text-right">@{{saleCalc('Debit', 'invoices')}}</th>
						<th class="text-right">@{{saleCalc('Credit', 'invoices')}}</th>
					</tr>
					<tr>
						<th>Sale</th>
						<th class="text-right">@{{saleCalc('Debit', 'sales')}}</th>
						<th class="text-right">@{{saleCalc('Credit', 'sales')}}</th>
					</tr>
					<tr>
						<th>Service</th>
						<th class="text-right">@{{saleCalc('Debit', 'services')}}</th>
						<th class="text-right">@{{saleCalc('Credit', 'services')}}</th>
					</tr>
					<tr>
						<th>Perchase</th>
						<th class="text-right">@{{saleCalc('Debit', 'perchases')}}</th>
						<th class="text-right">@{{saleCalc('Credit', 'perchases')}}</th>
					</tr>
					<tr>
						<th>Due Payment</th>
						<th class="text-right">@{{dueCalc('Debit', 'suppliers')}}</th>
						<th class="text-right">@{{dueCalc('Credit', 'suppliers')}}</th>
					</tr>
					<tr>
						<th>Due Collection</th>
						<th class="text-right">@{{dueCalc('Debit', 'customers')}}</th>
						<th class="text-right">@{{dueCalc('Credit', 'customers')}}</th>
					</tr>
					<tr>
						<th>Wages</th>
						<th class="text-right">@{{dueCalc('Debit', 'services')}}</th>
						<th class="text-right">@{{dueCalc('Credit', 'services')}}</th>
					</tr>
					<tr>
						<th>Due Wages</th>
						<th class="text-right">@{{dueCalc('Debit', 'employes')}}</th>
						<th class="text-right">@{{dueCalc('Credit', 'employes')}}</th>
					</tr>
					<tr>
						<th>Accounts Cash</th>
						<th class="text-right">@{{cashCalc('Debit')}}</th>
						<th class="text-right">@{{cashCalc('Credit')}}</th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div v-if="state=='I/S'">
	<ul class="nav nav-tabs clearfix">
		<li class="active">
			<a href="#" v-on:click.prevent="" class="text-center">
				<span class="glyphicon glyphicon-erase gi-2x"></span>
				<br/>Income Statement
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
		<div class="col-sm-12">
			<h3 class="text-center"><u>Income Statement</u></h3>
		</div>

		<div class="col-sm-12">
			<h4><u>Revenues</u></h4>
		</div>
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<th>Sold on Asset</th>
						<th class="text-right">@{{accCalc('Debit', 'assets')}}</th>
					</tr>
					<tr>
						<th>Sold by Invoices</th>
						<th class="text-right">@{{saleCalc('Credit', 'invoices')}}</th>
					</tr>
					<tr>
						<th>Sold on Sales</th>
						<th class="text-right">@{{saleCalc('Credit', 'sales')}}</th>
					</tr>
					<tr>
						<th>Services</th>
						<th class="text-right">@{{saleCalc('Credit', 'services')}}</th>
					</tr>
					<tr>
						<th class="text-right">Total Revenue</th>
						<th class="text-right">
							@{{TotalRevenue()}}
						</th>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-sm-4"></div>

		<div class="col-sm-12">
			<h4><u>Costs</u></h4>
		</div>
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<th>Perchases</th>
						<th class="text-right">@{{saleCalc('Debit', 'perchases')}}</th>
					</tr>
					<tr>
						<th class="text-right">Total Costs</th>
						<th class="text-right">
							@{{TotalCost()}}
						</th>
					</tr>
					<tr>
						<th class="text-right">Gross Profit/Loss</th>
						<th class="text-right">
							@{{TotalRevenue() - TotalCost()}}
						</th>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-sm-4"></div>

		<div class="col-sm-12">
			<h4><u>Expences</u></h4>
		</div>
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<th>Expences</th>
						<th class="text-right">@{{accCalc('Debit', 'expenses')}}</th>
					</tr>
					<tr>
						<th>Wages</th>
						<th class="text-right">@{{wagesCalc('Debit')}}</th>
					</tr>
					<tr>
						<th class="text-right">Total Costs</th>
						<th class="text-right">
							@{{TotalExpenses()}}
						</th>
					</tr>
					<tr>
						<th class="text-right">Net Profit/Loss</th>
						<th class="text-right">
							@{{TotalRevenue() - TotalCost() - TotalExpenses()}}
						</th>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-sm-4"></div>

		<div class="col-sm-12">
			<h2 class="text-center bg-success clearfix" v-if="(TotalRevenue()-TotalCost()-TotalExpenses())>=0"><br>Net Profit @{{TotalRevenue() - TotalCost() - TotalExpenses()}} Taka <hr></h2>
			<h2 class="text-center bg-danger clearfix" v-if="(TotalRevenue()-TotalCost()-TotalExpenses())<0"><br>Net Loss @{{-1*(TotalRevenue() - TotalCost() - TotalExpenses())}} Taka <hr></h2>
		</div>

	</div>
</div>
<div v-if="state=='B/S'">
	<ul class="nav nav-tabs clearfix">
		<li class="active">
			<a href="#" v-on:click.prevent="" class="text-center">
				<span class="glyphicon glyphicon-erase gi-2x"></span>
				<br/>Balance Sheet
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
		<div class="col-sm-12">
			<h3 class="text-center"><u>Balance Sheet</u></h3>
		</div>

		<div class="col-sm-12 text-center">
			<h4><u>Assets</u></h4>
		</div>
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<th>Closing Stock Value</th>
						<th class="text-right">@{{stockCalc()}}</th>
					</tr>
					<tr>
						<th>Accounts Total</th>
						<th class="text-right">@{{(cashCalc('Debit') - cashCalc('Credit'))}}</th>
					</tr>
					<tr>
						<th>Total Assets</th>
						<th class="text-right">@{{accCalc('Debit', 'assets') - accCalc('Credit', 'assets')}}</th>
					</tr>
					<tr>
						<th>A/R</th>
						<th class="text-right">@{{dueCalc('Debit', 'customers') - dueCalc('Credit', 'customers')}}</th>
					</tr>
					<tr>
						<th class="text-right">Total Assets</th>
						<th class="text-right">
							@{{TotalAssets()}}
						</th>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-sm-4"></div>

		<div class="col-sm-12 text-center">
			<h4><u>Liabality</u></h4>
		</div>
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<th>Loans</th>
						<th class="text-right">@{{(accCalc('Debit', 'loans') - accCalc('Credit', 'loans'))}}</th>
					</tr>
					<tr>
						<th>Expense</th>
						<th class="text-right">@{{accCalc('Debit', 'expenses')}}</th>
					</tr>
					<tr>
						<th>Wages</th>
						<th class="text-right">@{{dueCalc('Debit', 'services')}}</th>
					</tr>
					<tr>
						<th>A/P</th>
						<th class="text-right">@{{(dueCalc('Credit', 'suppliers') - dueCalc('Debit', 'suppliers'))}}</th>
					</tr>
					<tr>
						<th class="text-right">Total Liabality</th>
						<th class="text-right">
							@{{TotalLiabality()}}
						</th>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-sm-4"></div>

		<div class="col-sm-12 text-center">
			<h4><u>Owner's Equity &amp; total Liabality</u></h4>
		</div>
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<th>Capital</th>
						<th class="text-right">@{{accCalc('Credit', 'capitals')}}</th>
					</tr>
					<tr>
						<th>Revenue</th>
						<th class="text-right">@{{TotalRevenue()}}</th>
					</tr>
					<tr>
						<th>Drawing</th>
						<th class="text-right"> - @{{accCalc('Debit', 'drawings')}}</th>
					</tr>
					<tr>
						<th>Liabality</th>
						<th class="text-right"> - @{{TotalLiabality()}}</th>
					</tr>
					<tr>
						<th class="text-right">Total Equity</th>
						<th class="text-right">
							@{{TotalEquity()}}
						</th>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-sm-4"></div>

	</div>
</div>
</div>
</template>

