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
	</ul>
	<table class="table table-bordered table-hover">
		<thead>
		  <tr>
		  	<th>Date # A/C</th>
		  	<th>Employe ID</th>
		  	<th>Name</th>
		  	<th>Designation &amp; Phone</th>
		  	<th>Issued Salary</th>
			<th>Due</th>
		  </tr>
		</thead>
		<tbody>
		  <tr v-for="data in employes | filterBy search.number in 'id'" v-on:click="Select(data.id)" >
		  	<th>
		  		<span :class="select.indexOf(data.id)!=-1?'':'hidden'">
		  			<i class="glyphicon glyphicon-check"></i>
		  		</span>
		  		<span :class="select.indexOf(data.id)!=-1?'hidden':''">
		  			<i class="glyphicon glyphicon-unchecked"></i>
		  		</span>
		  		&nbsp; @{{data.date}} #@{{data.id}}
		  	</th>
		  	<td>@{{data.empid}}</td>
			<td>@{{data.name}}</td>
			<td>
				@{{data.designation}}
				@{{data.phone}}
			</td>
			<td class="text-right">
				@{{( dueTotal(data.transections, 'Credit') ).toFixed(2)}}
			</td>
			<td class="text-right">
				@{{( dueTotal(data.transections, 'Credit') - dueTotal(data.transections, 'Debit') ).toFixed(2)}}
			</td>
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
				<input type="text" v-model="payment.date" data-provide="datepicker" class="form-control datepicker" value="@{{NowDate()}}" data-date-format="yyyy/mm/dd">
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
			<tr class="form-group" v-for="data in employes | filterBy id in 'id'">
				<td class="col-sm-2">
					@{{data.date}} # @{{data.empid}}
				</td>
				<td class="col-sm-5">
					@{{data.name}} <br/>
					@{{data.designation}}
				</td>
				<td class="col-sm-5">
					<input type="text" class="form-control" v-model="payment.invoices[id]" value="@{{( dueTotal(data.transections, 'Credit') - dueTotal(data.transections, 'Debit') ).toFixed(2)}}" number>
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