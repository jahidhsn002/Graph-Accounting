<div class="invoice">
	<ul class="nav nav-tabs clearfix">
	   	<li class="pull-right">
		    <div class="btn-group">
              <button v-show="select.length!=0" data-toggle="modal" data-target="#Payment" class="btn btn-success">Pay</button>
			</div>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="search.date" placeholder="Date" class="form-control datepicker" data-provide="datepicker" data-date-format="yyyy/mm/dd">
		    </div>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="search.number" class="form-control" placeholder="No.">
		    </div>
	   	</li>
        <li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="search.suppliername" class="form-control" placeholder="Supplier Name">
		    </div>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="search.suppliercompany" class="form-control" placeholder="Supplier Company">
		    </div>
	   	</li>
	</ul>
	<table class="table table-bordered table-hover">
		<thead>
		  <tr>
		  	<th>Date # A/C</th>
		  	<th>Company</th>
		  	<th>supplier Name</th>
		  	<th>Phone</th>
			<th>Due</th>
		  </tr>
		</thead>
		<tbody>
		  <tr v-for="supplier in suppliers | filterBy search.suppliername in 'supplier' in 'name' | filterBy search.suppliername in 'supplier' in 'company'" v-on:click="Select(supplier.id)" v-if="dueTotal(supplier.transections, 'Credit').toFixed(2)!=dueTotal(supplier.transections, 'Debit').toFixed(2)">
		  	<th>
		  		<span :class="select.indexOf(supplier.id)!=-1?'':'hidden'">
		  			<i class="glyphicon glyphicon-check"></i>
		  		</span>
		  		<span :class="select.indexOf(supplier.id)!=-1?'hidden':''">
		  			<i class="glyphicon glyphicon-unchecked"></i>
		  		</span>
		  		&nbsp; #@{{supplier.id}}
		  	</th>
		  	<th>@{{supplier.company}}</th>
			<th>@{{supplier.name}}</th>
			<th>@{{supplier.phone}}</th>
			<th>@{{(dueTotal(supplier.transections, 'Credit') - dueTotal(supplier.transections, 'Debit')).toFixed(2)}}</th>
		  </tr>
		</tbody>
	</table>
</div>

<!-- Modal -->
<div id="Payment" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-right">
        <h4 class="modal-title">Modal Header</h4>
      </div>
	  <div class="modal-body row">
		<div class="form-group col-sm-12 text-right">
			<label class="col-sm-8"></label>
			<div class="col-sm-4 input-group">
				<label>Payment Date</label>
				<input type="text" v-model="payment.date" data-provide="datepicker" value="@{{NowDate()}}" data-date-format="yyyy/mm/dd" class="form-control datepicker">
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="col-sm-4">Account Name:</label>
			<div class="btn-group bootstrap-select col-sm-8" v-if="!payment.account.id">
			  	<input type="text" v-model="payment.account.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="account in accounts | filterBy payment.account.name in 'name'">
			            <a href="#" v-on:click.prevent="setAccount(account)">
			              <span class="text">@{{account.name}} | <small class="muted text-muted">@{{account.ac}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="btn-group bootstrap-select col-sm-8" v-if="payment.account.id">
			  	@{{payment.account.name}}
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="col-sm-4">Account A/C:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  	@{{payment.account.ac}}
			</div>
		</div>
		<table class="col-sm-12 table-bordered" v-for="id in select">
			<tr class="form-group" v-for="supplier in suppliers" v-if="supplier.id==id">
				<td class="col-sm-2">
					@{{supplier.company}}
				</td>
				<td class="col-sm-5">
					@{{supplier.name}} <br/>
					@{{supplier.phone}}
				</td>
				<td class="col-sm-5">
					<input type="text" class="form-control" v-model="payment.suppliers[id]" value="@{{(dueTotal(supplier.transections, 'Credit') - dueTotal(supplier.transections, 'Debit')).toFixed(2)}}" number>
				</td>
			</tr>
		</table>
		<p class="col-sm-12"></p>
		<table class="col-sm-12 table-bordered">
			<thead>
				<tr class="form-group">
					<th colspan="2" class="col-sm-12 text-right">Total: @{{TotalPayment}}/-</th>
				</tr>
			</thead>
		</table>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-warning" v-if="payment.account.id" v-on:click="payment.account={}">Another Account</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button class="btn btn-success" v-if="payment.account.id" v-on:click.prevent="recordPayment">Record Payment</button>
      </div>
    </div>

  </div>
</div>