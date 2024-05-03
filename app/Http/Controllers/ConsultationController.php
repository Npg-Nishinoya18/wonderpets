<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serviceinfo;
use App\Models\User;
use App\Models\Consultation;
use App\Models\Pet;
use App\Models\Employee;
use App\Mail\ConsultMail;
use Spatie\Searchable\Search;
use Auth;
use View;
use Redirect;
use Session;
use DB;
use Validator;
use Mail;
use Carbon;

class ConsultationController extends Controller
{
    public function index(){
        $consultations = DB::select('select checkups.*, pets.name AS petname, serviceinfos.date_serviced, users.name AS vetname from users, checkups inner join serviceinfos on serviceinfos.id= checkups.serviceinfos_id inner join pets on pets.id=checkups.pet_id where users.id=serviceinfos.user_id');
        return View::make('consultation.index',compact('consultations')) ;
    }

    public function create()
    {   
        $user = User::all();
        $pets = Pet::all();
        $consultations = Consultation::all();
        return View::make('consultation.create', compact('user', 'pets', 'consultations'));
    }


    public function store(Request $request)
    {
        try{
            $employee = User::where('id', Auth::id())->first();
                DB::beginTransaction();

                $dateserviced = now();
     
                $serviceinfo_id = new Serviceinfo;
                $serviceinfo_id->users()->associate($employee);
                $serviceinfo_id->date_serviced = $dateserviced;
                $serviceinfo_id->save();

                $consultations = new Consultation;
                $consultations->serviceinfo()->associate($serviceinfo_id);
                $consultations->diseases_injuries = $request->diseases_injuries;
                $consultations->comment = $request->comment;
                $consultations->pet_id = $request->pet_id;
                $consultations->cost = $request->cost;
                $consultations->save();
            }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
        DB::commit();

        $owner = DB::table('pets')
            ->join('pet_user','pets.id','pet_user.pet_id')
            ->join('users','users.id','pet_user.user_id')
            ->select('users.name')
            ->where('pets.id','=', $request->pet_id)
            ->first();
        
        $petname = DB::table('pets')->select('name')->where('id', $request->pet_id)->first();

        $data = array(
        'petname'   => $petname,
        'owner'   => $owner,
        'cost'   =>  $request->cost,
        'diseases_injuries' => $request->diseases_injuries,
        'comment'   =>  $request->comment,
        );

        Mail::to('administrator@bands.com.ph')->send(new ConsultMail($data));

        return redirect()->route('consultation.index')->with('success','Successfully Consulted your Pet! Check your Email for Result');
    }

    public function restore($id) 
    {
        Consultation::withTrashed()->where('id',$id)->restore();
        return  Redirect::route('consultation.index')->with('success','Consultation Details Restored Successfully!');
    }

    public function show($id)
    {
        $pet = Pet::findOrFail($id);
        $checkup = Consultation::findOrFail($id);
        $serviceinfo = Serviceinfo::findOrFail($id);
        $user = User::findOrFail($id);
        return View::make('consultation.show',compact('pet','user', 'checkup', 'serviceinfo'));
    }

    public function search(Request $request){
        $search = $request->get('search');
        $medhistory = Consultation::query()
            ->join('serviceinfos','serviceinfos.id','checkups.serviceinfos_id')
            ->join('users','users.id','serviceinfos.user_id')
            ->join('pets','pets.id','checkups.pet_id')
            ->select('pets.name', 'pets.id AS petID', 'users.name AS vetName', 'checkups.*','serviceinfos.*')
            ->where('pets.name', 'LIKE', "%{$search}%")
            ->orWhere('pets.id', 'LIKE', "%{$search}%")
            ->get();
    // Return the search view with the resluts compacted
    return view('search',compact('medhistory'));
    }
}