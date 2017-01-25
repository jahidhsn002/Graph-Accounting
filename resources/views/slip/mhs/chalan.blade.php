<div class="root" v-if="template=='mhs'&&type=='chalan'">
	<div class="page_head container-fluid text-center">
		<h2><input type="text" class="text-center" value="Challan"></h2>
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
						<td class="text-right col-xs-6">Chalan No:</td>
						<td class="text-right col-xs-6">#@{{data.id}}</td>
					</tr>
					<tr>
						<td class="text-right col-xs-6">Purchase Order No:</td>
						<td class="text-right col-xs-6"><input type="text" class="text-right form-control" value="@{{data.perchase_no}}"></td>
					</tr>
					<tr>
						<td class="text-right col-xs-6">Purchase Order Date:</td>
						<td class="text-right col-xs-6"><input type="text" class="text-right form-control" value="@{{data.perchase_date}}"></td>
					</tr>
					<tr>
						<td class="text-right col-xs-6">Shipping Cost:</td>
						<td class="text-right col-xs-6">@{{data.shipping_cost}}</td>
					</tr>
					<tr>
						<td class="text-right col-xs-6">Traking Ref No::</td>
						<td class="text-right col-xs-6">@{{data.traking}}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="page_body container-fluid">
		<div class="row">
			<div class="col-xs-6"></div>
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
						<th class="text-right">Remarks</th>
					  </tr>
					</thead>
					<tbody>
					  <tr v-for="item in data.items">
						<td>@{{item.name}}</td>
						<td>@{{item.description}}</td>
						<td class="text-right">@{{item.qty}}</td>
						<td><input type="text" class="text-center form-control"></td>
					  </tr>
					</tbody>
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
				<div><textarea class="form-control text-right">@{{data.terms}}</textarea></div>
	        </div>
		</div>
	</div>
	<p class="padding-tb-10"><br/></p>
	<div class="page_body container-fluid padding-tb-10">
		<div class="row">
			<div class="col-xs-6">
				<div><textarea class="form-control text-center topdash">Delivered By</textarea></div>
			</div>
			<div class="col-xs-6">
				<div><textarea class="form-control text-center topdash">Recived By</textarea></div>
	        </div>
		</div>
	</div>
</div>