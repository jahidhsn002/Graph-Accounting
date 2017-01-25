<div class="base clearfix">
  <h5 v-if="user.roll=='Accountant'||user.roll=='Admin'" class="text-center">Reports</h5><hr/>
  <ul class="nav nav-pills nav-stacked" role="tablist">
    <li v-if="user.roll=='Accountant'||user.roll=='Admin'" :class="page=='report_tb'&&state=='T/B'?'active':''">
      <a href="#" v-on:click.prevent="page='report_tb',state='T/B'">Trial Balance</a>
    </li>
    <li v-if="user.roll=='Accountant'||user.roll=='Admin'" :class="page=='report_tb'&&state=='I/S'?'active':''">
      <a href="#" v-on:click.prevent="page='report_tb',state='I/S'">Income Statement</a>
    </li>
    <li v-if="user.roll=='Accountant'||user.roll=='Admin'" :class="page=='report_tb'&&state=='B/S'?'active':''">
      <a href="#" v-on:click.prevent="page='report_tb',state='B/S'">Balance Sheet</a>
    </li>
    <li v-if="user.roll=='Accountant'||user.roll=='Admin'" :class="page=='report_account'?'active':''">
      <a href="#" v-on:click.prevent="page='report_account'">Accounts</a>
    </li>
    <li v-if="user.roll=='Accountant'||user.roll=='Admin'||user.roll=='Stock'" :class="page=='report_stock'?'active':''">
      <a href="#" v-on:click.prevent="page='report_stock'">Stock</a>
    </li>
  </ul>
  <h5 v-if="user.roll=='Accountant'||user.roll=='Admin'" class="text-center">Ledger</h5><hr/>
  <ul v-if="user.roll=='Accountant'||user.roll=='Admin'" class="nav nav-pills nav-stacked" role="tablist">
    <li :class="page=='ac_asset'?'active':''">
      <a href="#" v-on:click.prevent="page='ac_asset'">Asset</a>
    </li>
    <li :class="page=='ac_capital'?'active':''">
      <a href="#" v-on:click.prevent="page='ac_capital'">Capital</a>
    </li>
    <li :class="page=='ac_drawing'?'active':''">
      <a href="#" v-on:click.prevent="page='ac_drawing'">Drawing</a>
    </li>
    <li :class="page=='ac_expense'?'active':''">
      <a href="#" v-on:click.prevent="page='ac_expense'">Expense</a>
    </li>
    <li :class="page=='ac_liabality'?'active':''">
      <a href="#" v-on:click.prevent="page='ac_liabality'">Liabality</a>
    </li>
    <li :class="page=='ac_invoice'?'active':''">
      <a href="#" v-on:click.prevent="page='ac_invoice'">Invoice</a>
    </li>
    <li :class="page=='ac_sales'?'active':''">
      <a href="#" v-on:click.prevent="page='ac_sales'">Sales</a>
    </li>
    <li :class="page=='ac_perchase'?'active':''">
      <a href="#" v-on:click.prevent="page='ac_perchase'">Purchase</a>
    </li>
    <li :class="page=='ac_service'?'active':''">
      <a href="#" v-on:click.prevent="page='ac_service'">Service</a>
    </li>
    <li :class="page=='ac_due_payment'?'active':''">
      <a href="#" v-on:click.prevent="page='ac_due_payment'">Due Payment</a>
    </li>
    <li :class="page=='ac_due_collection'?'active':''">
      <a href="#" v-on:click.prevent="page='ac_due_collection'">Due Collection</a>
    </li>
    <li :class="page=='ac_wages'?'active':''">
      <a href="#" v-on:click.prevent="page='ac_wages'">Wages</a>
    </li>
    <li :class="page=='ac_due_wages'?'active':''">
      <a href="#" v-on:click.prevent="page='ac_due_wages'">Due Wages</a>
    </li>
    <li :class="page=='ac_cash'?'active':''">
      <a href="#" v-on:click.prevent="page='ac_cash'">Cash Flow</a>
    </li>
    
  </ul>
</div>