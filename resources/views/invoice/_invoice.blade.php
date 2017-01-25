<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#invoice">Invoice</a></li>
</ul>

<div class="tab-content clearfix page_content">
	<div id="invoice" class="tab-pane fade in active">
		<div :class="errors['invoice.id']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Chalan:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="invoice.id" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="chalan in chalans | filterBy invoice.id in 'id'">
			            <a href="#" v-on:click.prevent="setChalan(chalan)">
			              <span class="text">@{{chalan.date}} #@{{chalan.id}}<small class="muted text-muted">@{{chalan.customer.name}}</small></span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
			<div class="col-sm-12 text-right">@{{errors['invoice.id']}}</div>
		</div>
		<div :class="errors['invoice.date']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Date:</label>
			<div class="col-sm-8 input-group">
				<input type="text" v-model="invoice.date" data-provide="datepicker" value="@{{NowDate()}}" data-date-format="yyyy/mm/dd" class="form-control datepicker">
			</div>
			<div class="col-sm-12 text-right">@{{errors['invoice.date']}}</div>
		</div>
		<div :class="errors['invoice.vat']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Vat:</label>
			<div class="col-sm-8 input-group">
				<input v-model="invoice.vat" value="0" type="number" step="any" class="form-control" number>
			</div>
			<div class="col-sm-12 text-right">@{{errors['invoice.vat']}}</div>
		</div>
		<div :class="errors['invoice.perchase_date']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Purchase Order Date:</label>
			<div class="col-sm-8 input-group">
				<input type="text" v-model="invoice.perchase_date" data-provide="datepicker" value="@{{NowDate()}}" data-date-format="yyyy/mm/dd" class="form-control datepicker">
			</div>
			<div class="col-sm-12 text-right">@{{errors['invoice.perchase_date']}}</div>
		</div>
		<div :class="errors['invoice.perchase_no']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Purchase Order No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="invoice.perchase_no" type="text" class="form-control">
			</div>
			<div class="col-sm-12 text-right">@{{errors['invoice.perchase_no']}}</div>
		</div>
	</div>
</div>
                