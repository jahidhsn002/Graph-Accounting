
<div class="root" v-if="template=='mhs'&&type=='service'"> 
	<div class="page_head container-fluid text-center">
		<h2><input type="text" class="text-center" value="Bill"></h2>
	</div>
	<div class="page_body container-fluid">
		<div class="row">
			<div class="col-xs-5">
				<table class="table table-bordered margin-b-0">
					<tr>
						<td class="text-left col-xs-6">Date:</td>
						<td class="text-left col-xs-6">@{{data.date}}</td>
					</tr>
					<tr>
						<td class="text-left col-xs-6">Reg No:</td>
						<td class="text-left col-xs-6">@{{data.Reg}}</td>
					</tr>
					<tr>
						<td class="text-left col-xs-6">Customer:</td>
						<td class="text-left col-xs-6">@{{data.customer.name}}</td>
					</tr>
					<tr>
						<td class="text-left col-xs-6">Company:</td>
						<td class="text-left col-xs-6">@{{data.customer.company}}</td>
					</tr>
					<tr>
						<td class="text-left col-xs-6">Phone:</td>
						<td class="text-left col-xs-6">@{{data.customer.phone}}</td>
					</tr>
					<tr>
						<td class="text-left col-xs-6">Address:</td>
						<td class="text-left col-xs-6">@{{data.customer.billing}}</td>
					</tr>
				</table>
			</div>
			<div class="col-xs-2 text-right"></div>
			<div class="col-xs-5 text-right">
				<table class="table table-bordered margin-b-0">
					<tr>
						<td class="text-right col-xs-6">Bill No:</td>
						<td class="text-right col-xs-6">#@{{data.id}}</td>
					</tr>
					<tr>
						<td class="text-right col-xs-6">Job No:</td>
						<td class="text-right col-xs-6">#@{{data.jobno}}</td>
					</tr>
					<tr>
						<td class="text-right col-xs-6">Make:</td>
						<td class="text-right col-xs-6">@{{data.make}}</td>
					</tr>
					<tr>
						<td class="text-right col-xs-6">Model:</td>
						<td class="text-right col-xs-6">@{{data.model}}</td>
					</tr>
					<tr>
						<td class="text-right col-xs-6">Engine:</td>
						<td class="text-right col-xs-6">@{{data.engine}}</td>
					</tr>
					<tr>
						<td class="text-right col-xs-6">Milage:</td>
						<td class="text-right col-xs-6">@{{data.milage}}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="page_body container-fluid">
		<div class="row">
			<div class="col-xs-6"></div>
			<div class="col-xs-6 text-right"></div>
		</div>
	</div>
	<div class="page_body container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<h4>Spare Parts:</h4>
				<table class="table table-bordered">
					<thead>
					  <tr>
						<th>Description</th>
						<th>Brand/Origin</th>
						<th class="text-right">Qty</th>
						<th class="text-right">Unit Price</th>
						<th class="text-right">Discount</th>
						<th class="text-right">Total</th>
					  </tr>
					</thead>
					<tbody>
					  <tr v-for="item in data.items">
						<td>@{{item.description}}</td>
						<td>@{{item.brand}}</td>
						<td class="text-right">@{{item.qty}} @{{item.unit}}</td>
						<td class="text-right">@{{item.sell}}</td>
						<td class="text-right">@{{item.discount}}</td>
						<td class="text-right">@{{( (item.qty * item.sell) - ((item.discount * item.qty * item.sell) / 100 ) ).toFixed(2)}}</td>
					  </tr>
					  <tr>
						<td colspan="3"></td>
						<td colspan="3">
							<table class="table table-bordered margin-b-0">
								<tr>
									<th>Sub Total:</th>
									<th class="text-right">@{{data.subtotal}}</th>
								</tr>
							</table>
							<table class="table table-bordered margin-b-0">
								<tr v-for="condition in data.conditions">
									<td class="text-right">@{{condition.description}}</td>
									<td class="text-right">@{{condition.value}}</td>
								</tr>
							</table>
						</td>
					  </tr>
					</tbody>
				</table>
				<h4>Service Charges:</h4>
				<table class="table table-bordered margin-b-0">
					<tr>
						<th>Services Name</th>
						<th>Charge</th>
					</tr>
				</table>
				<table class="table table-bordered margin-b-0">
					<tr v-for="job in data.jobs">
						<td class="text-right">@{{job.description}}</td>
						<td class="text-right">@{{job.value}}</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<table class="table table-bordered margin-b-0">
								<tbody>
									<tr>
										<th>Service Sub Total :</th>
										<th class="text-right">@{{totalServices(data.jobs)}}</th>
									  </tr>
								  	<tr>
										<td class="text-right">Vat(@{{data.vat}}%) :</td>
										<td class="text-right">@{{totalServicesVat(data.jobs, data.subtotal, data.vat)}}</td>
								  	</tr>
								  	<tr>
									<th>Total : </th>
										<th class="text-right">@{{data.total}}</th>
								  	</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr class="text-capitalize">
						<td colspan="2">@{{moneyToWord(data.total)}}</td>
					</tr>
				</table>
				
			</div>
		</div>
	</div>
	<div class="page_body container-fluid padding-tb-10">
		<div class="row">
			<div class="col-xs-5 text-right">
				<p><textarea class="form-control text-left">@{{data.comments}}</textarea></p>
			</div>
			<div class="col-xs-2 text-right"></div>
			<div class="col-xs-5 text-right">
				<div><textarea class="form-control text-left">@{{data.terms}}</textarea></div>
	        </div>
		</div>
	</div>
	<p class="padding-tb-10"><br/></p>
	<p class="padding-tb-10"><br/></p>
	<p class="padding-tb-10"><br/></p>
	<div class="page_body container-fluid padding-tb-10">
		<div class="row">
			<div class="col-xs-4">
				<p><textarea class="form-control text-center">Customer Sign</textarea></p>
			</div>
			<div class="col-xs-4">
				<p><textarea class="form-control text-center">Prepaired by</textarea></p>
			</div>
			<div class="col-xs-4">
				<div><textarea class="form-control text-center">Manager</textarea></div>
	        </div>
		</div>
	</div>
</div>