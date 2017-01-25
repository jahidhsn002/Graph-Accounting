
<template id="offer">
	<div class="root">
	<ul class="nav nav-tabs np">
	   	<li :class="page=='offer'?'active':''">
	   		<a href="#" v-on:click.prevent="page='offer'" class="text-center">
	   			<span class="glyphicon glyphicon-gift gi-2x"></span>
	   			<br/>New Offer
	   		</a>
	   	</li>
	   	<li :class="page=='alloffer'?'active':''">
	   		<a href="#" v-on:click.prevent="page='alloffer'" class="text-center">
	   			<span class="glyphicon glyphicon-book gi-2x"></span>
	   			<br/>Previous Offers
	   		</a>
	   	</li>
	   	<li :class="page=='printOffer'?'active disabled':'disabled'">
	   		<a href="#" v-on:click.prevent="" class="text-center">
	   			<span class="glyphicon glyphicon-duplicate gi-2x"></span>
	   			<br/>Offer Slip
	   		</a>
	   	</li>
	</ul>
	<br/>
	<div v-if="page=='offer'" class="invoice">
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-6">
					@include('offer._customer')
				</div>
				<div class="col-sm-6">
					@include('offer._offer')
				</div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-12">
					<div class="tab-content clearfix page_cart">
						@include('offer._cart')
						<div class="col-sm-6"></div>
						<div class="col-sm-6">
							@include('offer._condition')
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
							<div :class="errors['offer.comments']?'form-group has-error':'form-group'">
								<textarea v-model="offer.comments" class="form-control"></textarea>
								<div class="text-right">@{{errors['offer.comments']}}</div>
							</div>
						</div>
						<div id="Note" class="tab-pane fade">
							<div :class="errors['offer.note']?'form-group has-error':'form-group'">
								<textarea v-model="offer.note" class="form-control"></textarea>
								<div class="text-right">@{{errors['offer.note']}}</div>
							</div>
						</div>
						<div id="Footer" class="tab-pane fade">
							<div :class="errors['offer.terms']?'form-group has-error':'form-group'">
								<textarea v-model="offer.terms" class="form-control"></textarea>
								<div class="text-right">@{{errors['offer.terms']}}</div>
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
	<div v-if="page=='alloffer'" class="invoice">
		<ul class="nav nav-tabs clearfix">
		   	<li class="pull-right">
		   		&nbsp;
		    	<div class="btn-group">
					<button v-if="Extselect.length>0" class="btn btn-success" v-on:click.prevent="page='printOffer',print_id=Extelement.id">Slip</button>
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
			  	<th>Date #Offer</th>
				<th>Company</th>
				<th>Customer</th>
				<th>Bill To</th>
				<th>Ship To</th>
				<th>Tax</th>
				<th>Shipping Cost</th>
				<th>Total</th>
				<th>Note</th>
			  </tr>
			</thead>
			<tbody>
			  <tr v-for="offer in offers | filterBy search.offer in 'id' | filterBy search.date in 'date' | filterBy search.company in 'customer' in 'company' | filterBy search.name in 'customer' in 'name' | filterBy search.phone in 'customer.phone' | filterBy search.note in 'note' | orderBy 'date' -1" v-on:click="ExtSelect(offer.id, offer)">
			  	<th>
					<span :class="Extselect.indexOf(offer.id)!=-1?'':'hidden'">
		  				<i class="glyphicon glyphicon-check"></i>
			  		</span>
			  		<span :class="Extselect.indexOf(offer.id)!=-1?'hidden':''">
			  			<i class="glyphicon glyphicon-unchecked"></i>
			  		</span>
			  		@{{offer.date}} # @{{offer.id}}
		  		</th>
				<th>@{{offer.customer.company}}</th>
				<th>
					@{{offer.customer.name}}<br/>
					@{{offer.customer.phone}}
				</th>
				<th>
					@{{offer.customer.billing}}<br/>
				</th>
				<th>
					@{{offer.customer.shipping}}<br/>
				</th>
				<th>@{{offer.vat}}</th>
				<th>@{{offer.shipping_cost}}</th>
				<th>@{{offer.total}}</th>
				<th>@{{offer.note}}</th>
			  </tr>
			</tbody>
		</table>
	</div>
	<div v-if="page=='printOffer'">
		<slip
			v-for="cc in offers | filterBy print_id in 'id'"
			:data="cc"
			type="offer"
			template="mhs"
		></slip>
	</div>
	</div>
</template>

