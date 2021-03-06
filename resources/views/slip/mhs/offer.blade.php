 
<div class="root" v-if="template=='mhs'&&type=='offer'">
	<div class="page_head container-fluid text-center">
		<h2><input type="text" class="text-center" value="Offer"></h2>
	</div>
	<div class="page_body container-fluid">
		<div class="row">
			<div class="col-xs-8">
				<h4><u>@{{data.customer.company}}</u></h4>
				<div>@{{data.customer.name}}</div>
				<div>@{{data.customer.phone}}</div>
			</div>
			<div class="col-xs-4 text-right">
				<table class="table table-bordered margin-b-0">
					<tr>
						<td class="text-right col-xs-6">Date:</td>
						<td class="text-right col-xs-6">@{{data.date}}</td>
					</tr>
					<tr>
						<td class="text-right col-xs-6">Offer No:</td>
						<td class="text-right col-xs-6">#@{{data.id}}</td>
					</tr>
					<tr>
						<td class="text-right col-xs-6">Shipping Cost:</td>
						<td class="text-right col-xs-6">@{{data.shipping_cost}}</td>
					</tr>
					<tr>
						<td class="text-right col-xs-6"><input type="text" class="text-right form-control"></td>
						<td class="text-right col-xs-6"><input type="text" class="text-right form-control"></td>
					</tr>
					<tr>
						<td class="text-right col-xs-6"><input type="text" class="text-right form-control"></td>
						<td class="text-right col-xs-6"><input type="text" class="text-right form-control"></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="page_body container-fluid">
		<div class="row">
			<div class="col-xs-6">
				<h4><u>Address:</u></h4>
				<div>@{{data.customer.billing}}</div>
			</div>
			<div class="col-xs-6 text-right">
				<h4><u>Ship Address:</u></h4>
				<div>@{{data.customer.shipping}}</div>
			</div>
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
									<th>Sub Total:</th>
									<th class="text-right">@{{data.subtotal}}</th>
								</tr>
							</table>
							<table class="table table-bordered margin-b-0">
								<tr v-for="condition in data.conditions">
									<td class="text-right">@{{condition.description}}</td>
									<td class="text-right">@{{condition.value}}</td>
								</tr>
								<tr>
									<td class="text-right">Vat</td>
									<td class="text-right">@{{data.vat}}%</td>
								</tr>
							</table>
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
			<div class="col-xs-6">
				<div><textarea class="form-control text-center topdash"></textarea></div>
			</div>
			<div class="col-xs-6">
				<div><textarea class="form-control text-center topdash"></textarea></div>
	        </div>
		</div>
	</div>
</div>