<table class="table table-bordered">
	<tbody>
	  <tr v-for="job in service.jobs">
		<td>@{{job.description}}</td>
		<td class="text-right">@{{job.value}}</td>
	  </tr>
	  <tr>
	  	<td><button class="btn btn-warning btn-block" v-on:click.prevent="service.jobs=[]">Clear Jobs</button></td>
		<td><button class="btn btn-default btn-block" type="button" data-toggle="modal" data-target="#jobModal">Add Jobs</button></td>
	  </tr>
	</tbody>
</table>


<!-- Modal -->
<div id="jobModal" class="modal" role="dialog">
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
					<input type="radio" value="nonpercent" v-model="job.type" checked> 
				</div>
				<label class="col-sm-10">
					Please Write you service name and make sheore to check this button
				</label>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-4">Description:</label>
				<div class="col-sm-8 input-group">
					<input type="text" v-model="job.name" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4">Amount:</label>
				<div class="col-sm-8 input-group">
					<input type="number" step="any" v-model="job.value" class="form-control" number>
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button class="btn btn-default" v-on:click.prevent="setjob">Add</button>
      </div>
    </div>

  </div>
</div>