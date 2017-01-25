
Vue.component('offer', {
	template:"#offer",
	props: {
		offers:[], customers:[], products:[], loader: ''
	},
	data: function () {
		return {
			offer: {customer:{}, items:[], conditions:[]},
			condition: {},
			Extelement: {},
			search: {date:'', offer:'', company:'', name:'', phone:'', note:''},
			page:'offer',
			print_id: 0,
			Extselect: [],
			errors: []
		}
	}, 
	computed: {
		subTotal: function() {
			// Load Stocks
			var total = 0;
			var subtotal = 0;
			for(i=0;i<this.offer.items.length;i++){
				subtotal = (this.offer.items[i].qty * this.offer.items[i].sell) - ((this.offer.items[i].discount * this.offer.items[i].qty * this.offer.items[i].sell) / 100);
				if(this.offer.items[i].description != '' && subtotal > 0){
					total += subtotal;
				}
			}
			return total;
		},
		Total: function() {
			// Load Stocks
			var total = this.subTotal;
			// Condition
			for(i=0;i<this.offer.conditions.length;i++){
			 	total -= this.offer.conditions[i].value;
			}
			// Tax
			total += ((total * this.offer.vat) / 100);
			// Shipping
			total += this.offer.shipping_cost;
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

		setCustomer: function(customer) {
			// Load Stocks
			this.offer.customer = JSON.parse(JSON.stringify(customer));
		},

		setItem: function(customer) {
			// Load Stocks
	    	this.offer.items.push({brand:'', description:'', unit: 'Unit', qty: 1, sell: 0, discount:0});
		},

		addItem: function(point,qty,discount,dbproduct) {
			// Load Stocks
			var item = JSON.parse(JSON.stringify(dbproduct));
			item.product_id = dbproduct.id;
			item.qty = qty;
			item.discount = discount;
	    	this.offer.items.splice(point, 1, item);
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
	    	this.offer.conditions.push({description:description, value: value});
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
						var offer = self.offer;
						offer.subtotal = self.subTotal;
						offer.total = self.Total;
						$.ajax({
							url: url + "/offers",
							type: 'POST',
							dataType: "json",
							data: {
								_token: csrf,
								_method: 'PUT',
								offer: offer 
							},
							success: function(result){
								self.loader='false';
								self.errors=[];
								self.products = result['products'];
								self.customers = result['customers'];
								self.offers = result['offers'];
								self.offer = {customer:{}, items:[], conditions:[], shipping_cost: 0, tax: 0};
								self.print_id = result['data']['id'];
								self.page = "printOffer";
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
							url: url + "/offers",
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
								self.offers=result['offers'];
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