<div :class="errors['element.iban']?'form-group has-error':'form-group'">
	<label class="col-sm-4">IBAN/UBN/POS:</label>
	<div class="col-sm-8 input-group">
		<input type="text" v-model="element.iban" class="form-control">
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.iban']}}</div>
</div>
<div :class="errors['element.description']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Description:</label>
	<div class="col-sm-8 input-group">
		<textarea v-model="element.description" class="form-control"></textarea>
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.description']}}</div>
</div>
<div :class="errors['element.brand']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Brand/Origin:</label>
	<div class="col-sm-8 input-group">
		<input type="text" v-model="element.brand" class="form-control">
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.brand']}}</div>
</div>
<div :class="errors['element.unit']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Unit:</label>
	<div class="col-sm-8 input-group">
		<input type="text" v-model="element.unit" class="form-control">
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.unit']}}</div>
</div>
<div :class="errors['element.stock.qty']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Current Stock:</label>
	<div class="col-sm-8 input-group">
		<input type="number" v-model="element.stock.qty" class="form-control" step="any" number>
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.stock.qty']}}</div>
</div>
<div :class="errors['element.buy']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Retail Price:</label>
	<div class="col-sm-8 input-group">
		<input type="number" v-model="element.buy" class="form-control" step="any" number>
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.buy']}}</div>
</div>
<div :class="errors['element.sell']?'form-group has-error':'form-group'">
	<label class="col-sm-4">Sell Price:</label>
	<div class="col-sm-8 input-group">
		<input type="number" v-model="element.sell" class="form-control" step="any" number>
	</div>
	<div class="col-sm-12 text-right">@{{errors['element.sell']}}</div>
</div>