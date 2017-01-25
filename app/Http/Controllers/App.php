<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;

use App\Invoice;
use App\Product;
use App\Customer;
use App\Offer;
use App\Chalan;
use App\Sale;
use App\Account;
use App\Perchase;
use App\Dbreturn;
use App\Supplier;
use App\Stock;
use App\Payment;
use App\Transection;

use App\Owner;
use App\Assetaccount;
use App\Expenseaccount;
use App\Loanaccount;

use App\Asset;
use App\Capital;
use App\Drawing;
use App\Expense;
use App\Loan;

use App\Employe; 
use App\Wage;
use App\Dbwage;

use App\Service;
use App\Estimate;
use App\Job;

use App\User;

class App extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    
    public function Index(){
    	//print_r(Invoice::where('id', 4450)->count());
		return view('index');
	}

	public function Get(){
		return $this->DataReturn('Blank');
	}

	public function DataReturn($data){
		$Invoices = Invoice::all();
		$Products = Product::all();
		$Customers = Customer::all();
		$Suppliers = Supplier::all();
		$Chalans = Chalan::all();
		$Offers = Offer::all();
		$Sales = Sale::all();
		$Returns = Dbreturn::all();
		$Perchases = Perchase::all();
		$Accounts = Account::all();
		$Payments = Payment::all();
		$Stocks = Stock::all();

		$Owners = Owner::all();
		$Assetaccounts = Assetaccount::all();
		$Expenseaccounts = Expenseaccount::all();
		$Loanaccounts = Loanaccount::all();

		$Assets = Asset::all();
		$Capitals = Capital::all();
		$Drawings = Drawing::all();
		$Expenses = Expense::all();
		$Loans = Loan::all();

		$Employes = Employe::all();
		$Wages = Wage::all();
		$Dbwages = Dbwage::all();
		
		$Services = Service::all();
		$Estimates = Estimate::all();
		$Jobs = Job::all();

		$Users = User::all();

		foreach($Customers as $Customer){
			$Customer->transections;
		}
		foreach($Suppliers as $Supplier){
			$Supplier->transections;
		}
		foreach($Invoices as $Invoice){
			$Invoice->items;
			$Invoice->conditions;
			$Invoice->customer;
			$Invoice->user;
		}
		foreach($Offers as $Offer){
			$Offer->items;
			$Offer->conditions;
			$Offer->customer;
		}
		foreach($Chalans as $Chalan){
			$Chalan->items;
			$Chalan->customer;
		}
		foreach($Sales as $Sale){
			$Sale->items;
			$Sale->conditions;
			$Sale->customer;
			$Sale->user;
		}
		foreach($Returns as $Return){
			$Return->items;
			$Return->customer;
			$Return->supplier;
		}
		foreach($Perchases as $Perchase){
			$Perchase->items;
			$Perchase->conditions;
			$Perchase->supplier;
			$Perchase->user;
		}
		foreach($Accounts as $Account){
			$Account->payments;
		}
		foreach($Payments as $Payment){
			$Payment->account;
		}
		foreach($Products as $Product){
			$Product->stock;
			foreach($Product->items as $Item){
				$Item->service;
				if($Item->service != null){
					$Item->service->customer;
				}
				$Item->estimate;
				if($Item->estimate != null){
					$Item->estimate->customer;
				}
				$Item->perchase;
				if($Item->perchase != null){
					$Item->perchase->supplier;
				}
				$Item->invoice;
				if($Item->invoice != null){
					$Item->invoice->customer;
				}
				$Item->sale;
				if($Item->sale != null){
					$Item->sale->customer;
				}
			}
		}

		foreach($Assets as $Asset){
			$Asset->assetaccount;
		}
		foreach($Expenses as $Expense){
			$Expense->expenseaccount;
		}
		foreach($Loans as $Loan){
			$Loan->loanaccount;
		}
		foreach($Capitals as $Capital){
			$Capital->owner;
		}
		foreach($Drawings as $Drawing){
			$Drawing->owner;
		}
		foreach($Wages as $Wage){
			$Wage->transections;
			foreach($Wage->dbwages as $Dbwage){
				$Dbwage->employe;
			}
		}
		foreach($Dbwages as $Dbwage){
			$Dbwage->employe;
		}
		foreach($Employes as $Employe){
			$Employe->transections;
		}
		
		foreach($Services as $Service){
			$Service->items;
			$Service->jobs;
			$Service->customer;
			$Service->transections;
			$Service->user;
			$Service->conditions;
		}

		foreach($Estimates as $Estimate){
			$Estimate->items;
			$Estimate->jobs;
			$Estimate->customer;
			$Estimate->transections;
			$Estimate->user;
			$Estimate->conditions;
		}

		return [
			'invoices'=>$Invoices->toArray(),
			'offers'=>$Offers->toArray(),
			'chalans'=>$Chalans->toArray(),
			'products'=>$Products->toArray(),
			'customers'=>$Customers->toArray(),
			'sales'=>$Sales->toArray(),
			'returns'=>$Returns->toArray(),
			'accounts'=>$Accounts->toArray(),
			'perchases'=>$Perchases->toArray(),
			'suppliers'=>$Suppliers->toArray(),
			'payments'=>$Payments->toArray(),
			'data'=> $data,

			'owners'=>$Owners->toArray(),
			'assetaccounts'=>$Assetaccounts->toArray(),
			'expenseaccounts'=>$Expenseaccounts->toArray(),
			'loanaccounts'=>$Loanaccounts->toArray(),

			'assets'=>$Assets->toArray(),
			'capitals'=>$Capitals->toArray(),
			'drawings'=>$Drawings->toArray(),
			'expenses'=>$Expenses->toArray(),
			'loans'=>$Loans->toArray(),

			'employes'=>$Employes->toArray(),
			'wages'=>$Wages->toArray(),
			'dbwages'=>$Dbwages->toArray(),
			
			'services'=>$Services->toArray(),
			'estimates'=>$Estimates->toArray(),
			'jobs'=>$Jobs->toArray(),

			'users'=>$Users->toArray()
		];
	}

	public function Login(Request $request){
	  	if (Auth::check()) {
		  	$user = Auth::user();
		    $data['user'] = $user;
		    $data['response'] = 'Log In Succeeded';
			return response()->json($data);
		}else{
			$this->validate($request, [
		        'user.email' => 'required|max:100',
		        'user.password' => 'required|max:100',
		        'user.remember' => 'required|max:100'
		    ]);
		  	if (Auth::attempt([
		  		'email' => $request['user.email'],
		  		'password' => $request['user.password']
		  		], $request['user.remember'])
		  	){
		      	$user = Auth::user();
		      	$data['user'] = $user;
		      	$data['response'] = 'Log In Succeeded';
			    return response()->json($data);
			}else{
				$data['response'] = 'Wrong Creadential';
				return response()->json($data, 422);
			}
		}

	}

	public function Logout(Request $request){
	    Auth::logout();
	    $data['response'] = 'Logged Out';
	    return response()->json($data);
	}

}
