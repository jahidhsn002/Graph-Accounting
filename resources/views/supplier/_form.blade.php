
<div :class="errors['element.name']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Name:</label>
	<div class="col-sm-8 input-group">
		<input type="text" v-model="element.name" class="form-control">
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.name']}}</div>
</div>
<div :class="errors['element.company']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Company:</label>
	<div class="col-sm-8 input-group">
		<input type="text" v-model="element.company" class="form-control">
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.company']}}</div>
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