
Vue.component('slip', {
	template:"#slip",
	props: {
		data:{}, template:'', type:''
	},
	data: function () {
		return {
			header: false
		}
	},
	methods: {

		totalServicesVat: function (services, amount, vatrate) {
			var total = 0;
			var vat = 0;
			total += Number(this.totalServices(services)) + Number(amount);
			vat = (total*vatrate)/100 ;
			return vat.toFixed(2);
		},

		totalServices: function (services) {
			var total = 0;
			for(i=0;i<services.length;i++){
				total += services[i].value;
			}
			return total.toFixed(2);
		},

		integerToWord: function (integer) {
			var ONE_THOUSAND = Math.pow(10, 3);
			var ONE_MILLION = Math.pow(10, 6);
			var ONE_BILLION = Math.pow(10, 9);
			var ONE_TRILLION = Math.pow(10, 12);
			var ONE_QUADRILLION = Math.pow(10, 15);
			var ONE_QUINTILLION = Math.pow(10, 18);
		  	var prefix = '';
		  	var suffix = '';

		  if (!integer){ return "zero"; }
		  
		  if(integer < 0){
		    prefix = "negative";
		    suffix = this.integerToWord(-1 * integer);
		    return prefix + " " + suffix;
		  }
		  if(integer <= 90){
		    switch (integer) {
		      case integer < 0:
		        prefix = "negative";
		        suffix = this.integerToWord(-1 * integer);
		        return prefix + " "  + suffix;
		      case 1: return "one";
		      case 2: return "two";
		      case 3: return "three";
		      case 4:  return "four";
		      case 5: return "five";
		      case 6: return "six";
		      case 7: return "seven";
		      case 8: return "eight";
		      case 9: return "nine";
		      case 10: return "ten";
		      case 11: return "eleven";
		      case 12: return "twelve";
		      case 13: return "thirteen";
		      case 14: return "fourteen";
		      case 15: return "fifteen";
		      case 16: return "sixteen";
		      case 17: return "seventeen";
		      case 18: return "eighteen";
		      case 19: return "nineteen";
		      case 20: return "twenty";
		      case 30: return "thirty";
		      case 40: return "forty";
		      case 50: return "fifty";
		      case 60: return "sixty";
		      case 70: return "seventy";
		      case 80: return "eighty";
		      case 90: return "ninety";
		      default: break;
		    }
		  }

		  if(integer < 100){
		    prefix = this.integerToWord(integer - integer % 10);
		    suffix = this.integerToWord(integer % 10);
		    return prefix + "-"  + suffix;
		  }

		  if(integer < ONE_THOUSAND){
		    prefix = this.integerToWord(parseInt(Math.floor(integer / 100), 10) )  + " hundred";
		    if (integer % 100){ suffix = " and "  + this.integerToWord(integer % 100); }
		    return prefix + suffix;
		  }

		  if(integer < ONE_MILLION){
		    prefix = this.integerToWord(parseInt(Math.floor(integer / ONE_THOUSAND), 10))  + " thousand";
		    if (integer % ONE_THOUSAND){ suffix = this.integerToWord(integer % ONE_THOUSAND); }
		  }
		  else if(integer < ONE_BILLION){
		    prefix = this.integerToWord(parseInt(Math.floor(integer / ONE_MILLION), 10))  + " million";
		    if (integer % ONE_MILLION){ suffix = this.integerToWord(integer % ONE_MILLION); }
		  }
		  else if(integer < ONE_TRILLION){
		    prefix = this.integerToWord(parseInt(Math.floor(integer / ONE_BILLION), 10))  + " billion";
		    if (integer % ONE_BILLION){ suffix = this.integerToWord(integer % ONE_BILLION); }
		  }
		  else if(integer < ONE_QUADRILLION){
		    prefix = this.integerToWord(parseInt(Math.floor(integer / ONE_TRILLION), 10))  + " trillion";
		    if (integer % ONE_TRILLION){ suffix = this.integerToWord(integer % ONE_TRILLION); }
		  }
		  else if(integer < ONE_QUINTILLION){
		    prefix = this.integerToWord(parseInt(Math.floor(integer / ONE_QUADRILLION), 10))  + " quadrillion";
		    if (integer % ONE_QUADRILLION){ suffix = this.integerToWord(integer % ONE_QUADRILLION); }
		  } else {
		    return '';
		  }
		  return prefix + " "  + suffix;
		},

		moneyToWord: function(value){
			var ONE_THOUSAND = Math.pow(10, 3);
			var ONE_MILLION = Math.pow(10, 6);
			var ONE_BILLION = Math.pow(10, 9);
			var ONE_TRILLION = Math.pow(10, 12);
			var ONE_QUADRILLION = Math.pow(10, 15);
			var ONE_QUINTILLION = Math.pow(10, 18);
		  	var decimalValue = (value % 1);
		  	var integer = value - decimalValue;
		  	decimalValue = Math.round(decimalValue * 100);
		  	var decimalText = !decimalValue? '': this.integerToWord(decimalValue) + ' Paisa' + (decimalValue === 1? '': '');
		  	var integerText= !integer? '': this.integerToWord(integer) + ' Taka' + (integer === 1? '': '');
		  	return (
		    	integer && !decimalValue? integerText:
		    	integer && decimalValue? integerText + ' and ' + decimalText:
		   		!integer && decimalValue? decimalText:
		    	'zero cents'
		  	);
		},

		floatToWord: function(value){
			var ONE_THOUSAND = Math.pow(10, 3);
			var ONE_MILLION = Math.pow(10, 6);
			var ONE_BILLION = Math.pow(10, 9);
			var ONE_TRILLION = Math.pow(10, 12);
			var ONE_QUADRILLION = Math.pow(10, 15);
			var ONE_QUINTILLION = Math.pow(10, 18);
			var decimalValue = (value % 1);
			var integer = value - decimalValue;
			decimalValue = Math.round(decimalValue * 100);
			var decimalText = !decimalValue? '':
			    decimalValue < 10? "point o' " + this.integerToWord(decimalValue):
			    decimalValue % 10 === 0? 'point ' + this.integerToWord(decimalValue / 10):
			    'point ' + this.integerToWord(decimalValue);
			return (
			    integer && !decimalValue? this.integerToWord(integer):
			    integer && decimalValue? [this.integerToWord(integer),  decimalText].join(' '):
			    !integer && decimalValue? decimalText:
			    this.integerToWord(0)
			);
		}
	}
});