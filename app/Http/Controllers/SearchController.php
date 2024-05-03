<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Serviceinfo;
use App\Models\Pet;
use Spatie\Searchable\Search;
use DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {

    //  public function search(Request $request){
    //  $searchResults = (new Search())
    // ->registerModel(Item::class, 'description','cost_price','sell_price')
    // ->registerModel(Customer::class, 'lname','fname','addressline','town')
    // ->search($request->search);
    // // dd($searchResults);
    // // return view('item.search',compact('searchResults'));
    // return view('search',compact('searchResults'));
    // }

     // $searchResults = (new Search())
     //    // ->registerModel(Consulatation::class,'cost', 'diseases_injuries')
     //    ->registerModel(Serviceinfo::class, 'date_serviced')
     //    ->registerModel(Pet::class, 'name', 'type')
     //    ->registerModel(Consultation::class,'cost', 'diseases_injuries')
     //    ->search($request->get('search'));
     //    // dd($searchResults);

    //  public function search(Request $request){
    //  $searchResults = (new Search())
    // ->registerModel(Item::class, 'description','cost_price','sell_price')
    // ->registerModel(Customer::class, 'lname','fname','addressline','town')
    // ->search($request->search);
    // // dd($searchResults);
    // // return view('item.search',compact('searchResults'));
    // return view('search',compact('searchResults'));
    // }

    $search = $request->get('search');
    $medhistory = Consultation::query()
        ->join('serviceinfos','serviceinfos.id','checkups.serviceinfos_id')
        ->join('users','users.id','serviceinfos.user_id')
        ->join('pets','pets.id','checkups.pet_id')
        ->select('pets.name', 'pets.id AS petID', 'users.name AS vetName', 'checkups.*','serviceinfos.*')
        ->where('pets.name', 'LIKE', "%{$search}%")
        ->orWhere('pets.id', 'LIKE', "%{$search}%")
        ->get();

    $searchResults = (new Search())
        // ->registerModel(Consulatation::class,'cost', 'diseases_injuries')
        ->registerModel(Serviceinfo::class, 'date_serviced')
        ->registerModel(Pet::class, 'name', 'type')
        ->registerModel(Consultation::class,'cost', 'diseases_injuries')
        ->search($request->get('search'));
        // dd($searchResults);
        return view('search',compact('searchResults', 'medhistory'));
    }
}