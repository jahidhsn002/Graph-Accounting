@extends('basic')

@section('content')
	
	<div v-if="page=='Dashboard'">
		@include('dashboard')
	</div>
	<div v-if="page=='invoice'">
		<invoice
			:users.sync="users"
			:customers.sync="customers"
			:products.sync="products"
			:invoices.sync="invoices"
			:loader.sync="loader"
			:chalans.sync="chalans"
			:payments.sync="payments"
			:accounts.sync="accounts"
		></invoice>
	</div>
	<div v-if="page=='perchase'">
		<perchase
			:users.sync="users"
			:suppliers.sync="suppliers"
			:products.sync="products"
			:perchases.sync="perchases"
			:accounts.sync="accounts"
			:loader.sync="loader"
			:payments.sync="payments"
		></perchase>
	</div> 
	<div v-if="page=='sales'">
		<sales
			:users.sync="users"
			:customers.sync="customers"
			:products.sync="products"
			:accounts.sync="accounts"
			:payments.sync="payments"
			:loader.sync="loader"
			:sales.sync="sales"
		></sales>
	</div>
	<div v-if="page=='chalan'">
		<chalan
			:customers.sync="customers"
			:products.sync="products"
			:chalans.sync="chalans"
			:loader.sync="loader"
		></chalan>
	</div>
	<div v-if="page=='offer'">
		<offer
			:loader.sync="loader"
			:customers.sync="customers"
			:products.sync="products"
			:offers.sync="offers"
		></offer>
	</div>
	<div v-if="page=='return'">
		<returns
			:customers.sync="customers"
			:suppliers.sync="suppliers"
			:products.sync="products"
			:accounts.sync="accounts"
			:payments.sync="payments"
			:loader.sync="loader"
			:returns.sync="returns"
		></returns>
	</div>

	<div v-if="page=='account'">
		<account
			:loader.sync="loader"
			:accounts.sync="accounts"
		></account>
	</div>
	<div v-if="page=='product'">
		<product
			:loader.sync="loader"
			:products.sync="products"
		></product>
	</div>
	<div v-if="page=='customer'">
		<customer
			:loader.sync="loader"
			:customers.sync="customers"
		></customer>
	</div>
	<div v-if="page=='supplier'">
		<supplier
			:loader.sync="loader"
			:suppliers.sync="suppliers"
		></supplier>
	</div>

	<div v-if="page=='report_invoice'">
		@include('report.invoice')
	</div>
	<div v-if="page=='report_sale'">
		@include('report.sale')
	</div>
	<div v-if="page=='report_perchase'">
		@include('report.perchase')
	</div>
	<div v-if="page=='report_stock'">
		@include('report.stock')
	</div>
	<div v-if="page=='report_account'">
		@include('report.payment')
	</div>

	<!-- AC CRUD -->
	<div v-if="page=='ac_owner'">
		<owner
			:owners.sync="owners"
			:loader.sync="loader"
		></owner>
	</div>
	<div v-if="page=='ac_assetaccount'">
		<assetaccount
			:assetaccounts.sync="assetaccounts"
			:loader.sync="loader"
		></assetaccount>
	</div>
	<div v-if="page=='ac_expenseaccount'">
		<expenseaccount
			:expenseaccounts.sync="expenseaccounts"
			:loader.sync="loader"
		></expenseaccount>
	</div>
	<div v-if="page=='ac_loanaccount'">
		<loanaccount
			:loanaccounts.sync="loanaccounts"
			:loader.sync="loader"
		></loanaccount>
	</div>

	<!-- AC Ledger -->
	<div v-if="page=='ac_asset'">
		<ledger
			:setdatas.sync="assets"
			:categories.sync="assetaccounts"
			:accounts.sync="accounts"
			:payments.sync="payments"
			db='assets'
			catdb='assetaccount'
			catdb_base='assetaccounts'
			state='Both'
			title='Asset'
			category_title='Asset Account'
			:loader.sync="loader"
		></ledger>
	</div>
	<div v-if="page=='ac_expense'">
		<ledger
			:setdatas.sync="expenses"
			:categories.sync="expenseaccounts"
			:accounts.sync="accounts"
			:payments.sync="payments"
			db='expenses'
			catdb='expenseaccount'
			catdb_base='expenseaccounts'
			state='Debit'
			title='Expense'
			category_title='Expense Account'
			:loader.sync="loader"
		></ledger>
	</div>
	<div v-if="page=='ac_liabality'">
		<ledger
			:setdatas.sync="loans"
			:categories.sync="loanaccounts"
			:accounts.sync="accounts"
			:payments.sync="payments"
			db='loans'
			catdb='loanaccount'
			catdb_base='loanaccounts'
			state='Both'
			title='Liabality'
			category_title='Loan Account'
			:loader.sync="loader"
		></ledger>
	</div>
	<div v-if="page=='ac_capital'">
		<ledger
			:setdatas.sync="capitals"
			:categories.sync="owners"
			:accounts.sync="accounts"
			:payments.sync="payments"
			db='capitals'
			catdb='owner'
			catdb_base='owners'
			state='Debit'
			title='Capital'
			category_title='Owner'
			:loader.sync="loader"
		></ledger>
	</div>
	<div v-if="page=='ac_drawing'">
		<ledger
			:setdatas.sync="drawings"
			:categories.sync="owners"
			:accounts.sync="accounts"
			:payments.sync="payments"
			db='drawings'
			catdb='owner'
			catdb_base='owners'
			state='Credit'
			title='Drawing'
			category_title='Owner'
			:loader.sync="loader"
		></ledger>
	</div>
	<div v-if="page=='ac_invoice'">
		<ledgerorder
			:setdatas.sync="invoices"
			:products.sync="products"
			db='invoices'
			catdb='customer'
			state='Credit'
			title='Invoice'
			meta="False"
			category_title='Customer'
			:loader.sync="loader"
		></ledgerorder>
	</div>
	<div v-if="page=='ac_service'">
		<ledgerorder
			:setdatas.sync="services"
			:products.sync="products"
			db='services'
			catdb='customer'
			state='Credit'
			title='Service'
			meta="True"
			category_title='Customer'
			:loader.sync="loader"
		></ledgerorder>
	</div>
	<div v-if="page=='ac_sales'">
		<ledgerorder
			:setdatas.sync="sales"
			:products.sync="products"
			db='sales'
			catdb='customer'
			state='Credit'
			title='Sale'
			meta="False"
			category_title='Customer'
			:loader.sync="loader"
		></ledgerorder>
	</div>
	<div v-if="page=='ac_perchase'">
		<ledgerorder
			:setdatas.sync="perchases"
			:products.sync="products"
			db='perchases'
			catdb='supplier'
			state='Debit'
			title='Perchase'
			meta="False"
			category_title='Supplier'
			:loader.sync="loader"
		></ledgerorder>
	</div>
	<div v-if="page=='ac_due_payment'">
		<ledgerdue
			:setdatas.sync="suppliers"
			title='Due Payment'
			category_title='Supplier'
			:loader.sync="loader"
		></ledgerdue>
	</div>
	<div v-if="page=='ac_due_collection'">
		<ledgerdue
			:setdatas.sync="customers"
			title='Due Collection'
			category_title='Customer'
			:loader.sync="loader"
		></ledgerdue>
	</div>
	<div v-if="page=='ac_wages'">
		<ledgerwages
			:setdatas.sync="wages"
			state='Debit'
			title='Wages'
			:loader.sync="loader"
		></ledgerwages>
	</div>
	<div v-if="page=='ac_due_wages'">
		<ledgerdue
			:setdatas.sync="employes"
			title='Due Wages'
			category_title='Employe'
			:loader.sync="loader"
		></ledgerdue>
	</div>
	<div v-if="page=='ac_cash'">
		<ledgercash
			:setdatas.sync="payments"
			state='Debit'
			title='Wages'
			:loader.sync="loader"
		></ledgercash>
	</div>

	<div v-if="page=='report_tb'">
		<report
			:assets.sync="assets"
			:capitals.sync="capitals"
			:drawings.sync="drawings"
			:expenses.sync="expenses"
			:loans.sync="loans"
			:invoices.sync="invoices"
			:services.sync="services"
			:perchases.sync="perchases"
			:sales.sync="sales"
			:suppliers.sync="suppliers"
			:customers.sync="customers"
			:wages.sync="wages"
			:employes.sync="employes"
			:payments.sync="payments"
			:products.sync="products"
			:state.sync='state'
			:loader.sync="loader"
		></report>
	</div>

	<div v-if="page=='hr_employe'">
		<employe
			:employes.sync="employes"
			:loader.sync="loader"
		></employe>
	</div>
	<div v-if="page=='hr_wages'">
		<wages
			:employes.sync="employes"
			:wages.sync="wages"
			:dbwages.sync="dbwages"
			:accounts.sync="accounts"
			:payments.sync="payments"
			:loader.sync="loader"
		></wages>
	</div>
	
	<div v-if="page=='service'">
		<service
			:customers.sync="customers"
			:products.sync="products"
			:services.sync="services"
			:accounts.sync="accounts"
			:payments.sync="payments"
			:estimates.sync="estimates"
			:loader.sync="loader"
		></service>
	</div>

	<div v-if="page=='set_users'">
		<users
			:users.sync="users"
			:loader.sync="loader"
		></users>
	</div>

@endsection

