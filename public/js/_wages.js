
Vue.component('wages', {
	template:"#wages",
	props: {
		wages:[], dbwages:[], employes:[], accounts:[], loader: '', payments:[]
	},
	data: function () {
		return {
			search: {date:'', number:''},
			payment: {invoices:[], account:{}},
			wage:{},
			dbwage:[],
			select: [],
			Extelement: {},
			Extselect: [],
			page:'allwages',
			print_id: 0,
			errors: []
		}
	}, 
	computed: {
		TotalPayment: function() {
			
			var total = 0;
			// Condition
			for(i=0;i<this.select.length;i++){
			 	total += this.payment.invoices[this.select[i]];
			}
			return total;
		},
		Total: function() {
			// Load Stocks
			var total = 0;
			// Condition
			for(i=0;i<this.dbwage.length;i++){
				total += this.dbwage[i].basic;
			 	total -= (( this.dbwage[i].basic * this.dbwage[i].absent) / 30 );
				total -= (( this.dbwage[i].basic * this.dbwage[i].late) / ( 30 * 3 ) );
			 	total += this.dbwage[i].tada;
			 	total += this.dbwage[i].bonus;
			 	total -= this.dbwage[i].advance;
			 	total -= this.dbwage[i].charge;
			}
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

		loadEmploye: function() {
			// Load Stocks
			for(i=0;i<this.employes.length;i++){
			 	this.dbwage.push({employe:this.employes[i]});
			}
			
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

		saveWages: function() {
			// Load Stocks
			var wage = this.wage;
			wage.total = this.Total;
			$.ajax({
				url: url + "/wages",
				type: 'POST',
				dataType: "json",
				data: {
					_token: csrf,
					_method: 'PUT',
					wage: wage,
					dbwages: this.dbwage
				},
				success: function(result){
					this.wages = result['wages'];
					this.dbwages = result['dbwages'];
					this.employes = result['employes'];
					this.wage = {};
					this.dbwage = [];
					this.print_id = result['data']['id'];
					this.page = "printwages";
			    }.bind(this)
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
							url: url + "/wages",
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
								self.wages=result['wages'];
								this.dbwages = result['dbwages'];
								this.employes = result['employes'];
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
			$.ajax({
				url: url + "/wages",
				type: 'POST',
				dataType: "json",
				data: {
					_token: csrf,
					_method: 'PATCH',
					payment: this.payment,
					select: this.select 
				},
				success: function(result){
					this.wages = result['wages'];
					this.dbwages = result['dbwages'];
					this.employes = result['employes'];
					this.accounts = result['accounts'];
					this.payments = result['payments'];
					this.select = [];
					this.payment = {invoices:[], account:{}};
			    	$('#Payment').modal('hide');
			    }.bind(this)
			});
		}
		
	}
});