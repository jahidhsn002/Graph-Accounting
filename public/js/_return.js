
Vue.component('returns', {
	template:"#returns",
	props: {
		returns:[], customers:[], suppliers:[], products:[], accounts:[], payments:[], loader: ''
	},
	data: function () {
		return {
			breturn: {supplier:{}, customer:{}, items:[], account:{}, type:'Sale'},
			condition: {},
			search: {date:'', number:''},
			page:'returns',
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
			for(i=0;i<this.breturn.items.length;i++){
				subtotal = (this.breturn.items[i].qty * this.breturn.items[i].sell) - ((this.breturn.items[i].discount * this.breturn.items[i].qty * this.breturn.items[i].sell) / 100);
				if(this.breturn.items[i].description != '' && subtotal > 0){
					total += subtotal;
				}
			}
			return total;
		},
		Total: function() {
			// Load Stocks
			var total = this.subTotal;
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
			this.breturn.customer = JSON.parse(JSON.stringify(customer));
		},

		setSupplier: function(supplier) {
			// Load Stocks
			this.breturn.supplier = JSON.parse(JSON.stringify(supplier));
		},

		setAccount: function(account) {
			// Load Stocks
			this.breturn.account = JSON.parse(JSON.stringify(account));
		},

		setItem: function() {
			// Load Stocks
	    	this.breturn.items.push({brand:'', description:'', unit: 'Unit', qty: 1, sell: 0, discount:0});
		},

		addItem: function(point,qty,discount,dbproduct) {
			// Load Stocks
			var item = JSON.parse(JSON.stringify(dbproduct));
			item.product_id = dbproduct.id;
			item.qty = qty;
			item.discount = discount;
	    	this.breturn.items.splice(point, 1, item);
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
						var breturn = self.breturn;
						breturn.subtotal = self.subTotal;
						breturn.total = self.Total;
						$.ajax({
							url: url + "/returns",
							type: 'POST',
							dataType: "json",
							data: {
								_token: csrf,
								_method: 'PUT',
								return: breturn 
							},
							success: function(result){
								self.loader='false';
								self.errors=[];
								self.products = result['products'];
								self.customers = result['customers'];
								self.suppliers = result['suppliers'];
								self.returns = result['returns'];
								self.payments = result['payments'];
								self.breturn = {supplier:{}, customer:{}, items:[], account:{}, type:'Sale'};
								self.print_id = result['data']['id'];
								self.page = "printreturns";
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
							url: url + "/returns",
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
								self.returns=result['returns'];
								self.products=result['products'];
								self.payments=result['payments'];
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