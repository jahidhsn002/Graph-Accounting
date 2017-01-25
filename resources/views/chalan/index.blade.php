
<template id="chalan">
	<div class="root np">
	<ul class="nav nav-tabs">
	   	<li :class="page=='chalan'?'active':''">
	   		<a href="#" v-on:click.prevent="page='chalan'" class="text-center">
	   			<span class="glyphicon glyphicon-list-alt gi-2x"></span>
	   			<br/>New Chalan
	   		</a>
	   	</li>
	   	<li :class="page=='allchalan'?'active':''">
	   		<a href="#" v-on:click.prevent="page='allchalan'" class="text-center">
	   			<span class="glyphicon glyphicon-book gi-2x"></span>
	   			<br/>Previous Chalan
	   		</a>
	   	</li>
	   	<li :class="page=='printChalan'?'active disabled':'disabled'">
	   		<a href="#" v-on:click.prevent="" class="text-center">
	   			<span class="glyphicon glyphicon-duplicate gi-2x"></span>
	   			<br/>Chalan Slip
	   		</a>
	   	</li>
	</ul>
	<br/>
	<div v-if="page=='chalan'" class="invoice">
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-6">
					@include('chalan._customer')
				</div>
				<div class="col-sm-6">
					@include('chalan._chalan')
				</div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-12">
					<div class="tab-content clearfix page_cart">
						@include('chalan._cart')
					</div>
				</div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-12">
					<ul class="nav nav-tabs">
					   <li class="active"><a data-toggle="tab" href="#Comments">Comments</a></li>
					   <li><a data-toggle="tab" href="#Note">Note</a></li>
					   <li><a data-toggle="tab" href="#Footer">Terms &amp; Conditions</a></li>
					</ul>

					<div class="tab-content clearfix page_content">
						<div id="Comments" class="tab-pane fade in active">
							<div class="form-group">
								<textarea v-model="chalan.comments" class="form-control"></textarea>
							</div>
						</div>
						<div id="Note" class="tab-pane fade">
							<div class="form-group">
								<textarea v-model="chalan.note" class="form-control"></textarea>
							</div>
						</div>
						<div id="Footer" class="tab-pane fade">
							<div class="form-group">
								<textarea v-model="chalan.terms" class="form-control"></textarea>
							</div>
						</div>
					</div>
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
	<div v-if="page=='allchalan'" class="invoice">
		<ul class="nav nav-tabs clearfix">
		   	<li class="pull-right">
		   		&nbsp;
		    	<div class="btn-group">
					<button v-if="Extselect.length>0" class="btn btn-success" v-on:click.prevent="page='printChalan',print_id=Extelement.id">Slip</button>
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
			        <input type="text" v-model="search.offer" class="form-control" placeholder="Offer">
			    </div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.name" class="form-control" placeholder="Name">
			    </div>
		   	</li>
		   	<li class="pull-right">
			    <div class="form-group">
			        <input type="text" v-model="search.company" class="form-control" placeholder="Company">
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
			  	<th>Date #Chalan</th>
				<th>Company</th>
				<th>Customer</th>
				<th>Ship To</th>
				<th>Shipping Cost</th>
				<th>Note</th>
			  </tr>
			</thead>
			<tbody>
			  <tr v-for="chalan in chalans | filterBy search.offer in 'id' | filterBy search.date in 'date' | filterBy search.company in 'customer' in 'company' | filterBy search.name in 'customer' in 'name' | filterBy search.phone in 'customer.phone' | filterBy search.note in 'note' | orderBy 'date' -1" v-on:click="ExtSelect(chalan.id, chalan)">
			  	<th>
					<span :class="Extselect.indexOf(chalan.id)!=-1?'':'hidden'">
		  				<i class="glyphicon glyphicon-check"></i>
			  		</span>
			  		<span :class="Extselect.indexOf(chalan.id)!=-1?'hidden':''">
			  			<i class="glyphicon glyphicon-unchecked"></i>
			  		</span>
			  		@{{chalan.date}} # @{{chalan.id}}
			  	</th>
				<th>@{{chalan.customer.company}}</th>
				<th>
					@{{chalan.customer.name}}<br/>
					@{{chalan.customer.phone}}
				</th>
				<th>
					@{{chalan.customer.shipping}}<br/>
				</th>
				<th>@{{chalan.shipping_cost}}</th>
				<th>@{{chalan.note}}</th>
			  </tr>
			</tbody>
		</table>
	</div>
	<div v-if="page=='printChalan'">
		<slip
			v-for="cc in chalans | filterBy print_id in 'id'"
			:data="cc"
			type="chalan"
			template="mhs"
		></slip>
	</div>
	</div>
</template>

