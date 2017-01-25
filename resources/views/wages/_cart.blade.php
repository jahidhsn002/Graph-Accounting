


<table class="table table-bordered">
	<thead>
	  <tr>
	  	<th><i class="glyphicon glyphicon-trash"></i></th>
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
	  <tr v-for="(point, single_dbwage) in dbwage">
	  	<td>
	  		<button class="btn btn-danger btn-sm " v-on:click.prevent="dbwage.splice(point,1)"><i class="glyphicon glyphicon-trash"></i></button>
	  	</td>
		<td>@{{single_dbwage.employe.empid}}</td>
		<td>@{{single_dbwage.employe.name}}</td>
		<td>@{{single_dbwage.employe.designation}}</td>
		<td>
			<input type="text" step="any" class="form-control" v-model="single_dbwage.basic" value="@{{single_dbwage.employe.salary}}" number>
		</td>
		<td>
			<input type="number" step="any" class="form-control" v-model="single_dbwage.absent" value="0" number>
		</td>
		<td>
			<input type="number" step="any" class="form-control" v-model="single_dbwage.late" value="0" number>
		</td>
		<td>
			@{{ ( ((single_dbwage.basic * single_dbwage.absent) / 30 )  + ((single_dbwage.basic * single_dbwage.late) / ( 30 * 3 ) ) ).toFixed(2) }}
		</td>
		<td>
			<input type="number" step="any" class="form-control" v-model="single_dbwage.tada" value="0" number>
		</td>
		<td>
			<input type="number" step="any" class="form-control" v-model="single_dbwage.charge" value="0" number>
		</td>
		<td>
			<input type="number" step="any" class="form-control" v-model="single_dbwage.bonus" value="0" number>
		</td>
		<td>
			<input type="number" step="any" class="form-control" v-model="single_dbwage.advance" value="0" number>
		</td>
		<td class="text-right">
			@{{ (
				single_dbwage.basic + single_dbwage.tada - single_dbwage.charge + single_dbwage.bonus - single_dbwage.advance -
				( ((single_dbwage.basic * single_dbwage.absent) / 30 )  + ((single_dbwage.basic * single_dbwage.late) / ( 30 * 3 ) ) )
			).toFixed(2) }}
		</td>
	  </tr>
	</tbody>
</table>
