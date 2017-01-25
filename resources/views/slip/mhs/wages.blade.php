
<div class="root" v-if="template=='mhs'&&type=='wages'">
	<div class="page_head container-fluid text-center">
		<h2><input type="text" class="text-center" value="Wages Chart"></h2>
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
						<td class="text-right col-xs-6">Wages A/C:</td>
						<td class="text-right col-xs-6">#@{{data.id}}</td>
					</tr>
					<tr>
						<td class="text-right col-xs-6">Total Wages:</td>
						<td class="text-right col-xs-6">@{{data.total}}</td>
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
						<th>Employe ID</th>
						<th>Name</th>
						<th>Designation</th>
						<th class="text-right">Basic</th>
						<th class="text-right">Absent</th>
						<th class="text-right">Late</th>
						<th class="text-right">Diduct</th>
						<th class="text-right">T.A.D.A.</th>
						<th class="text-right">Ect Charges</th>
						<th class="text-right">Bonus</th>
						<th class="text-right">Advance</th>
						<th class="text-right">Salary</th>
					  </tr>
					</thead>
					<tbody>
					  <tr v-for="dbwage in data.dbwages">
					  	<td>@{{dbwage.employe.empid}}</td>
						<td>@{{dbwage.employe.name}}</td>
						<td>@{{dbwage.employe.designation}}</td>
						<td class="text-right">@{{dbwage.basic}}</td>
						<td class="text-right">@{{dbwage.absent}}</td>
						<td class="text-right">@{{dbwage.late}}</td>
						<td class="text-right">
							@{{ ( ((dbwage.basic * dbwage.absent) / 30 )  + ((dbwage.basic * dbwage.late) / ( 30 * 3 ) ) ).toFixed(2) }}
						</td>
						<td class="text-right">@{{dbwage.tada}}</td>
						<td class="text-right">@{{dbwage.charge}}</td>
						<td class="text-right">@{{dbwage.bonus}}</td>
						<td class="text-right">@{{dbwage.advance}}</td>
						<td class="text-right">
							@{{ (
								dbwage.basic + dbwage.tada - dbwage.charge + dbwage.bonus - dbwage.advance -
								( ((dbwage.basic * dbwage.absent) / 30 )  + ((dbwage.basic * dbwage.late) / ( 30 * 3 ) ) )
							).toFixed(2) }}
						</td>
					  </tr>
					  <tr>
						<td colspan="9"></td>
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
			</div>
		</div>
	</div>
	<div class="page_body container-fluid padding-tb-10">
		<div class="row">
			<div class="col-xs-8 text-left">
				<p><textarea class="form-control text-left">@{{data.note}}</textarea></p>
			</div>
			<div class="col-xs-4 text-right"></div>
		</div>
	</div>
	<div class="page_body container-fluid padding-tb-10">
		<div class="row">
			<div class="col-xs-4">
				<p><textarea class="form-control text-center"></textarea></p>
			</div>
			<div class="col-xs-4">
				<p><textarea class="form-control text-center"></textarea></p>
			</div>
			<div class="col-xs-4">
				<div><textarea class="form-control text-center"></textarea></div>
	        </div>
		</div>
	</div>
</div>