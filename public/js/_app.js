
var csrf = $('meta[name=csrf-token]').attr('content');
var url = $('meta[name=site-url]').attr('content');

var App = new Vue({
	el: '#App',
	data: { 
		customers: [],
		products: [],
		invoices: [],
		offers: [],
		chalans: [],
		accounts: [],
		perchases: [],
		suppliers: [],
		payments: [],
		returns: [],

		owners: [],
		assetaccounts: [],
		loanaccounts: [],
		expenseaccounts: [],

		assets: [],
		capitals: [],
		drawings: [],
		expenses: [],
		loans: [],

		employes: [],
		wages: [],
		dbwages: [],

		services: [],
		estimates: [],
		jobs: [],

		users: [],

		loader: 'false',
		page : "Login",
		user : {email:'', password:'', remember:false},
		errors: [],
		state: 'T/B',
		date: {start:'', end:''},
		search: {iban:null, name:null, description:null, ac:null}
	},
	computed: {
		calculateStockvalue: function() {
			// Load Stocks
			var total = 0;
			for(i=0; i < this.products.length; i++){
				total += (Number(this.products[i].buy) * Number(this.products[i].stock.qty));
			}
	    	return total.toFixed(2);
		}
	},
	methods: {

		login: function() {
			// Load Stocks
			var self = this;
	    	
			self.loader='true';
			$.ajax({
				url: url + "/web/login",
				type: 'POST',
				dataType: "json",
				data: {
					_token: csrf,
					_method: 'PATCH',
					user: self.user
				},
				success: function(result){
					result.user.password = '';
					result.user.remember = false;
					self.user = result.user;
					self.loadData();
				},
				error: function(data){
					self.loader='false';
					self.errors = data.responseJSON;
				}
			});
					
		},

		Logout: function() {
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
							url: url + "/web/logout",
							type: 'GET',
							dataType: "json",
							data: {
								_token: csrf
							},
							success: function(result){
						    	self.page = 'Login';
						    	self.loader='false';
						    	self.user = {email:'', password:'', remember:false};
						    	self.removeData();
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

		removeData: function(){
			
			this['customers']=[];
			this['products']=[];
			this['invoices']=[];
			this['offers']=[];
			this['chalans']=[];
			this['sales']=[];
			this['accounts']=[];
			this['perchases']=[];
			this['suppliers']=[];
			this['payments']=[];
			this['returns']=[];

			this['owners']=[];
			this['assetaccounts']=[];
			this['loanaccounts']=[];
			this['expenseaccounts']=[];

			this['assets']=[];
			this['capitals']=[];
			this['drawings']=[];
			this['expenses']=[];
			this['loans']=[];

			this['employes']=[];
			this['wages']=[];
			this['dbwages']=[];
			this['estimates']=[];

			this['users']=[];

		},
		
		loadData: function(api) {
			// Load Stocks
			$.ajax({
				url: url + "/get",
				type: 'POST',
				dataType: "json",
				data: {
					_token: csrf,
					_method: 'PATCH'
				},
				success: function(result){
					// Load Stocks
					this['customers']=result['customers'];
					this['products']=result['products'];
					this['invoices']=result['invoices'];
					this['offers']=result['offers'];
					this['chalans']=result['chalans'];
					this['sales']=result['sales'];
					this['accounts']=result['accounts'];
					this['perchases']=result['perchases'];
					this['suppliers']=result['suppliers'];
					this['payments']=result['payments'];
					this['returns']=result['returns'];

					this['owners']=result['owners'];
					this['assetaccounts']=result['assetaccounts'];
					this['loanaccounts']=result['loanaccounts'];
					this['expenseaccounts']=result['expenseaccounts'];

					this['assets']=result['assets'];
					this['capitals']=result['capitals'];
					this['drawings']=result['drawings'];
					this['expenses']=result['expenses'];
					this['loans']=result['loans'];

					this['employes']=result['employes'];
					this['wages']=result['wages'];
					this['dbwages']=result['dbwages'];

					this['services']=result['services'];
					this['jobs']=result['jobs'];
					this['estimates']=result['estimates'];


					this['users']=result['users'];

					this.loader='false';
					this.page='Dashboard';
					
			    }.bind(this),	
			    error: function(data){
			    	this.loader='false';
					this.errors = data.responseJSON;
			    }
			});
		},

		dateToint: function(theDate) {
			// Load Stocks
			var myDate=theDate.split("/");
			var newDate=myDate[1]+","+myDate[0]+","+myDate[2];
			intDate = new Date(newDate).getTime();
	    	return intDate;
		},

		calculateTotal: function(data,option) {
			// Load Stocks
			var total = 0;
			for(i=0; i < data.length; i++){
				if(
					this.dateToint(this.date.start) > this.dateToint(data[i].date)
					&& this.dateToint(this.date.end) < this.dateToint(data[i].date)){
					total += Number(data[i][option]);
				}
			}
	    	return total.toFixed(2);
		},

		accountDebit: function(data) {
			// Load Stocks
			var total = 0;
			for(i=0; i < data.length; i++){
				if( data[i].type == 'Debit'){
					total += Number(data[i].amount);
				}
			}
	    	return total.toFixed(2);
		},

		accountCredit: function(data) {
			// Load Stocks
			var total = 0;
			for(i=0; i < data.length; i++){
				if( data[i].type == 'Credit'){
					total += Number(data[i].amount);
				}
			}
	    	return total.toFixed(2);
		},

		accountTotal: function(data) {
			// Load Stocks
			var total = 0;
			var total = this.accountDebit(data) - this.accountCredit(data);
	    	return total.toFixed(2);
		},

		Print: function() {
			// Load Stocks
			window.print();
		}
		
	}
});

App.login();