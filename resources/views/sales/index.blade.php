
<template id="sales">
	<div class="root">
	<ul class="nav nav-tabs np">
	   	<li :class="page=='sales'?'active':''">
	   		<a href="#" v-on:click.prevent="page='sales'" class="text-center">
	   			<span class="glyphicon glyphicon-open-file gi-2x"></span>
	   			<br/>New Sale
	   		</a>
	   	</li>
	   	<li :class="page=='allsales'?'active':''">
	   		<a href="#" v-on:click.prevent="page='allsales'" class="text-center">
	   			<span class="glyphicon glyphicon-book gi-2x"></span>
	   			<br/>Previous Sale
	   		</a>
	   	</li>
	   	<li :class="page=='printSales'?'active disabled':'disabled'">
	   		<a href="#" v-on:click.prevent="" class="text-center">
	   			<span class="glyphicon glyphicon-duplicate gi-2x"></span>
	   			<br/>Sale Slip
	   		</a>
	   	</li>
	</ul>
	<br/>
	<div v-if="page=='sales'" class="invoice">
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-6">
					@include('sales._customer')
				</div>
				<div class="col-sm-6">
					@include('sales._salse')
				</div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-12">
					<div class="tab-content clearfix page_cart">
						@include('sales._cart')
						<div class="col-sm-6"></div>
						<div class="col-sm-6">
							@include('sales._condition')
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-6">
					<ul class="nav nav-tabs">
					   <li class="active"><a data-toggle="tab" href="#Comments">Comments</a></li>
					   <li><a data-toggle="tab" href="#Note">Note</a></li>
					   <li><a data-toggle="tab" href="#Footer">Terms &amp; Conditions</a></li>
					</ul>

					<div class="tab-content clearfix page_content">
						<div id="Comments" class="tab-pane fade in active">
							<div class="form-group">
								<textarea v-model="sale.comments" class="form-control"></textarea>
							</div>
						</div>
						<div id="Note" class="tab-pane fade">
							<div class="form-group">
								<textarea v-model="sale.note" class="form-control"></textarea>
							</div>
						</div>
						<div id="Footer" class="tab-pane fade">
							<div class="form-group">
								<textarea v-model="sale.terms" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
	                <table class="table">
						<tbody>
							<tr>
								<td class="text-center">Subtotal : @{{subTotal.toFixed(2)}}</td>
							</tr>
							<tr>
								<th class="text-center">Total : @{{Total.toFixed(2)}}</th>
							</tr>
						</tbody>
					</table>
	            </div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-12 text-right">
					<button class="btn btn-default" v-on:click="saveInvoice">Record Only</button>
					<button class="btn btn-default" type="submit">Cancel</button>
				</div>
			</div>
		</div>

	</div>
		<div v-if="page=='allsales'" class="invoice">
		<ul class="nav nav-tabs clearfix">
		   	<li class="pull-right">
		   		&nbsp;
		    	<div class="btn-group">
					<button v-if="Extselect.length>0" class="btn btn-success" v-on:click.prevent="page='printSales',print_id=Extelement.id">Slip</button>
		        	<button v-if="Extselect.length>0" v-on:click.prevent="Delete" class="btn btn-danger">Delete</button>
				</div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.date" placeholder="Date" class="form-control datepicker" data-provide="datepicker" data-date-format="dd/mm/yyyy">
			    </div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.sale" class="form-control" placeholder="Sale No.">
			    </div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.name" class="form-control" placeholder="Name">
			    </div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.phone" class="form-control" placeholder="Phone">
			    </div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.note" class="form-control" placeholder="Note">
			    </div>
		   	</li>
		</ul>
		<table class="table table-bordered">
			<thead>
			  <tr>
			  	<th>Date #Sales</th>
				<th>Customer</th>
				<th>Address</th>
				<th>Vat</th>
				<th>Total</th>
				<th>Note</th>
			  </tr>
			</thead>
			<tbody>
			  <tr v-for="sale in sales | filterBy search.sale in 'id' | filterBy search.date in 'date' | filterBy search.name in 'customer' in 'name' | filterBy search.phone in 'customer.phone' | filterBy search.note in 'note' | orderBy 'date' -1" v-on:click="ExtSelect(sale.id, sale)">
			  	<th>
					<span :class="Extselect.indexOf(sale.id)!=-1?'':'hidden'">
		  				<i class="glyphicon glyphicon-check"></i>
			  		</span>
			  		<span :class="Extselect.indexOf(sale.id)!=-1?'hidden':''">
			  			<i class="glyphicon glyphicon-unchecked"></i>
			  		</span>
			  		@{{sale.date}} # @{{sale.id}}
			  	</th>
				<th>
					@{{sale.customer.name}}<br/>
					@{{sale.customer.phone}}
				</th>
				<th>
					@{{sale.customer.billing}}<br/>
				</th>
				<th>@{{sale.vat}}</th>
				<th>@{{sale.total}}</th>
				<th>@{{sale.note}}</th>
			  </tr>
			</tbody>
		</table>
	</div>
	<div v-if="page=='printSales'">
		<slip
			v-for="cc in sales | filterBy print_id in 'id'"
			:data="cc"
			type="sales"
			template="mhs"
		></slip>
	</div>
	
	</div>
</template>

