
<div :class="errors['element.empid']?'form-group has-error':'form-group'"> 
	<label class="col-sm-4">Employe ID:</label>
	<div class="col-sm-8 input-group">
		<input type="text" v-model="element.empid" class="form-control">
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.empid']}}</div>
</div>
<div :class="errors['element.name']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Name:</label>
	<div class="col-sm-8 input-group">
		<input type="text" v-model="element.name" class="form-control">
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.name']}}</div>
</div>
<div :class="errors['element.designation']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Designation:</label>
	<div class="col-sm-8 input-group">
		<input type="text" v-model="element.designation" class="form-control">
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.designation']}}</div>
</div>
<div :class="errors['element.joining']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Joining Date:</label>
	<div class="col-sm-8 input-group">
		<input type="text" v-model="element.joining" data-provide="datepicker" class="form-control datepicker" data-date-format="dd/mm/yyyy">
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.joining']}}</div>
</div>
<div :class="errors['element.salary']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Salary:</label>
	<div class="col-sm-8 input-group">
		<input type="number" v-model="element.salary" class="form-control" number>
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.salary']}}</div>
</div>
<div :class="errors['element.phone']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Phone:</label>
	<div class="col-sm-8 input-group">
		<input type="text" v-model="element.phone" class="form-control">
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.phone']}}</div>
</div>
<div :class="errors['element.address']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Address:</label>
	<div class="col-sm-8 input-group">
		<textarea v-model="element.address" class="form-control"></textarea>
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.address']}}</div>
</div>
<div :class="errors['element.note']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Note:</label>
	<div class="col-sm-8 input-group">
		<textarea v-model="element.note" class="form-control"></textarea>
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.note']}}</div>
</div>