<div class="base clearfix">
  <div style="max-width:200px;margin:auto;"><br/><img src="assets/images/logo.jpg" width="100%"></div>
  <h5 v-if="user.roll=='Accountant'||user.roll=='Admin'" class="text-center">Accounting</h5><hr/>
  <ul v-if="user.roll=='Accountant'||user.roll=='Admin'" class="nav nav-pills nav-stacked" role="tablist">
    <li :class="page=='ac_owner'?'active':''">
      <a href="#" class="text-right" v-on:click.prevent="page='ac_owner'">Owner Account</a>
    </li>
    <li :class="page=='ac_assetaccount'?'active':''">
      <a href="#" class="text-right" v-on:click.prevent="page='ac_assetaccount'">Asset Account</a>
    </li>
    <li :class="page=='ac_expenseaccount'?'active':''">
      <a href="#" class="text-right" v-on:click.prevent="page='ac_expenseaccount'">Expense Account</a>
    </li>
    <li :class="page=='ac_loanaccount'?'active':''">
      <a href="#" class="text-right" v-on:click.prevent="page='ac_loanaccount'">Loan Account</a>
    </li>
  </ul>
  <h5 v-if="user.roll=='Owner'||user.roll=='Admin'" class="text-center">HRM</h5><hr/>
  <ul v-if="user.roll=='Owner'||user.roll=='Admin'" class="nav nav-pills nav-stacked" role="tablist">
    <li :class="page=='hr_employe'?'active':''">
      <a href="#" class="text-right" v-on:click.prevent="page='hr_employe'">Company Employes</a>
    </li>
    <li :class="page=='hr_wages'?'active':''">
      <a href="#" class="text-right" v-on:click.prevent="page='hr_wages'">Wages Sheet</a>
    </li>
    <li :class="page=='set_users'?'active':''">
      <a href="#" class="text-right" v-on:click.prevent="page='set_users'">Users</a>
    </li>
  </ul>
  <br/>
  <ul class="nav nav-pills nav-stacked" role="tablist">
    <li :class="page=='Dashboard'?'active':''">
      <a href="#" class="text-right" v-on:click.prevent="page='Dashboard'">Dashboard</a>
    </li>
    <li :class="page=='Logout'?'active':''">
      <a href="#" class="text-right" v-on:click.prevent="Logout">Logout</a>
    </li>
  </ul>
</div>