 
Vue.component('ledgerwages', {
	template:"#ledgerwages",
	props: {
		setdatas:[], state:'', title:'', loader:''
	},
	data: function () {
		return {
			search: {start:'', end:''}
		}
	},
	computed: {
		datas: function() {
			// Load Stocks
			var datas = [];
			for(i=0; i < this.setdatas.length; i++){
				if(this.IntDate(this.setdatas[i].date) <= this.IntDate(this.search.start) && this.IntDate(this.setdatas[i].date) >= this.IntDate(this.search.end)){
					datas.push(this.setdatas[i]);
				}
			}
	    	return datas;
		},

		totalDebit: function() {
			// Load Stocks
			var total = 0;
			for(i=0; i < this.datas.length; i++){
				if(this.state == 'Debit'){
					total += Number(this.datas[i].total);
				}
			}
	    	return total.toFixed(2);
		},

		totalCredit: function() {
			// Load Stocks
			var total = 0;
			for(i=0; i < this.datas.length; i++){
				if(this.state == 'Credit'){
					total += Number(this.datas[i].total);
				}
			}
	    	return total.toFixed(2);
		}
	},
	methods: {

		NowDate: function (){
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1;
			var yyyy = today.getFullYear();
			if(dd<10){
			    dd='0'+dd;
			} 
			if(mm<10){
			    mm='0'+mm;
			} 
			var today = yyyy+'/'+mm+'/'+dd;
			return today;
		},

		IntDate: function(theDate) {
			// Load Stocks
			var myDate=theDate.split("/");
			var newDate=myDate[1]+","+myDate[2]+","+myDate[0];
			intDate = new Date(newDate).getTime();
	    	return intDate;
		}
	}
});