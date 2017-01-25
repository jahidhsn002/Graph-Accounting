<table class="table table-bordered">
	<tbody>
	  <tr v-for="condition in sale.conditions">
		<td>@{{condition.description}}</td>
		<td class="text-right">@{{condition.value}}</td>
	  </tr>
	  <tr>
	  	<td><button class="btn btn-warning btn-block" v-on:click.prevent="sale.conditions=[]">Clear Offer</button></td>
		<td><button class="btn btn-default btn-block" type="button" data-toggle="modal" data-target="#conditionModal">Add Offer</button></td>
	  </tr>
	</tbody>
</table>


<!-- Modal -->
<div id="conditionModal" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-right">
        <h4 class="modal-title">Modal Header</h4>
      </div>
	  <div class="modal-body row">
		<div class="col-sm-6">
			<div class="form-group">
				<div class="col-sm-2">
					<input type="radio" value="percent" v-model="condition.type"> %
				</div>
				<label class="col-sm-10">
					If you wanted to add Offer based on Percentage Then check this button 
				</label>
			</div>
			<div class="form-group">
				<div class="col-sm-2">
					<input type="radio" value="nonpercent" v-model="condition.type"> 
				</div>
				<label class="col-sm-10">
					If you Do not wanted to add Offer based on Percentage Then check this button
				</label>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-4">Name:</label>
				<div class="col-sm-8 input-group">
					<input type="text" v-model="condition.name" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4">Value:</label>
				<div class="col-sm-8 input-group">
					<input type="number" step="any" v-model="condition.value" class="form-control" number>
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button class="btn btn-default" v-on:click.prevent="setCondition">Add</button>
      </div>
    </div>

  </div>
</div>