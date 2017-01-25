 
Vue.component('report', {
	template:"#report",
	props: {
		assets:[], products:[], capitals:[], drawings:[], expenses:[], loans:[], perchases:[], invoices:[], sales:[], services:[], suppliers:[], customers:[], wages:[], employes:[], payments:[], state:'', title:'', loader:''
	},
	data: function () {
		return {
			search: {start:'', end:''}
		}
	},
	computed: {
		

		totalDebit: function() {
			// Load Stocks
			var total = 0;

			total += Number(this.accCalc('Debit', 'assets'));
			total += Number(this.accCalc('Debit', 'capitals'));
			total += Number(this.accCalc('Debit', 'drawings'));
			total += Number(this.accCalc('Debit', 'expenses'));
			total += Number(this.accCalc('Debit', 'loans'));

			total += Number(this.saleCalc('Debit', 'invoices'));
			total += Number(this.saleCalc('Debit', 'sales'));
			total += Number(this.saleCalc('Debit', 'perchases'));
			total += Number(this.saleCalc('Debit', 'services'));

			total += Number(this.dueCalc('Debit', 'customers'));
			total += Number(this.dueCalc('Debit', 'suppliers'));
			total += Number(this.dueCalc('Debit', 'employes'));

			total += Number(this.wagesCalc('Debit'));
			total += Number(this.cashCalc('Debit'));

	    	return total.toFixed(2);
		},

		totalCredit: function() {
			// Load Stocks
			var total = 0;

			total += Number(this.accCalc('Credit', 'assets'));
			total += Number(this.accCalc('Credit', 'capitals'));
			total += Number(this.accCalc('Credit', 'drawings'));
			total += Number(this.accCalc('Credit', 'expenses'));
			total += Number(this.accCalc('Credit', 'loans'));

			total += Number(this.saleCalc('Credit', 'invoices'));
			total += Number(this.saleCalc('Credit', 'sales'));
			total += Number(this.saleCalc('Credit', 'perchases'));
			total += Number(this.saleCalc('Credit', 'services'));

			total += Number(this.dueCalc('Credit', 'customers'));
			total += Number(this.dueCalc('Credit', 'suppliers'));
			total += Number(this.dueCalc('Credit', 'employes'));

			total += Number(this.wagesCalc('Credit'));
			total += Number(this.cashCalc('Credit'));

	    	return total.toFixed(2);
		}
	},
	methods: {

		accCalc: function(type, db) {
			// Load Stocks
			var datas = this.dateFilter(this[db]);
			var total = 0;
			for(i=0; i < datas.length; i++){
				if(datas[i].type == type){
					total += Number(datas[i].amount);
				}
			}
	    	return total.toFixed(2);
		},

		saleCalc: function(type, db) { 
			// Load Stocks
			var datas = this.dateFilter(this[db]);
			var total = 0;
			for(i=0; i < datas.length; i++){
				if(type == 'Debit' && db == 'perchases'){
					total += Number(datas[i].total);
				}
				if(type == 'Credit' && db == 'sales'){
					total += Number(datas[i].total);
				}
				if(type == 'Credit' && db == 'invoices'){
					total += Number(datas[i].total);
				}
				if(type == 'Credit' && db == 'services'){
					if(datas[i].status == 'Delivered'){
						total += Number(datas[i].total);
					}
				}
			}
	    	return total.toFixed(2);
		},

		dueCalc: function(type, db) {
			// Load Stocks
			var datas = this[db];
			var total = 0;
			for(i=0; i < datas.length; i++){
				for(j=0; j<datas[i].transections.length; j++){
					if(datas[i].transections[j].type == type && this.IntDate(datas[i].transections[j].date) <= this.IntDate(this.search.start) && this.IntDate(datas[i].transections[j].date) >= this.IntDate(this.search.end)){
						total += datas[i].transections[j].amount;
					}
				}
			}
	    	return total.toFixed(2);
		},

		wagesCalc: function(type) {
			// Load Stocks
			var datas = this.dateFilter(this.wages);
			var total = 0;
			for(i=0; i < datas.length; i++){
				if(type == 'Debit'){
					total += Number(datas[i].total);
				}
			}
	    	return total.toFixed(2);
		},

		cashCalc: function(type) {
			// Load Stocks
			var datas = this.dateFilter(this.payments);
			var total = 0;
			for(i=0; i < datas.length; i++){
				if(datas[i].type == type){
					total += Number(datas[i].amount);
				}
			}
	    	return total.toFixed(2);
		},

		TotalRevenue: function() {
			return (Number(this.saleCalc('Credit', 'services')) + Number(this.accCalc('Debit', 'assets')) + Number(this.saleCalc('Credit', 'invoices')) + Number(this.saleCalc('Credit', 'sales'))).toFixed(2);
		},

		TotalCost: function() {
			return Number(this.saleCalc('Debit', 'perchases')).toFixed(2);
		},

		TotalExpenses: function() {
			return (Number(this.accCalc('Debit', 'expenses')) + Number(this.wagesCalc('Debit'))).toFixed(2);
		},

		TotalAssets: function() {
			return (Number(this.stockCalc()) + Number(this.cashCalc('Debit')) - Number(this.cashCalc('Credit')) + Number(this.accCalc('Debit', 'assets')) - Number(this.accCalc('Credit', 'assets')) + Number(this.dueCalc('Credit', 'customers'))).toFixed(2);
		},

		TotalLiabality: function() {
			return (Number(this.accCalc('Debit', 'loans')) - Number(this.accCalc('Credit', 'loans')) + Number(this.accCalc('Debit', 'expenses')) + Number(this.dueCalc('Debit', 'services')) + Number(this.dueCalc('Credit', 'suppliers')) - Number(this.dueCalc('Debit', 'suppliers')) ).toFixed(2);
		},

		TotalEquity: function() {
			return (Number(this.accCalc('Credit', 'capitals')) + Number(this.TotalRevenue()) - Number(this.accCalc('Debit', 'drawings')) - Number(this.TotalLiabality()) ).toFixed(2);
		},

		stockCalc: function() {
			// Load Stocks
			var total = 0;
			for(i=0; i < this.products.length; i++){
				total += (Number(this.products[i].buy) * Number(this.products[i].stock.qty));
			}
	    	return total.toFixed(2);
		},

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

		dateFilter: function(setdatas) {
			// Load Stocks
			var datas = [];
			for(i=0; i < setdatas.length; i++){
				if(this.IntDate(setdatas[i].date) <= this.IntDate(this.search.start) && this.IntDate(setdatas[i].date) >= this.IntDate(this.search.end)){ 
					datas.push(setdatas[i]);
				}
			}
	    	return datas;
		}
	}
});