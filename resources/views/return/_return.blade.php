<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#breturn">Return Details</a></li>
</ul>

<div class="tab-content clearfix page_content">
	<div id="breturn" class="tab-pane fade in active">
		<div :class="errors['breturn.date']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Date:</label>
			<div class="col-sm-8 input-group">
				<input type="text" v-model="breturn.date" data-provide="datepicker" value="@{{NowDate()}}" data-date-format="yyyy/mm/dd" class="form-control datepicker">
			</div>
			<div class="col-sm-12 text-right">@{{errors['breturn.date']}}</div>
		</div>
		<div :class="errors['breturn.account.name']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Account:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="breturn.account.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="account in accounts | filterBy breturn.account.name in 'name'">
			            <a href="#" v-on:click.prevent="setAccount(account)">
			              <span class="text">@{{account.name}}<small class="muted text-muted">@{{account.ac}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['breturn.account.name']}}</div>
		</div>
		<div :class="errors['breturn.type']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Type:</label>
			<div class="col-sm-8 input-group">
				<select v-model="breturn.type" class="form-control">
					<option>Sale</option>
					<option>Perchase</option>
				</select>
			</div>
			<div class="col-sm-12 text-right">@{{errors['breturn.type']}}</div>
		</div>
	</div>
</div>
                