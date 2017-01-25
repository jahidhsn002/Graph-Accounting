<!-- Modal -->
<div id="Payment" class="modal" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-right">
        <h4 class="modal-title">@{{title}} Manager</h4>
      </div>
	  <div class="modal-body row">
		<div class="form-group col-sm-12" v-if="state=='Both'">
			<label class="col-sm-6">@{{title}} State</label>
			<div class="col-sm-6 input-group">
				<select v-model="element.type" class="form-control">
					<option selected>Debit</option>
					<option>Credit</option>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="col-sm-6">Date</label>
			<div class="col-sm-6 input-group">
				<input type="text" v-model="element.date" data-provide="datepicker" class="form-control datepicker" data-date-format="yyyy/mm/dd">
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="col-sm-6">Account Name:</label>
			<div class="btn-group bootstrap-select col-sm-6" v-if="!element.account.id">
			  	<input type="text" v-model="element.account.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="account in accounts | filterBy element.account.name in 'name'">
			            <a href="#" v-on:click.prevent="setAccount(account)">
			              <span class="text">@{{account.name}} | <small class="muted text-muted">@{{account.ac}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="btn-group bootstrap-select col-sm-6" v-if="element.account.id">
			  	@{{element.account.name}}
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="col-sm-6">Account A/C:</label>
			<div class="btn-group bootstrap-select col-sm-6">
			  	@{{element.account.ac}}
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="col-sm-6">@{{category_title}}:</label>
			<div class="btn-group bootstrap-select col-sm-6">
			  	<input type="text" v-model="element.category.name" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="category in categories | filterBy element.category.name in 'name'">
			            <a href="#" v-on:click.prevent="setCategory(category)">
			              <span class="text">@{{category.name}}</span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="col-sm-6">Amount:</label>
			<div class="btn-group bootstrap-select col-sm-6">
			  	<input type="number" v-model="element.amount" class="form-control" number>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="col-sm-6">Note:</label>
			<div class="btn-group bootstrap-select col-sm-6">
			  	<textarea v-model="element.note" class="form-control">
			  	</textarea>
			</div>
		</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-warning" v-if="element.account.id" v-on:click="element.account={},element.category={}">Clear Selected</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button class="btn btn-success" v-if="element.account.id" v-on:click.prevent="recordPayment">Record Payment</button>
      </div>
    </div>

  </div>
</div>