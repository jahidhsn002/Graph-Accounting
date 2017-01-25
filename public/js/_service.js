
Vue.component('service', {
	template:"#service",
	props: {
		services:[], estimates:[], customers:[], products:[], accounts:[], loader: '', payments:[], users:[]
	},
	data: function () {
		return {
			service: {customer:{}, user:{}, items:[], jobs:[]},
			search: {date:'', invoice:'', company:'', name:'', phone:'', note:''},
			job: {}, offer: {},
			search: {date:'', number:''},
			payment: {customers:[], account:{}},
			select: [],
			page:'service',
			print_id: 0,
			Extelement: {},
			Extselect: [],
			errors: [] 
		}
	}, 
	computed: {
		subTotal: function() {
			// Load Stocks
			var total = 0;
			var subtotal = 0;
			for(i=0;i<this.service.items.length;i++){
				subtotal = (this.service.items[i].qty * this.service.items[i].sell) - ((this.service.items[i].discount * this.service.items[i].qty * this.service.items[i].sell) / 100);
				if(this.service.items[i].description != '' && subtotal > 0){
					total += subtotal;
				}
			}
			return total;
		},
		TotalPayment: function() {
			var total = 0;
			for(i=0;i<this.select.length;i++){
			 	total += this.payment.customers[this.select[i]];
			}
			return total;
		},
		Total: function() {
			// Load Stocks
			var total = this.subTotal;
			// job
			for(i=0;i<this.service.jobs.length;i++){
			 	total += Number(this.service.jobs[i].value);
			}

			// Tax
			var subtotal = total + ((total * this.service.vat) / 100);

			return subtotal;
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

		ExtSelect: function (id, product) {
	    	if(this.Extselect.indexOf(id)==-1){
	    		this.Extselect.push(id);
	    		this.Extelement = JSON.parse(JSON.stringify(product));
	    	}else{
	    		this.Extselect.splice(this.Extselect.indexOf(id),1);
	    	}
	    },

	    Select: function (id) {
	    	if(this.select.indexOf(id)==-1){
	    		this.select.push(id);
	    	}else{
	    		this.select.splice(this.select.indexOf(id),1);
	    	}
	    },

	    setAccount: function(account) {
			// Load Stocks
			this.payment.account = JSON.parse(JSON.stringify(account));
		},

		setCustomer: function(customer) {
			// Load Stocks
			this.invoice.customer = JSON.parse(JSON.stringify(customer));
		},

		setUser: function(user) {
			// Load Stocks
			this.invoice.user = JSON.parse(JSON.stringify(user));
		},

		setService: function (service) {
			this.service = JSON.parse(JSON.stringify(service));
		},

	    dueTotal: function(transections, type) { 
			// Load Stocks
			var total = 0;
			// Condition
			for(i=0;i<transections.length;i++){
				if(transections[i].type == type){
					total += transections[i].amount;
				}
			}
			// Shipping
			return total;
			
		},

		setcustomer: function(customer) {
			// Load Stocks
			this.service.customer = JSON.parse(JSON.stringify(customer));
		},

		addItem: function(point,qty,discount,dbproduct) {
			// Load Stocks
			var item = JSON.parse(JSON.stringify(dbproduct));
			item.product_id = dbproduct.id;
			item.qty = qty;
			item.discount = discount;
	    	this.service.items.splice(point, 1, item);
		},

		setItem: function(customer) {
			// Load Stocks
	    	this.service.items.push({brand:'', description:'', unit: 'Unit', qty: 1, sell: 0, discount:0});
		},

		setjob: function() {
			// Load Stocks
			var description = ''
			var value = '';
			
			description = this.job.name;
			value = this.job.value;

	    	this.service.jobs.push({description:description, value: value});
			this.job = {};
			$('#jobModal').modal('hide');
		},

		saveInvoice: function() {
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
						var service = self.service;
						service.subtotal = self.subTotal;
						service.total = self.Total;
						$.ajax({
							url: url + "/services",
							type: 'POST',
							dataType: "json",
							data: {
								_token: csrf,
								_method: 'PUT',
								service: service 
							},
							success: function(result){
								self.loader='false';
								self.errors=[];
								self.products = result['products'];
								self.customers = result['customers'];
								self.services = result['services'];
								self.estimates = result['estimates'];
								self.stocks = result['stocks'];
								self.service = {customer:{}, items:[], jobs:[], shipping_cost: 0, tax: 0};
								self.print_id = result['data']['id'];
								self.Extelement = result.data;
								self.page = "printservice";
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

		offerInvoice: function() {
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
							url: url + "/services",
							type: 'POST',
							dataType: "json",
							data: {
								_token: csrf,
								_method: 'POST',
								offer: self.offer,
								select: self.Extselect
							},
							success: function(result){
								self.loader='false';
								self.errors=[];
								self.customers = result['customers'];
								self.services = result['services'];
								self.estimates = result['estimates'];
								self.offer = {};
								self.Extselect=[];
								$('#offerModal').modal('hide');
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
							url: url + "/services",
							type: 'POST',
							dataType: "json",
							data: {
								_token: csrf,
								_method: 'PATCH',
								payment: self.payment,
								select: self.select 
							},
							success: function(result){
								self.loader='false';
								self.errors=[];
								self.customers = result['customers'];
								self.accounts = result['accounts'];
								self.payments = result['payments'];
								self.estimates = result['estimates'];
								self.select = [];
								self.payment = {customers:[], account:{}};
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
							url: url + "/services",
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
								self.services=result['services'];
								self.products=result['products'];
								self.customers = result['customers'];
								self.estimates = result['estimates'];
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
	    },
		
	}
});