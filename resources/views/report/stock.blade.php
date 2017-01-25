<div class="invoice">
	<ul class="nav nav-tabs clearfix">
		<li class="active">
	   		<a href="#" v-on:click.prevent="" class="text-center">
	   			<span class="glyphicon glyphicon-erase gi-2x"></span>
	   			<br/>Stocks
	   		</a>
	   	</li>
        <li class="pull-right">
		    <div class="form-group">
		        <input type="number" v-model="search.stock" placeholder="Out of Stock" class="form-control" number>
		    </div>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="search.iban" placeholder="IBAN/UBN/POS" class="form-control">
		    </div>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="search.name" placeholder="Brand" class="form-control">
		    </div>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="search.description" placeholder="Description" class="form-control">
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
					<th class="text-right">Total Stock Value</th>
					<th class="text-right">
						@{{calculateStockvalue}}
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
			<th>IBAN/UBN/POS</th>
			<th>Description</th>
			<th>Brand</th>
			<th>Stock</th>
		  </tr>
		</thead>
		<tbody>
		  <tr
		  	v-for="product in products | filterBy search.iban in 'iban' | filterBy search.name in 'brand' | filterBy search.description in 'description'" data-toggle="modal" data-target="#ccd_@{{product.id}}"
            v-if="product.stock.qty <= search.stock || search.stock=='' || search.stock==null"
		  >
		  	<td>#@{{product.id}}</td>
		  	<td>@{{product.iban}}</td>
			<td>@{{product.description}}</td>
			<td>@{{product.brand}}</td>
			<td>@{{product.stock.qty}}</td>
		  </tr>
		</tbody>
	</table>



	<!-- Modal -->
	<div v-for="product in products" id="ccd_@{{product.id}}" class="modal" role="dialog">
	  <div class="modal-dialog modal-md">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <form class="form-horizontal">
	      <div class="modal-header text-right">
	        <h4 class="modal-title">Stock History</h4>
	      </div>
		  <div class="modal-body row">
			<div class="col-sm-12">
				Service /-
				<table class="table table-bordered">
					<thead>
					  <tr>
					  	<th>Date</th>
						<th>IBAN/UBN/POS</th>
						<th>Description</th>
						<th>Brand</th>
						<th>Company</th>
						<th>Job/Perchase/Invoice No.</th>
						<th>Quantity</th>
					  </tr>
					</thead>
					<tbody>
					  <tr
					  	v-for="data in product.items"
					  >
					  		<td v-if="data.service">#@{{data.service.date}}</td>
					  		<td v-if="data.perchase">#@{{data.perchase.date}}</td>
					  		<td v-if="data.sale">#@{{data.sale.date}}</td>
					  		<td v-if="data.invoice">#@{{data.invoice.date}}</td>
					  	<td>@{{product.iban}}</td>
						<td>@{{product.description}}</td>
						<td>@{{product.brand}}</td>
							<td v-if="data.service">@{{data.service.customer.company}}</td>
							<td v-if="data.service">@{{data.service.jobno}}</td>

							<td v-if="data.perchase">@{{data.perchase.customer.company}}</td>
							<td v-if="data.perchase">@{{data.perchase.id}}</td>

							<td v-if="data.sale">@{{data.sale.customer.company}}</td>
							<td v-if="data.sale">@{{data.sale.id}}</td>

							<td v-if="data.invoice">@{{data.invoice.customer.company}}</td>
							<td v-if="data.invoice">@{{data.invoice.id}}</td>
							
							
						<td :class="data.perchase?'bg-danger':'bg-success'">@{{data.qty}}</td>
					  </tr>
					</tbody>
				</table>




			</div>
	      </div>
	      </form>
	    </div>

	  </div>
	</div>




</div>

