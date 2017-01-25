
<template id="slip">
	<div class="root slip">
		<div class="check np">
			<input type="checkbox" v-model="header"> Print Header
		</div>
		<div class="sliphead" v-if="header==true">
			<img src="assets/images/header.jpg" width="100%" style="position:fixed;top:0px">
		</div>
		<div class="slipbody">
			@include('slip/mhs/offer')
			@include('slip/mhs/chalan')
			@include('slip/mhs/invoice')
			@include('slip/mhs/sales')
			@include('slip/mhs/return')
			@include('slip/mhs/perchase')
			@include('slip/mhs/wages')
			@include('slip/mhs/service')
		</div>
		<div class="slipfoot" v-if="header==true">
			<img src="assets/images/footer.jpg" width="100%" style="position:fixed;bottom:0px">
		</div>
	</div>
</template>

