 
Vue.component('ledgerdue', {
	template:"#ledgerdue",
	props: {
		setdatas:[], db:'', title:'', loader:''
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
			datas = this.setdatas;
	    	return datas;
		},

		totalDebit: function() {
			// Load Stocks
			var total = 0;
			for(i=0; i < this.datas.length; i++){
				for(j=0; j<this.datas[i].transections.length; j++){
					if(this.datas[i].transections[j].type == 'Debit' && this.IntDate(this.datas[i].transections[j].date) <= this.IntDate(this.search.start) && this.IntDate(this.datas[i].transections[j].date) >= this.IntDate(this.search.end)){
						total += this.datas[i].transections[j].amount;
					}
				}
			}
	    	return total.toFixed(2);
		},

		totalCredit: function() {
			// Load Stocks
			var total = 0;
			for(i=0; i < this.datas.length; i++){
				for(j=0; j<this.datas[i].transections.length; j++){
					if(this.datas[i].transections[j].type == 'Credit' && this.IntDate(this.datas[i].transections[j].date) <= this.IntDate(this.search.start) && this.IntDate(this.datas[i].transections[j].date) >= this.IntDate(this.search.end)){
						total += this.datas[i].transections[j].amount;
					}
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
		},

		dueTotal: function(transections, type) { 
			// Load Stocks
			var total = 0;
			// Condition
			for(i=0;i<transections.length;i++){
				if(transections[i].type == type && this.IntDate(transections[i].date) <= this.IntDate(this.search.start) && this.IntDate(transections[i].date) >= this.IntDate(this.search.end)){
					total += transections[i].amount;
				}
			}
			// Shipping
			return total;
			
		}
	}
});