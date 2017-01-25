<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#sale">Salse</a></li>
</ul>

<div class="tab-content clearfix page_content">
	<div id="sale" class="tab-pane fade in active">
		<div :class="errors['sale.date']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Date:</label>
			<div class="col-sm-8 input-group">
				<input type="text" v-model="sale.date" data-provide="datepicker" value="@{{NowDate()}}" data-date-format="yyyy/mm/dd" class="form-control datepicker">
			</div>
			<div class="col-sm-12 text-right">@{{errors['sale.date']}}</div>
		</div>
		<div :class="errors['sale.account.name']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Account:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="sale.account.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="account in accounts | filterBy sale.account.name in 'name'">
			            <a href="#" v-on:click.prevent="setAccount(account)">
			              <span class="text">@{{account.name}}<small class="muted text-muted">@{{account.ac}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['sale.account.name']}}</div>
		</div>
		<div :class="errors['sale.vat']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Vat:</label>
			<div class="col-sm-8 input-group">
				<input v-model="sale.vat" value="0" type="number" step="any" class="form-control" number>
			</div>
			<div class="col-sm-12 text-right">@{{errors['sale.vat']}}</div>
		</div>
		<div :class="errors['sale.user.name']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Sold by:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="sale.user.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="user in users | filterBy sale.user.name in 'name'">
			            <a href="#" v-on:click.prevent="setUser(user)">
			              <span class="text">@{{user.name}} | <small class="muted text-muted">@{{user.designation}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['sale.customer.name']}}</div>
		</div>
	</div>
</div>
                