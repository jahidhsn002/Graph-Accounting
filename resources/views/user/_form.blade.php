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
<div :class="errors['element.email']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Email:</label>
	<div class="col-sm-8 input-group">
		<input type="text" v-model="element.email" class="form-control">
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.email']}}</div>
</div>
<div :class="errors['element.roll']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Roll:</label>
	<div class="col-sm-8 input-group">
		<label class="radio-inline"><input v-model="element.roll" type="radio" value="Admin">Admin</label>
		<label class="radio-inline"><input v-model="element.roll" type="radio" value="Owner">Owner</label>
		<label class="radio-inline"><input v-model="element.roll" type="radio" value="Accountant">Accountant</label>
		<label class="radio-inline"><input v-model="element.roll" type="radio" value="Stock">Stock</label>
		<label class="radio-inline"><input v-model="element.roll" type="radio" value="Purchase">Purchase</label>
		<label class="radio-inline"><input v-model="element.roll" type="radio" value="Sales">Sales</label>
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.roll']}}</div>
</div>
<div :class="errors['element.password']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Password:</label>
	<div class="col-sm-8 input-group">
		<input type="password" v-model="element.password" class="form-control">
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.password']}}</div>
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