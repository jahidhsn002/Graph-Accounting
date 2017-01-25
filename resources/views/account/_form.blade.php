<div :class="errors['element.ac']?'form-group has-error':'form-group'">
	<label class="col-sm-4">A/C:</label> 
	<div class="col-sm-8 input-group">
		<input type="text" v-model="element.ac" class="form-control">
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.ac']}}</div>
</div>
<div :class="errors['element.name']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Name:</label>
	<div class="col-sm-8 input-group">
		<input type="text" v-model="element.name" class="form-control">
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.name']}}</div>
</div>