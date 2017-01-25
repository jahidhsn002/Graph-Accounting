
<template id="returns">
	<div class="root">
	<ul class="nav nav-tabs np">
	   	<li :class="page=='returns'?'active':''">
	   		<a href="#" v-on:click.prevent="page='returns'" class="text-center">
	   			<span class="glyphicon glyphicon-open-file gi-2x"></span>
	   			<br/>New Return
	   		</a>
	   	</li>
	   	<li :class="page=='allreturns'?'active':''">
	   		<a href="#" v-on:click.prevent="page='allreturns'" class="text-center">
	   			<span class="glyphicon glyphicon-book gi-2x"></span>
	   			<br/>Previous Return
	   		</a>
	   	</li>
	   	<li :class="page=='printreturns'?'active disabled':'disabled'">
	   		<a href="#" v-on:click.prevent="" class="text-center">
	   			<span class="glyphicon glyphicon-duplicate gi-2x"></span>
	   			<br/>Return Slip
	   		</a>
	   	</li>
	</ul>
	<br/>
	<div v-if="page=='returns'" class="invoice">
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-6">
					@include('return._return')
				</div>
				<div class="col-sm-6" v-if="breturn.type=='Sale'">
					@include('return._customer')
				</div>
				<div class="col-sm-6" v-if="breturn.type=='Perchase'">
					@include('return._supplier')
				</div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-12">
					<div class="tab-content clearfix page_cart">
						@include('return._cart')
					</div>
				</div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-6">
					<ul class="nav nav-tabs">
					   <li class="active"><a data-toggle="tab" href="#Note">Note</a></li>
					</ul>

					<div class="tab-content clearfix page_content">
						<div id="Note" class="tab-pane fade in active">
							<div class="form-group">
								<textarea v-model="breturn.note" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
	                <table class="table">
						<tbody>
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
		<div v-if="page=='allreturns'" class="invoice">
		<ul class="nav nav-tabs clearfix">
		   	<li class="pull-right">
		   		&nbsp;
		    	<div class="btn-group">
					<button v-if="Extselect.length>0" class="btn btn-success" v-on:click.prevent="page='printreturns',print_id=Extelement.id">Slip</button>
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
			        <input type="text" v-model="search.breturn" class="form-control" placeholder="breturn No.">
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
			  	<th>Date #Return</th>
			  	<th>Type</th>
				<th>Customer/Supplier</th>
				<th>Address</th>
				<th>Total</th>
				<th>Note</th>
			  </tr>
			</thead>
			<tbody>
			  <tr v-for="breturn in returns | filterBy search.breturn in 'id' | filterBy search.date in 'date' | filterBy search.name in 'customer' in 'name' | filterBy search.phone in 'customer.phone' | filterBy search.note in 'note' | orderBy 'date' -1" v-on:click="ExtSelect(breturn.id, breturn)">
			  	<th>
					<span :class="Extselect.indexOf(breturn.id)!=-1?'':'hidden'">
		  				<i class="glyphicon glyphicon-check"></i>
			  		</span>
			  		<span :class="Extselect.indexOf(breturn.id)!=-1?'hidden':''">
			  			<i class="glyphicon glyphicon-unchecked"></i>
			  		</span>
			  		@{{breturn.date}} # @{{breturn.id}}
			  	</th>
			  	<th>@{{breturn.type}} Return</th>
				<th v-if="breturn.type=='Sale'">
					@{{breturn.customer.name}}<br/>
					@{{breturn.customer.phone}}
				</th>
				<th v-if="breturn.type=='Sale'">
					@{{breturn.customer.billing}}<br/>
				</th>
				<th v-if="breturn.type=='Perchase'">
					@{{breturn.supplier.name}}<br/>
					@{{breturn.supplier.phone}}
				</th>
				<th v-if="breturn.type=='Perchase'">
					@{{breturn.supplier.address}}<br/>
				</th>
				<th>@{{breturn.total}}</th>
				<th>@{{breturn.note}}</th>
			  </tr>
			</tbody>
		</table>
	</div>
	<div v-if="page=='printreturns'">
		<slip
			v-for="cc in returns | filterBy print_id in 'id'"
			:data="cc"
			type="return"
			template="mhs"
		></slip>
	</div>
	</div>
</template>

