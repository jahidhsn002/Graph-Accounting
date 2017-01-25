<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#chalan">Chalan</a></li>
</ul>

<div class="tab-content clearfix page_content">
	<div id="chalan" class="tab-pane fade in active">
		<!--<div class="form-group">
			<label class="col-sm-4">Create From:</label>
			<div class="input-group col-sm-8">
			  <input type="text" value="" class="form-control">
			  <div class="input-group-btn">
				<button class="btn btn-info">New</button>
			  </div>
			</div>
		</div>-->
		<div :class="errors['chalan.date']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Date:</label>
			<div class="col-sm-8 input-group">
				<input type="text" v-model="chalan.date" data-provide="datepicker" value="@{{NowDate()}}" data-date-format="yyyy/mm/dd" class="form-control datepicker">
			</div>
			<div class="col-sm-12 text-right">@{{errors['offer.date']}}</div>
		</div>
		<div :class="errors['chalan.perchase_date']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Purchase Order Date:</label>
			<div class="col-sm-8 input-group">
				<input type="text" v-model="chalan.perchase_date" data-provide="datepicker" value="@{{NowDate()}}" data-date-format="yyyy/mm/dd" class="form-control datepicker">
			</div>
			<div class="col-sm-12 text-right">@{{errors['chalan.perchase_date']}}</div>
		</div>
		<div :class="errors['chalan.perchase_no']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Purchase Order No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="chalan.perchase_no" type="text" class="form-control">
			</div>
			<div class="col-sm-12 text-right">@{{errors['chalan.perchase_no']}}</div>
		</div>
		
	</div>
</div>
                