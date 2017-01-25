
<div class="invoice">
		<ul class="nav nav-tabs clearfix">
			<li class="active">
		   		<a href="#" v-on:click.prevent="" class="text-center">
		   			<span class="glyphicon glyphicon-erase gi-2x"></span>
		   			<br/>Perchase
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
							@{{calculateTotal(perchases,'total')}}
						</th>
					  </tr>
					  <tr>
						<th class="text-right">Shipping Cost</th>
						<th class="text-right">
							@{{calculateTotal(perchases,'shipping_cost')}}
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
				<th>Vat</th>
				<th>Shipping Cost</th>
				<th>Total</th>
			  </tr>
			</thead>
			<tbody>
			  <tr
			  	v-for="perchase in perchases"
			  	v-if="dateToint(date.start) > dateToint(perchase.date) && dateToint(date.end) < dateToint(perchase.date)"
			  >
			  	<th>#@{{perchase.id}}</th>
			  	<th>@{{perchase.date}}</th>
				<th>
					@{{perchase.supplier.name}}
					<small>(@{{perchase.supplier.company}})</small>
				</th>
				<th>@{{perchase.vat}}%</th>
				<th>@{{perchase.shipping_cost}}</th>
				<th>@{{perchase.total}}</th>
			  </tr>
			</tbody>
		</table>
	</div>

