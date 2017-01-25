 
Vue.component('ledgerorder', {
	template:"#ledgerorder",
	props: {
		setdatas:[], db:'', catdb:'', state:'', title:'', category_title:'', products:[], loader:'', meta:'False'
	},
	data: function () {
		return {
			search: {start:'', end:'', user:''},
			errors: [],
			Extelement: {},
			Extselect: []
		}
	},
	computed: {
		datas: function() {
			// Load Stocks
			var datas = [];
			for(i=0; i < this.setdatas.length; i++){
				if(this.meta == 'True'){
					if(this.setdatas[i].status == 'Delivered' && this.IntDate(this.setdatas[i].date) <= this.IntDate(this.search.start) && this.IntDate(this.setdatas[i].date) >= this.IntDate(this.search.end)){
						datas.push(this.setdatas[i]);
					}
				}else{
					if(this.search.user == null || this.search.user == ''){
						if(this.IntDate(this.setdatas[i].date) <= this.IntDate(this.search.start) && this.IntDate(this.setdatas[i].date) >= this.IntDate(this.search.end)){
							datas.push(this.setdatas[i]);
						}
					}else{
						if(this.setdatas[i].user != null){
							if(this.setdatas[i].user.name.search(this.search.user) != -1 && this.IntDate(this.setdatas[i].date) <= this.IntDate(this.search.start) && this.IntDate(this.setdatas[i].date) >= this.IntDate(this.search.end)){
								datas.push(this.setdatas[i]);
							}
						}
					}
				}
				
			}
	    	return datas;
		},

		totalDebit: function() {
			// Load Stocks
			var total = 0;
			for(i=0; i < this.datas.length; i++){
				if(this.state == 'Debit'){
					total += Number(this.datas[i].total);
				}
			}
	    	return total.toFixed(2);
		},

		totalCredit: function() {
			// Load Stocks
			var total = 0;
			for(i=0; i < this.datas.length; i++){
				if(this.state == 'Credit'){
					total += Number(this.datas[i].total);
				}
			}
	    	return total.toFixed(2);
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

		IntDate: function(theDate) {
			// Load Stocks
			var myDate=theDate.split("/");
			var newDate=myDate[1]+","+myDate[2]+","+myDate[0];
			intDate = new Date(newDate).getTime();
	    	return intDate;
		},

		ExtSelect: function (id, product) {
	    	if(this.Extselect.indexOf(id)==-1){
	    		this.Extselect.push(id);
	    		this.Extelement = JSON.parse(JSON.stringify(product));
	    	}else{
	    		this.Extselect.splice(this.Extselect.indexOf(id),1);
	    	}
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
							url: url + "/" + self.db,
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
								self.setdatas = result[self.db];
								self.products = result['products'];
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