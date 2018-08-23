<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;

class PortfolioController extends Controller
{
    public function listPortfolio()
    {
        $production_portfolios = Portfolio::whereNotNull('production_url')->get();
    	$development_portfolios = Portfolio::whereNotNull('development_url')->whereNull('production_url')->get();
    	return response()->json(['production_portfolios'=>$production_portfolios,'development_portfolios'=>$development_portfolios]);
    }

    public function addPortfolio(Request $request)
    {   
        $model = new Portfolio;
        if ($request->hasFile('fileItem')) {
            $image = $request->file('fileItem');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $model->image = $name;
        }
        if ($request->hasFile('projectFile')) {
            $image = $request->file('projectFile');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/projectBackup');
            $image->move($destinationPath, $name);
            $model->project_backup_file = $name;
        }
        if ($request->hasFile('dbFile')) {
            $image = $request->file('dbFile');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/databaseBackup');
            $image->move($destinationPath, $name);
            $model->database_backup_file = $name;
        }
        if ($request->hasFile('credentialFile')) {
            $image = $request->file('credentialFile');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/credentials');
            $image->move($destinationPath, $name);
            $model->credential_file = $name;
        }
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

    public function updateImage($id,Request $request)
    {  
        $model = Portfolio::find($id);
        if ($request->hasFile('fileItem')) {
            $image = $request->file('fileItem');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $model->image = $name;
        }
       
        $model->save();
        return response()->json(['status'=>true,'message'=>'Image updated successfully']);
    }
    public function removeImage($id)
    {
        $model = Portfolio::find($id);
        $model->image = null;
        $model->save();
        return response()->json(['status'=>true,'message'=>'deleted successfully']);
    }

}
