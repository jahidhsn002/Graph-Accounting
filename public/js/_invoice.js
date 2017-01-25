
Vue.component('invoice', {
	template:"#invoice",
	props: {
		invoices:[], customers:[], products:[], chalans:[], accounts:[], loader: '', payments:[], users:[]
	},
	data: function () { 
		return {
			invoice: {customer:{}, user:{}, items:[], conditions:[]},
			search: {date:'', invoice:'', company:'', name:'', phone:'', note:''},
			condition: {},
			offer: {},
			payment: {customers:[], account:{}},
			select: [],
			page:'invoice',
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
			for(i=0;i<this.invoice.items.length;i++){
				subtotal = (this.invoice.items[i].qty * this.invoice.items[i].sell) - ((this.invoice.items[i].discount * this.invoice.items[i].qty * this.invoice.items[i].sell) / 100);
				if(this.invoice.items[i].description != '' && subtotal > 0){
					total += subtotal;
				}
			}
			return total;
		},
		TotalPayment: function() {
			
			var total = 0;
			// Condition
			for(i=0;i<this.select.length;i++){
			 	total += this.payment.customers[this.select[i]];
			}
			return total;
		},
		Total: function() {
			// Load Stocks
			var total = this.subTotal;
			// Condition
			for(i=0;i<this.invoice.conditions.length;i++){
			 	total -= this.invoice.conditions[i].value;
			}
			// Tax
			total += ((total * this.invoice.vat) / 100);
			// Shipping
			total += this.invoice.shipping_cost;
			return total;
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

		setChalan: function(chalan) { 
			// Load Stocks
			chalan.conditions = []; 
			chalan.vat = 0;
			chalan.shipping_cost = 0;
			this.invoice = JSON.parse(JSON.stringify(chalan));
			
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

		setItem: function() {
			// Load Stocks
	    	this.invoice.items.push({brand:'', description:'', unit: 'Unit', qty: 1, sell: 0, discount:0});
		},

		addItem: function(point,qty,discount,dbproduct) {
			// Load Stocks
			var item = JSON.parse(JSON.stringify(dbproduct));
			item.product_id = dbproduct.id;
			item.qty = qty;
			item.discount = discount;
	    	this.invoice.items.splice(point, 1, item);
		},

		setCondition: function() {
			// Load Stocks
			var description = ''
			var value = '';
			if(this.condition.type=='percent'){
				description = this.condition.name + '(' + this.condition.value + '%)';
				value = ( (this.subTotal * this.condition.value) / 100 );
			}else{
				description = this.condition.name;
				value = this.condition.value;
			}
	    	this.invoice.conditions.push({description:description, value: value});
			this.condition = {};
			$('#conditionModal').modal('hide');
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
						var invoice = self.invoice;
						invoice.subtotal = self.subTotal;
						invoice.total = self.Total;
						$.ajax({
							url: url + "/invoices",
							type: 'POST',
							dataType: "json",
							data: {
								_token: csrf,
								_method: 'PUT',
								invoice: invoice 
							},
							success: function(result){
								self.loader='false';
								self.errors=[];
								self.products = result['products'];
								self.customers = result['customers'];
								self.invoices = result['invoices'];
								self.invoice = {customer:{}, user:{}, items:[], conditions:[], shipping_cost: 0, tax: 0};
								self.print_id = result['data']['id'];
								self.page = "printInvoice";
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
							url: url + "/invoices",
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
								self.invoices = result['invoices'];
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
							url: url + "/invoices",
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
								self.invoices=result['invoices'];
								self.products=result['products'];
								self.customers = result['customers'];
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
							url: url + "/invoices",
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
		}
		
	}
});