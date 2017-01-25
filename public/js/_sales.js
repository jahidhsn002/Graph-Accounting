
Vue.component('sales', {
	template:"#sales",
	props: {
		sales:[], customers:[], products:[], accounts:[], payments:[], loader: '', users:[]
	},
	data: function () {
		return {
			sale: {customer:{}, user:{}, items:[], conditions:[], account:{}},
			condition: {},
			search: {date:'', number:''},
			page:'sales',
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
			for(i=0;i<this.sale.items.length;i++){
				subtotal = (this.sale.items[i].qty * this.sale.items[i].sell) - ((this.sale.items[i].discount * this.sale.items[i].qty * this.sale.items[i].sell) / 100);
				if(this.sale.items[i].description != '' && subtotal > 0){
					total += subtotal;
				}
			}
			return total;
		},
		Total: function() {
			// Load Stocks
			var total = this.subTotal;
			// Condition
			for(i=0;i<this.sale.conditions.length;i++){
			 	total -= this.sale.conditions[i].value;
			}
			// Tax
			total += ((total * this.sale.vat) / 100);
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

		setCustomer: function(customer) {
			// Load Stocks
			this.sale.customer = JSON.parse(JSON.stringify(customer));
		},

		setUser: function(user) {
			// Load Stocks
			this.sale.user = JSON.parse(JSON.stringify(user));
		},

		setAccount: function(account) {
			// Load Stocks
			this.sale.account = JSON.parse(JSON.stringify(account));
		},

		setItem: function(customer) {
			// Load Stocks
	    	this.sale.items.push({brand:'', description:'', unit: 'Unit', qty: 1, sell: 0, discount:0});
		},

		addItem: function(point,qty,discount,dbproduct) {
			// Load Stocks
			var item = JSON.parse(JSON.stringify(dbproduct));
			item.product_id = dbproduct.id;
			item.qty = qty;
			item.discount = discount;
	    	this.sale.items.splice(point, 1, item);
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
	    	this.sale.conditions.push({description:description, value: value});
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
						var sale = self.sale;
						sale.subtotal = self.subTotal;
						sale.total = self.Total;
						$.ajax({
							url: url + "/sales",
							type: 'POST',
							dataType: "json",
							data: {
								_token: csrf,
								_method: 'PUT',
								sale: sale 
							},
							success: function(result){
								self.loader='false';
								self.errors=[];
								self.products = result['products'];
								self.customers = result['customers'];
								self.sales = result['sales'];
								self.payments = result['payments'];
								self.sale = {customer:{}, user:{}, items:[], conditions:[], account:{}, shipping_cost: 0, tax: 0};
								self.print_id = result['data']['id'];
								self.page = "printSales";
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
							url: url + "/sales",
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
								self.sales=result['sales'];
								self.products=result['products'];
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