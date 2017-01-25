Vue.component('customer', {
	template: "#customer",
	props: {
		customers:[], loader: ''
	},
	data: function () {
		return {
			search: {name:'', company:'', phone:''},
			element: {},
			select: [],
			errors: []
		}
	},
	methods: {
	    Select: function (id, customer) {
	    	if(this.select.indexOf(id)==-1){
	    		this.select.push(id);
	    		this.element = JSON.parse(JSON.stringify(customer));
	    	}else{
	    		this.select.splice(this.select.indexOf(id),1);
	    	}
	    },
	    Save: function () {
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
							url: url + "/api/customers",
							type: 'POST',
							dataType: "json",
							data: {
								_token: csrf,
								_method: 'PUT',
								select: self.select,
								element: self.element
							},
							success: function(result){
								self.loader='false';
								self.errors=[];
								self.customers=result['customers'];
								self.select=[];
								self.element={};
								$('#customers').modal('toggle');
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
							url: url + "/api/customers",
							type: 'POST',
							dataType: "json",
							data: {
								_token: csrf,
								_method: 'DELETE',
								select: self.select
							},
							success: function(result){
								self.loader='false';
								self.errors=[];
								self.customers=result['customers'];
								self.select=[];
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