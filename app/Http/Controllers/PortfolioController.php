<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;

class PortfolioController extends Controller
{
    public function listPortfolio()
    {
    	$model = Portfolio::all();
    	return $model;
    }

    public function addPortfolio(Request $request)
    {
    	$model = new Portfolio;
        $model->fill($request->except(['token']));
        $model->save();
        return response()->json(['status'=>true,'message'=>'Portfolio created successfully','data'=>$model]);
    }

    public function editPortfolio($id)
    {
    	$model = Portfolio::find($id);
    	return $model;
    }

    public function updatePortfolio(Request $request,$id)
    {	
		$model = Portfolio::find($id);
		$model->fill($request->except(['token']));
		$model->save();
		return response()->json(['status'=>true,'message'=>'Portfolio updated successfully','data'=>$model]);
    }

    public function deletePortfolio($id)
    {
    	$model = Portfolio::find($id);
        $model->delete();
        return response()->json(['status'=>true,'message'=>'Portfolio deleted successfully','data'=>$model]);
    }

}
