<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryStoreRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    //
    public function index(Request $request){
        $countries=Country::all();
        if($request->has('search')){
            $countries=Country::where('country_code','like',"%{$request->search}%")->orwhere('name','like',"%{$request->search}%")->get();
        }
        return view('countries.index',compact('countries'));
    }
    public function create(){
        return view('countries.create');
    }
    public function store(CountryStoreRequest $request){
        Country::create($request->validated());
        return redirect()->route('countries.index')->with('message','Country Created Successfully');        
    }
}