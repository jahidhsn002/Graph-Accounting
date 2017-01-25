<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product;
use App\Stock;

class AppProduct extends App
{
	

    public function Change(Request $request){

        $this->validate($request, [
        	'element.iban' => 'max:100|string',
            'element.description' => 'required|max:250|string',
            'element.brand' => 'max:250|string',
            'element.buy' => 'required|min:0|numeric',
            'element.sell' => 'required|min:0|numeric',
            'element.unit' => 'required|max:25|string',
            'element.stock.qty' => 'required|numeric'
        ]);

        $buy=$sell=$stock=0;
        $iban=$description=$unit=$brand='';
        if($request['element.iban']){ $iban = $request['element.iban']; }
        if($request['element.description']){ $description = $request['element.description']; }
        if($request['element.brand']){ $brand = $request['element.brand']; }
        if($request['element.unit']){ $unit = $request['element.unit']; }
        if($request['element.buy']){ $buy = $request['element.buy']; }
        if($request['element.sell']){ $sell = $request['element.sell']; }
        if($request['element.stock.qty']){ $stock = $request['element.stock.qty']; }

        if(is_array($request['select'])){

            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:products,id'
                ]);

                //Check Ability
                $Product = Product::find($request['select.'.$i]);
            }
            for ($i=0;$i<count($request['select']);$i++) {
                
                $Product = Product::find($request['select.'.$i]);
                $Product->iban=$iban;
                $Product->brand=$brand;
                $Product->buy=$buy;
                $Product->sell=$sell;
                $Product->unit=$unit;
                $Product->description=$description;
                $Product->save();

                $Stock = Stock::find($Product->stock_id);
                $Stock->qty = $stock;
                $Stock->save();

            }

        }else{

            $Stock = new Stock();
            $Stock->qty = $stock;
            $Stock->save();

            $Product = new Product();
            $Product->iban=$iban;
            $Product->stock_id=$Stock->id;
            $Product->brand=$brand;
            $Product->buy=$buy;
            $Product->sell=$sell;
            $Product->unit=$unit;
            $Product->description=$description;
            $Product->save();
        }
        return $this->DataReturn('blank');
    }

    public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:products,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Product = Product::find($request['select.'.$i]);
                $Stock = Stock::find($Product->stock_id);
                $Product->delete();
                $Stock->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
