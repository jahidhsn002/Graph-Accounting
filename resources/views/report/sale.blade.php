
<div class="invoice">
	<ul class="nav nav-tabs clearfix">
		<li class="active">
	   		<a href="#" v-on:click.prevent="" class="text-center">
	   			<span class="glyphicon glyphicon-erase gi-2x"></span>
	   			<br/>Sales
	   		</a>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="date.start" placeholder="End Date" class="form-control datepicker" data-provide="datepicker" data-date-format="dd/mm/yyyy">
		    </div>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="date.end" placeholder="Start Date" class="form-control datepicker" data-provide="datepicker" data-date-format="dd/mm/yyyy">
		    </div>
	   	</li>
	</ul>
	<br/>
	<div class="row">
		<div class="col-sm-8"></div>
		<div class="col-sm-4">
			<table class="table table-bordered">
				<thead>
				  <tr>
					<th class="text-right">Total</th>
					<th class="text-right">
						@{{calculateTotal(sales,'total')}}
					</th>
				  </tr>
				</thead>
			</table>
		</div>
	</div>
	<table class="table table-bordered">
		<thead>
		  <tr>
		  	<th>#A/C</th>
			<th>Date</th>
			<th>Supplier</th>
			<th>Tax</th>
			<th>Total</th>
		  </tr>
		</thead>
		<tbody>
		  <tr
		  	v-for="sale in sales"
		  	v-if="dateToint(date.start) > dateToint(sale.date) && dateToint(date.end) < dateToint(sale.date)"
		  >
		  	<th>#@{{sale.id}}</th>
		  	<th>@{{sale.date}}</th>
			<th>
				@{{sale.supplier.name}}<br/>
				@{{sale.supplier.billing}}
			</th>
			<th>@{{sale.tax}}%</th>
			<th>@{{sale.total}}</th>
		  </tr>
		</tbody>
	</table>
</div>

