Vue.component('users', { 
	template:"#user",
	props: {
		users:[], loader: ''
	},
	data: function () {
		return {
			search: {name:''},
			element: {},
			select: [],
			errors: []
		}
	},
	methods: {
	    Select: function (id) {
	    	if(this.select.indexOf(id)==-1){
	    		this.select.push(id);
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
							url: url + "/api/users",
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
								self.users=result['users'];
								self.select=[];
								self.element={};
								$('#users').modal('toggle');
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
							url: url + "/api/users",
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
								self.users=result['users'];
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