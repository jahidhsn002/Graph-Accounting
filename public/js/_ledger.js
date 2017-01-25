 
Vue.component('ledger', {
	template:"#ledger", 
	props: {
		setdatas:[], accounts:[], categories:[], db:'', catdb:'', catdb_base:'', state:'', title:'', category_title:'', payments:[], loader:''
	},
	data: function () {
		return {
			search: {start:'', end:''},
			element: { account:{}, category:{} },
			errors: [],
			Extelement: {},
			Extselect: []
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
				if(this.datas[i].type == 'Debit'){
					total += Number(this.datas[i].amount);
				}
			}
	    	return total.toFixed(2);
		},

		totalCredit: function() {
			// Load Stocks
			var total = 0;
			for(i=0; i < this.datas.length; i++){
				if(this.datas[i].type == 'Credit'){
					total += Number(this.datas[i].amount);
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

		ExtSelect: function (id, product) {
	    	if(this.Extselect.indexOf(id)==-1){
	    		this.Extselect.push(id);
	    		this.Extelement = JSON.parse(JSON.stringify(product));
	    	}else{
	    		this.Extselect.splice(this.Extselect.indexOf(id),1);
	    	}
	    },

		setAccount: function(account) {
			// Load Stocks
			this.element.account = JSON.parse(JSON.stringify(account));
		},

		setCategory: function(category) {
			// Load Stocks
			this.element.category = JSON.parse(JSON.stringify(category));
		},

		recordPayment: function() {
			// Load Stocks
			var self = this;
	    	bootbox.confirm({
	    		size: "small",
  				message: "Are you sure?",
  				animate: false,
  				className: 'alternate-modal',
  				buttons: {
			        confirm: {
			            label: 'Yes',
			            className: 'btn-success'
			        },
			        cancel: {
			            label: 'No',
			            className: 'btn-danger'
			        }
			    },
  				callback: function(cm){
			    	if (cm == true){
				    	self.loader='true';
						$.ajax({
							url: url + "/ac/" + self.db,
							type: 'POST',
							dataType: "json",
							data: {
								_token: csrf,
								_method: 'PATCH',
								element: self.element
							},
							success: function(result){
								self.loader='false';
								self.errors=[];
								self.setdatas = result[self.db];
								self.accounts = result['accounts'];
								self.payments = result['payments'];
								self.categories = result[self.catdb_base];
								self.element = { account:{}, category:{} };
						    	$('#Payment').modal('hide');
						    },
						    error: function(data){
						    	self.loader='false';
								self.errors = data.responseJSON;
						    }
						});
	      			}
		      	}
		    });
		},

		Delete: function () {
	    	var self = this;
	    	bootbox.confirm({
	    		size: "small",
  				message: "Are you sure?",
  				animate: false,
  				className: 'alternate-modal',
  				buttons: {
			        confirm: {
			            label: 'Yes',
			            className: 'btn-success'
			        },
			        cancel: {
			            label: 'No',
			            className: 'btn-danger'
			        }
			    },
  				callback: function(cm){
			    	if (cm == true){
				    	self.loader='true';
				      	$.ajax({
							url: url + "/ac/" + self.db,
							type: 'POST',
							dataType: "json",
							data: {
								_token: csrf,
								_method: 'DELETE',
								select: self.Extselect
							},
							success: function(result){
								self.loader='false';
								self.errors=[];
								self.setdatas = result[self.db];
								self.accounts = result['accounts'];
								self.payments = result['payments'];
								self.Extselect=[];
						    },
						    error: function(data){
						    	self.loader='false';
								self.errors = data.responseJSON;
						    }
						});
		    		}
		      	}
		    });
	    }
	}
});