<ul class="nav nav-tabs clearfix">
   	<li class="pull-right">
   		&nbsp;
    	<div class="btn-group">
    		<button v-if="Extselect.length>0" class="btn btn-success" v-on:click.prevent="page='printwages',print_id=Extelement.id">Slip</button>
			<button v-if="Extselect.length>0" v-on:click.prevent="Delete" class="btn btn-danger">Delete</button>
		</div>
   	</li>
	<li class="pull-right">
	    <div class="form-group">
	        <input type="text" v-model="search.date" placeholder="Date" class="form-control datepicker" data-provide="datepicker" data-date-format="yyyy/mm/dd">
	    </div>
   	</li>
   	<li class="pull-right">
	    <div class="form-group">
	        <input type="text" v-model="search.number" class="form-control" placeholder="No.">
	    </div>
   	</li>
</ul>
<table class="table table-bordered table-hover">
	<thead>
	  <tr>
		<th># A/C</th>
		<th>Date</th>
		<th>Note</th>
		<th>Total</th>
	  </tr>
	</thead>
	<tbody>
	  <tr v-for="wage in wages | filterBy search.number in 'id' |  filterBy search.date in 'date'" v-on:click="ExtSelect(wage.id, wage)">
	  	<th>
			<span :class="Extselect.indexOf(wage.id)!=-1?'':'hidden'">
  				<i class="glyphicon glyphicon-check"></i>
	  		</span>
	  		<span :class="Extselect.indexOf(wage.id)!=-1?'hidden':''">
	  			<i class="glyphicon glyphicon-unchecked"></i>
	  		</span>
	  		&nbsp; # @{{wage.id}}
	  	</th>
		<th>@{{wage.date}}</th>
		<th>@{{wage.note}}</th>
		<th>@{{wage.total}}</th>
	  </tr>
	</tbody>
</table>