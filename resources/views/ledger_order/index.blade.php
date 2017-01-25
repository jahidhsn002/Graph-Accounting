<template id="ledgerorder"> 
<div class="invoice">
	<ul class="nav nav-tabs clearfix">
		<li class="active">
			<a href="#" v-on:click.prevent="" class="text-center">
				<span class="glyphicon glyphicon-erase gi-2x"></span>
				<br/>@{{title}}
			</a>
		</li>
		<li class="pull-right">
	    	&nbsp;
	    	<div class="btn-group">
	        	<button v-if="Extselect.length>0" v-on:click.prevent="Delete" class="btn btn-danger">Delete</button>
			</div>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="search.start" placeholder="End Date" value="@{{NowDate()}}" class="form-control datepicker" data-provide="datepicker" data-date-format="yyyy/mm/dd">
		    </div>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="search.end" placeholder="Start Date" value="@{{NowDate()}}" class="form-control datepicker" data-provide="datepicker" data-date-format="yyyy/mm/dd">
		    </div>
	   	</li>
	   	<li class="pull-right">
		    <div class="form-group">
		        <input type="text" v-model="search.user" placeholder="User" value="" class="form-control">
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
					<th class="text-right">Total Debit</th>
					<th class="text-right">
						@{{totalDebit}}
					</th>
				  </tr>
				  <tr>
					<th class="text-right">Total Credit</th>
					<th class="text-right">
						@{{totalCredit}}
					</th>
				  </tr>
				</thead>
			</table>
		</div>
		<div class="col-sm-12">
			<table class="table table-bordered">
				<thead>
				  <tr>
				  	<th>Date #A/C</th>
					<th>@{{category_title}}</th>
					<th>Note</th>
					<th>Sold by</th>
					<th class="text-right">Debit</th>
					<th class="text-right">Credit</th>
				  </tr>
				</thead>
				<tbody>
				  <tr v-for="data in datas | orderBy 'date' -1" v-on:click="ExtSelect(data.id, data)">
				  	<th>
					  	<span :class="Extselect.indexOf(data.id)!=-1?'':'hidden'">
			  				<i class="glyphicon glyphicon-check"></i>
				  		</span>
				  		<span :class="Extselect.indexOf(data.id)!=-1?'hidden':''">
				  			<i class="glyphicon glyphicon-unchecked"></i>
				  		</span>
				  		@{{data.date}} #@{{data.id}}
				  	</th>
					<th>@{{data[catdb].name}}</th>
					<th>@{{data.note}}</th>
					<th><span v-if="data.user!=null">@{{data.user.name}}(@{{data.user.designation}})</span></th>
					<th class="text-right">
						<span v-if="state=='Debit'">@{{data.total}}</span>
					</th>
					<th class="text-right">
						<span v-if="state=='Credit'">@{{data.total}}</span>
					</th>
				  </tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
</template>

