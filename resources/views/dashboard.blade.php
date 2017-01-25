<div class="dashboard">
  <div style="max-width:200px;margin:auto;"><img src="assets/images/logo.jpg" width="100%"></div>
  <ul class="nav nav-pills nav-stacked row" role="tablist">
    <li v-if="user.roll=='Sales'||user.roll=='Admin'" :class="page=='offer'?'active col-sm-4':' col-sm-4'">
      <a href="#" v-on:click.prevent="page='offer'">Sales</a>
    </li>
    <li v-if="user.roll=='Purchase'||user.roll=='Admin'" :class="page=='perchase'?'active col-sm-4':' col-sm-4'">
      <a href="#" v-on:click.prevent="page='perchase'">Purchase</a>
    </li>
    <li v-if="user.roll=='Stock'||user.roll=='Admin'" :class="page=='perchase'?'active col-sm-4':' col-sm-4'">
      <a href="#" v-on:click.prevent="page='report_stock'">Stock Report</a>
    </li>
    <li v-if="user.roll=='Accountent'||user.roll=='Admin'" :class="page=='ac_asset'?'active col-sm-4':' col-sm-4'">
      <a href="#" v-on:click.prevent="page='ac_asset'">Accounting</a>
    </li>
    <li v-if="user.roll=='Owner'||user.roll=='Admin'" :class="page=='hr_employe'?'active col-sm-4':' col-sm-4'">
      <a href="#" class="text-right" v-on:click.prevent="page='hr_employe'">HRM</a>
    </li>
  </ul>
</div>