<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#offer">Offer</a></li>
</ul>

<div class="tab-content clearfix page_content">
	<div id="offer" class="tab-pane fade in active">
		<!--<div class="form-group">
			<label class="col-sm-4">Create From:</label>
			<div class="input-group col-sm-8">
			  <input type="text" value="" class="form-control">
			  <div class="input-group-btn">
				<button class="btn btn-info">New</button>
			  </div>
			</div>
		</div>-->
		<div :class="errors['offer.date']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Date:</label>
			<div class="col-sm-8 input-group">
				<input type="text" v-model="offer.date" data-provide="datepicker" value="@{{NowDate()}}" data-date-format="yyyy/mm/dd" class="form-control datepicker" data-date-format="dd/mm/yyyy">
			</div>
			<div class="col-sm-12 text-right">@{{errors['offer.date']}}</div>
		</div>
		<div :class="errors['offer.vat']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Vat:</label>
			<div class="col-sm-8 input-group">
				<input v-model="offer.vat" value="0" type="number" step="any" class="form-control" number>
			</div>
			<div class="col-sm-12 text-right">@{{errors['offer.vat']}}</div>
		</div>
	</div>
</div>
                