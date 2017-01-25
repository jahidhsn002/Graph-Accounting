
<template id="wages">
	<div class="root">
	<ul class="nav nav-tabs np">
	   	<li :class="page=='allwages'?'active':''">
	   		<a href="#" v-on:click.prevent="page='allwages'" class="text-center">
	   			<span class="glyphicon glyphicon-book gi-2x"></span>
	   			<br/>Previous Wages
	   		</a>
	   	</li>
	   	<li :class="page=='wages'?'active':''">
	   		<a href="#" v-on:click.prevent="page='wages'" class="text-center">
	   			<span class="glyphicon glyphicon-save-file gi-2x"></span>
	   			<br/>New Wages
	   		</a>
	   	</li>
	   	<li :class="page=='due_wages'?'active':''">
	   		<a href="#" v-on:click.prevent="page='due_wages'" class="text-center">
	   			<span class="glyphicon glyphicon-credit-card gi-2x"></span>
	   			<br/>Due Wages
	   		</a>
	   	</li>
	   	<li :class="page=='printwages'?'active disabled':'disabled'">
	   		<a href="#" v-on:click.prevent="" class="text-center">
	   			<span class="glyphicon glyphicon-duplicate gi-2x"></span>
	   			<br/>Wages Overview
	   		</a>
	   	</li>
	</ul>
	<br/>
	<div v-if="page=='wages'" class="invoice">
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-12">
					@include('wages._wages')
				</div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-12">
					<div class="tab-content clearfix page_cart">
						@include('wages._cart')
						<div class="col-sm-6"></div>
						<div class="col-sm-6">
							<table class="table table-bordered">
								<tbody>
								  <tr>
								  	<td><button class="btn btn-warning btn-block" v-on:click.prevent="dbwages=[]">Clear Offer</button></td>
									<td><button class="btn btn-default btn-block" v-on:click.prevent="loadEmploye">Load Employe</button></td>
								  </tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="page_body container-fluid padding-tb-10">
			<div class="row">
				<div class="col-sm-12 text-right">
					<button class="btn btn-default" v-on:click="saveWages">Record Only</button>
					<button class="btn btn-default" type="submit">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<div v-if="page=='allwages'" class="invoice">
		@include('wages._all')
	</div>
	<div v-if="page=='due_wages'">
		@include('wages.due_wages')
	</div>
	<div v-if="page=='printwages'">
		<slip
			v-for="cc in wages | filterBy print_id in 'id'"
			:data="cc"
			type="wages"
			template="mhs"
		></slip>
	</div>
	</div>
</template>

