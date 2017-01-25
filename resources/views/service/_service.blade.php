<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#service">Service</a></li>
</ul>

<div class="tab-content clearfix page_content">
	<div id="service" class="tab-pane fade in active">
		<div class="form-group">
			<label class="col-sm-4">Job No:</label>
			<div class="btn-group bootstrap-select col-sm-8">
			  <input type="text" v-model="service.jobno" value="" class="form-control" data-toggle="dropdown">
			  	<div class="dropdown-menu open">
			        <ul class="dropdown-menu inner">
			          <li v-for="service in estimates | filterBy service.jobno in 'jobno'">
			            <a href="#" v-on:click.prevent="setService(service)">
			              <span class="text">@{{service.date}} #@{{service.id}}
			              	<small class="muted text-muted">
			              		@{{service.jobno}}
			              	</small>
			              	<small class="muted text-muted">
			              		@{{service.customer.name}}
			              	</small>
			              </span>
			            </a>
			          </li>
			        </ul>
			    </div>
			</div>
		</div>
		<div :class="errors['service.date']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Date:</label>
			<div class="col-sm-8 input-group">
				<input type="text" v-model="service.date" data-provide="datepicker" value="@{{NowDate()}}" data-date-format="yyyy/mm/dd" class="form-control datepicker">
			</div>
			<div class="col-sm-12 text-right">@{{errors['service.date']}}</div>
		</div>
		<div :class="errors['service.estimate']?'form-group has-error':'form-group'">
			<label class="col-sm-4">Estimate Date:</label>
			<div class="col-sm-8 input-group">
				<input type="text" v-model="service.estimate" data-provide="datepicker" value="@{{NowDate()}}" data-date-format="yyyy/mm/dd" class="form-control datepicker">
			</div>
			<div class="col-sm-12 text-right">@{{errors['service.estimate']}}</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4">Reg No:</label>
			<div class="col-sm-8 input-group">
				<input v-model="service.reg" value="" type="text" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4">Make:</label>
			<div class="col-sm-8 input-group">
				<input v-model="service.make" value="" type="text" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4">Model:</label>
			<div class="col-sm-8 input-group">
				<input v-model="service.model" value="" type="text" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4">Engine:</label>
			<div class="col-sm-8 input-group">
				<input v-model="service.engine" value="" type="text" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4">Milage:</label>
			<div class="col-sm-8 input-group">
				<input v-model="service.milage" value="" type="text" class="form-control">
			</div>
		</div>
	</div>
</div>
                