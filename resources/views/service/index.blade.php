
<template id="service">
	<div class="root">
	<ul class="nav nav-tabs np">
		<li :class="page=='service'?'active':''">
	   		<a href="#" v-on:click.prevent="page='service'" class="text-center">
	   			<span class="glyphicon glyphicon-save-file gi-2x"></span>
	   			<br/>New Service
	   		</a>
	   	</li>
	   	<li :class="page=='allestimate'?'active':''">
	   		<a href="#" v-on:click.prevent="page='allestimate'" class="text-center">
	   			<span class="glyphicon glyphicon-book gi-2x"></span>
	   			<br/>Running Service
	   		</a>
	   	</li>
	   	<li :class="page=='allservice'?'active':''">
	   		<a href="#" v-on:click.prevent="page='allservice'" class="text-center">
	   			<span class="glyphicon glyphicon-book gi-2x"></span>
	   			<br/>Previous Service
	   		</a>
	   	</li>
	   	<li :class="page=='due_collection'?'active':''">
	   		<a href="#" v-on:click.prevent="page='due_collection'" class="text-center">
	   			<span class="glyphicon glyphicon-credit-card gi-2x"></span>
	   			<br/>Due Collection
	   		</a>
	   	</li>
	   	<li :class="page=='printservice'?'active disabled':'disabled'">
	   		<a href="#" v-on:click.prevent="" class="text-center">
	   			<span class="glyphicon glyphicon-duplicate gi-2x"></span>
	   			<br/>Service Slip
	   		</a>
	   	</li>
	</ul>
	<br/>
	<div v-if="page=='service'" class="invoice">
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-6">
					@include('service._customer')
				</div>
				<div class="col-sm-6">
					@include('service._service')
				</div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-12">
					<div class="tab-content clearfix page_cart">
						@include('service._cart')
						<div class="col-sm-6"></div>
						<div class="col-sm-6">
							@include('service._condition')
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-6">
					<ul class="nav nav-tabs">
					   <li class="active"><a data-toggle="tab" href="#Note">Note</a></li>
					   <li><a data-toggle="tab" href="#Footer">Terms &amp; Conditions</a></li>
					</ul>

					<div class="tab-content clearfix page_content">
						<div id="Note" class="tab-pane fade in active">
							<div class="form-group">
								<textarea v-model="service.note" class="form-control"></textarea>
							</div>
						</div>
						<div id="Footer" class="tab-pane fade">
							<div class="form-group">
								<textarea v-model="service.terms" class="form-control"></textarea>
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
	<div v-if="page=='allservice'" class="invoice">
		@include('service._all')
	</div>
	<div v-if="page=='allestimate'" class="invoice">
		@include('service._allrunning')
	</div>
	<div v-if="page=='due_collection'">
		@include('service.due_collection')
	</div>
	<div v-if="page=='printservice'">
		<slip
			:data="Extelement"
			type="service"
			template="mhs"
		></slip>
	</div>
	</div>
</template>

