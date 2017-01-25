
<div class="root" v-if="template=='mhs'&&type=='return'">
	<div class="page_head container-fluid text-center">
		<h2><input type="text" class="text-center" value="@{{data.type}} Return"></h2>
	</div>
	<div class="page_body container-fluid">
		<div class="row">
			<div class="col-xs-8"></div>
			<div class="col-xs-4 text-right">
				<table class="table table-bordered margin-b-0">
					<tr>
						<td class="text-right col-xs-6">Date:</td>
						<td class="text-right col-xs-6">@{{data.date}}</td>
					</tr>
					<tr>
						<td class="text-right col-xs-6">Return No:</td>
						<td class="text-right col-xs-6">@{{data.id}}</td>
					</tr>
					<tr v-if="data.type=='Sale'">
						<td class="text-right col-xs-6">Customer:</td>
						<td class="text-right col-xs-6">@{{data.customer.name}}</td>
					</tr>
					<tr v-if="data.type=='Sale'">
						<td class="text-right col-xs-6">Phone:</td>
						<td class="text-right col-xs-6">@{{data.customer.phone}}</td>
					</tr>
					<tr v-if="data.type=='Sale'">
						<td class="text-right col-xs-6">Address:</td>
						<td class="text-right col-xs-6">@{{data.customer.billing}}</td>
					</tr>
					<tr v-if="data.type=='Perchase'">
						<td class="text-right col-xs-6">Supplier:</td>
						<td class="text-right col-xs-6">@{{data.supplier.name}}</td>
					</tr>
					<tr v-if="data.type=='Perchase'">
						<td class="text-right col-xs-6">Phone:</td>
						<td class="text-right col-xs-6">@{{data.supplier.phone}}</td>
					</tr>
					<tr v-if="data.type=='Perchase'">
						<td class="text-right col-xs-6">Address:</td>
						<td class="text-right col-xs-6">@{{data.supplier.address}}</td>
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
									<th>Total:</th>
									<th class="text-right">@{{data.total}}</th>
								</tr>
							</table>
						</td>
					  </tr>
					</tbody>
				</table>
				<p class="text-capitalize">@{{moneyToWord(data.total)}}</p>
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
				<div><textarea class="form-control text-right">@{{data.terms}}</textarea></div>
	        </div>
		</div>
	</div>
	<p class="padding-tb-10"><br/></p>
	<div class="page_body container-fluid padding-tb-10">
		<div class="row">
			<div class="col-xs-3">
				<p></p>
			</div>
			<div class="col-xs-3">
				<p></p>
			</div>
			<div class="col-xs-3">
				<p><textarea class="form-control text-center topdash">Sold By</textarea></p>
			</div>
			<div class="col-xs-3">
				<div><textarea class="form-control text-center topdash">Accounts</textarea></div>
	        </div>
		</div>
	</div>
</div>