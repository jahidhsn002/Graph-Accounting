
<div class="tab-content clearfix page_content">
	<div id="billing" class="tab-pane fade in active row">
		<div class="form-group col-sm-6">
			<label class="col-sm-2">Note:</label>
			<div class="col-sm-10 input-group">
				<textarea v-model="wage.note" class="form-control"></textarea>
			</div>
		</div>
		<div class="form-group col-sm-2"></div>
		<div class="form-group col-sm-4">
			<label class="col-sm-4">Date:</label>
			<div class="col-sm-8 input-group">
				<input type="text" v-model="wage.date" data-provide="datepicker" class="form-control datepicker" value="@{{NowDate()}}" data-date-format="yyyy/mm/dd">
			</div>
			<h4 class="col-sm-12 text-right">
				Total: @{{Total}}/-
			</h4>
		</div>
	</div>
</div>
				