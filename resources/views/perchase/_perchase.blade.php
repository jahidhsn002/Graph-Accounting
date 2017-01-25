<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#perchase">purchase</a></li>
</ul>

<div class="tab-content clearfix page_content">
	<div id="perchase" class="tab-pane fade in active">
		<div :class="errors['perchase.date']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Date:</label>
			<div class="col-sm-8 input-group">
				<input type="text" v-model="perchase.date" data-provide="datepicker" value="@{{NowDate()}}" data-date-format="yyyy/mm/dd" class="form-control datepicker">
			</div>
			<div class="col-sm-12 text-right">@{{errors['perchase.date']}}</div>
		</div>
		<div :class="errors['perchase.tax']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Tax:</label>
			<div class="col-sm-8 input-group">
				<input v-model="perchase.tax" value="0" type="number" step="any" class="form-control" number>
			</div>
			<div class="col-sm-12 text-right">@{{errors['perchase.tax']}}</div>
		</div>
		<div :class="errors['perchase.shipping_cost']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Shipping Cost:</label>
			<div class="col-sm-8 input-group">
				<input v-model="perchase.shipping_cost" value="0" type="number" step="any" class="form-control" number>
			</div>
			<div class="col-sm-12 text-right">@{{errors['perchase.shipping_cost']}}</div>
		</div>
		<div :class="errors['perchase.memo']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Memo No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="perchase.memo" type="text" class="form-control">
			</div>
			<div class="col-sm-12 text-right">@{{errors['perchase.memo']}}</div>
		</div>
		<div :class="errors['perchase.user.name']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Sold by:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="perchase.user.name" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="user in users | filterBy perchase.user.name in 'name'">
			            <a href="#" v-on:click.prevent="setUser(user)">
			              <span class="text">@{{user.name}} | <small class="muted text-muted">@{{user.designation}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['perchase.customer.name']}}</div>
		</div>
	</div>
</div>
                