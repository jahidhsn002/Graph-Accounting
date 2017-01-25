
Vue.component('perchase', {
	template:"#perchase",
	props: {
		perchases:[], suppliers:[], products:[], accounts:[], payments:[], loader: '', users:[]
	},
	data: function () {
		return {
			perchase: {supplier:{}, user:{}, items:[], conditions:[]},
			search: {date:'', perchase:'', company:'', name:'', phone:'', note:''},
			condition: {},
			offer: {},
			payment: {suppliers:[], account:{}},
			select: [],
			page:'perchase',
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
			for(i=0;i<this.perchase.items.length;i++){
				subtotal = (this.perchase.items[i].qty * this.perchase.items[i].buy) - ((this.perchase.items[i].discount * this.perchase.items[i].qty * this.perchase.items[i].buy) / 100);
				if(this.perchase.items[i].description != '' && subtotal > 0){
					total += subtotal;
				}
			}
			return total;
		},
		TotalPayment: function() {
			
			var total = 0;
			// Condition
			for(i=0;i<this.select.length;i++){
			 	total += this.payment.suppliers[this.select[i]];
			}
			return total;
		},
		Total: function() {
			// Load Stocks
			var total = this.subTotal;
			// Condition
			for(i=0;i<this.perchase.conditions.length;i++){
			 	total -= this.perchase.conditions[i].value;
			}
			// Tax
			total += ((total * this.perchase.tax) / 100);
			// Shipping
			total += this.perchase.shipping_cost;
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

		setsupplier: function(supplier) {
			// Load Stocks
			this.perchase.supplier = JSON.parse(JSON.stringify(supplier));
		},

		setUser: function(user) {
			// Load Stocks
			this.perchase.user = JSON.parse(JSON.stringify(user));
		},

		setChalan: function(chalan) { 
			// Load Stocks
			chalan.conditions = []; 
			chalan.tax = 0;
			chalan.shipping_cost = 0;
			this.perchase = JSON.parse(JSON.stringify(chalan));
			
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
	    	this.perchase.items.push({brand:'', description:'', unit: 'Unit', qty: 1, buy: 0, discount:0});
		},

		addItem: function(point,qty,discount,dbproduct) {
			// Load Stocks
			var item = JSON.parse(JSON.stringify(dbproduct));
			item.product_id = dbproduct.id;
			item.qty = qty;
			item.discount = discount;
	    	this.perchase.items.splice(point, 1, item);
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
	    	this.perchase.conditions.push({description:description, value: value});
			this.condition = {};
			$('#conditionModal').modal('hide');
		},

		saveperchase: function() {
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
						var perchase = self.perchase;
						perchase.subtotal = self.subTotal;
						perchase.total = self.Total;
						$.ajax({
							url: url + "/perchases",
							type: 'POST',
							dataType: "json",
							data: {
								_token: csrf,
								_method: 'PUT',
								perchase: perchase 
							},
							success: function(result){
								self.loader='false';
								self.errors=[];
								self.products = result['products'];
								self.suppliers = result['suppliers'];
								self.perchases = result['perchases'];
								self.perchase = {supplier:{}, user:{}, items:[], conditions:[], shipping_cost: 0, tax: 0};
								self.print_id = result['data']['id'];
								self.page = "printperchase";
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
							url: url + "/perchases",
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
								self.suppliers = result['suppliers'];
								self.perchases = result['perchases'];
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
							url: url + "/perchases",
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
								self.perchases=result['perchases'];
								self.products=result['products'];
								self.suppliers=result['suppliers'];
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
							url: url + "/perchases",
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
								self.suppliers = result['suppliers'];
								self.accounts = result['accounts'];
								self.payments = result['payments'];
								self.select = [];
								self.payment = {suppliers:[], account:{}};
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