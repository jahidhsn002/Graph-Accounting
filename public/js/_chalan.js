
Vue.component('chalan', {
	template:"#chalan",
	props: {
		chalans:[], customers:[], products:[], loader: ''
	},
	data: function () {
		return {
			chalan: {customer:{}, items:[]},
			search: {date:'', offer:'', company:'', name:'', phone:'', note:''},
			page:'chalan',
			print_id: 0,
			Extelement: {},
			Extselect: [],
			errors: []
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

	    addItem: function(point,qty,discount,dbproduct) {
			// Load Stocks
			var item = JSON.parse(JSON.stringify(dbproduct));
			item.product_id = dbproduct.id;
			item.qty = qty;
	    	this.chalan.items.splice(point, 1, item);
		},

		setCustomer: function(customer) {
			// Load Stocks
			this.chalan.customer = JSON.parse(JSON.stringify(customer));
		},

		setItem: function(customer) {
			// Load Stocks
	    	this.chalan.items.push({description:'', brand:'', unit:'Unit', qty: 1, sell: 0});
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
						var chalan = self.chalan;
						chalan.subtotal = self.subTotal;
						chalan.total = self.Total;
						$.ajax({
							url: url + "/chalans",
							type: 'POST',
							dataType: "json",
							data: {
								_token: csrf,
								_method: 'PUT',
								chalan: chalan 
							},
							success: function(result){
								self.loader='false';
								self.errors=[];
								self.products = result['products'];
								self.customers = result['customers'];
								self.chalans = result['chalans'];
								self.chalan = {customer:{}, items:[], shipping_cost: 0, tax: 0};
								self.print_id = result['data']['id'];
								self.page = "printChalan";
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
							url: url + "/chalans",
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
								self.chalans=result['chalans'];
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