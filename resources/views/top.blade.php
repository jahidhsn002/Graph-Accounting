<nav class="navbar navbar-default np">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li v-if="user.roll=='Sales'||user.roll=='Admin'" :class="page=='offer'?'active':''">
        <a href="#" v-on:click.prevent="page='offer'">Offer</a>
      </li>
      <li v-if="user.roll=='Sales'||user.roll=='Admin'" :class="page=='chalan'?'active':''">
        <a href="#" v-on:click.prevent="page='chalan'">Challan</a>
      </li>
      <li v-if="user.roll=='Sales'||user.roll=='Admin'" :class="page=='invoice'?'active':''">
        <a href="#" v-on:click.prevent="page='invoice'">Invoice</a>
      </li>
      <li v-if="user.roll=='Sales'||user.roll=='Admin'" :class="page=='sales'?'active':''">
        <a href="#" v-on:click.prevent="page='sales'">Sales</a>
      </li>
      <li v-if="user.roll=='Purchase'||user.roll=='Admin'" :class="page=='perchase'?'active':''">
        <a href="#" v-on:click.prevent="page='perchase'">Purchase</a>
      </li>
      <li v-if="user.roll=='Purchase'||user.roll=='Admin'" :class="page=='return'?'active':''">
        <a href="#" v-on:click.prevent="page='return'">Return</a>
      </li>
      <li v-if="user.roll=='Sales'||user.roll=='Admin'" :class="page=='service'?'active':''">
        <a href="#" v-on:click.prevent="page='service'">Service</a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li v-if="user.roll=='Sales'||user.roll=='Admin'" :class="page=='customer'?'active':''">
        <a href="#" v-on:click.prevent="page='customer'">Customer</a>
      </li>
      <li v-if="user.roll=='Purchase'||user.roll=='Admin'" :class="page=='supplier'?'active':''">
        <a href="#" v-on:click.prevent="page='supplier'">Supplier</a>
      </li>
      <li v-if="user.roll=='Purchase'||user.roll=='Sales'||user.roll=='Admin'" :class="page=='product'?'active':''">
        <a href="#" v-on:click.prevent="page='product'">Product</a>
      </li>
      <li v-if="user.roll=='Accountant'||user.roll=='Admin'" :class="page=='account'?'active':''">
        <a href="#" v-on:click.prevent="page='account'">Accounts</a>
      </li>
    </ul>
  </div>
</nav>  