<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grooming;
use App\Models\Pet;
use App\Models\Groomingtransaction;
use App\Models\Employee;
use App\Models\Serviceinfo;
use App\Models\Customer;
use App\Models\User;
use App\Cart;

use Redirect;
use Validator;
use Session;
use Carbon;
use DB;
use Auth;
use View;
use Spatie\Searchable\Search;


class GroomingtransactionController extends Controller
{
    public function index(){
        $groomings = Grooming::all();
        return view('groomingtransaction.index', compact('groomings'));
    }

    public function getAddToCart(Request $request , $id){
        $groomings = Grooming::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($groomings, $groomings->id);
        Session::put('cart', $cart);
        Session::save();
        return redirect()->route('groomingtransaction.index');
    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('groomingtransaction.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        // $pets = Pet::all();
        $users = Auth::id();
        $pets = DB::table('pets')
            ->join('pet_user','pets.id','pet_user.pet_id')
            ->join('users','users.id','pet_user.user_id')
            ->select('pets.*', 'users.id AS userID')
            ->where('users.id','=', $users)
            ->orderBy('id','DESC')
            ->get();
        $user = User::all();

        return view('groomingtransaction.shopping-cart', ['groomings' => $cart->groomings, 'totalPrice' => $cart->totalPrice], compact('pets', 'user'));
    }

    public function getRemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->groomings) > 0) {
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
         return redirect()->route('groomingtransaction.shoppingCart');
    }

    public function postCheckout(Request $request){
        if (!Session::has('cart')) {
            return redirect()->route('groomingtransaction.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        try {
            DB::beginTransaction();
            $serviceinfo = new Serviceinfo();
            $employee = Auth::user()->id;
            $serviceinfo->user_id = $employee;
            // $serviceinfo->pet_id=$request->pet_id[$groomings['groomings']['id']];
            // pet_id[{{ $groomings['groomings']['id'] }}]
            $serviceinfo->date_serviced = now();
            $serviceinfo->save();
            
            foreach($cart->groomings as $groomings){
                $id = $groomings['groomings']['id'];
                DB::table('serviceinfos_groomings')->insert(
                    ['groomings_id' => $id, 
                     'serviceinfos_id' => $serviceinfo->id,
                     'pet_id'=> $request->pet_id[$groomings['groomings']['id']],
                     'status' => 'Pending'
                    ]
                    );
            }
        }
        catch (\Exception $e) {
           DB::rollback();
           return redirect()->route('groomingtransaction.shoppingCart')->with('error', $e->getMessage());
       }
        DB::commit();
        Session::forget('cart');
        return redirect()->route('groomingtransaction.receipt')->with('success','Successfully Serviced Your Pet!!!');
    }

     public function receipt(){
        $receipts = DB::table('serviceinfos_groomings')
        ->join('serviceinfos','serviceinfos.id','=', 'serviceinfos_groomings.serviceinfos_id')
        ->leftjoin('groomings','groomings.id','=','serviceinfos_groomings.groomings_id')
        ->leftjoin('users', 'users.id','=','serviceinfos.user_id')
        ->leftjoin('pet_user', 'pet_user.user_id','=','users.id')
        ->rightjoin('pets', 'pets.id','=','pet_user.pet_id')
        ->select('serviceinfos.id AS serviceID', 'serviceinfos.date_serviced AS date_Serviced','pets.Name AS petname' , 'groomings.title AS gsTitle','groomings.grooming_cost AS gsCost', 'users.name AS userName', 'users.id AS cusID')
        ->where('serviceinfos.id', DB::raw("(select max(serviceinfos.id) from serviceinfos)"))
        ->get();

        $total = DB::table('serviceinfos_groomings')
        ->join('serviceinfos','serviceinfos.id','=', 'serviceinfos_groomings.serviceinfos_id')
        ->leftjoin('groomings','groomings.id','=','serviceinfos_groomings.groomings_id')
        ->leftjoin('users', 'users.id','=','serviceinfos.user_id')
        ->leftjoin('pet_user', 'pet_user.user_id','=','users.id')
        ->rightjoin('pets', 'pets.id','=','pet_user.pet_id')
        ->select(DB::raw('SUM(groomings.grooming_cost) AS Total'))
        ->where('serviceinfos.id', DB::raw("(select max(serviceinfos.id) from serviceinfos)"))
        ->get();

       return view('groomingtransaction.receipt', compact('receipts', 'total'));
    }

    public function transactions(){
    $transactionlist = DB::select('select pets.name AS petname, users.name as userName, users.id AS userID, groomings.title AS gsTitle, groomings.grooming_cost AS gsCost,serviceinfos_groomings.status AS status, serviceinfos.date_serviced AS dateServiced, serviceinfos.id AS serviceID from users, groomings inner join serviceinfos_groomings on serviceinfos_groomings.groomings_id=groomings.id inner join serviceinfos on serviceinfos.id=serviceinfos_groomings.serviceinfos_id inner join pets on pets.id=serviceinfos_groomings.pet_id inner join pet_user on pet_user.pet_id=pets.id where users.id=serviceinfos.user_id AND serviceinfos_groomings.status="Pending" order by serviceinfos_groomings.serviceinfos_id DESC');
        // ->get();
        return view('transaction.transactionlist', compact('transactionlist'));
    }

    public function update(Request $request, $id)
    {
        DB::table('serviceinfos_groomings')
        ->join('serviceinfos','serviceinfos.id','=', 'serviceinfos_groomings.serviceinfos_id')
        ->leftjoin('groomings','groomings.id','=','serviceinfos_groomings.groomings_id')
        ->leftjoin('users', 'users.id','=','serviceinfos.user_id')
        ->leftjoin('pet_user', 'pet_user.user_id','=','users.id')
        ->rightjoin('pets', 'pets.id','=','pet_user.pet_id')
        ->select('serviceinfos.id AS serviceID', 'serviceinfos.date_serviced AS date_Serviced','pets.Name AS petname' , 'groomings.title AS gsTitle','groomings.grooming_cost AS gsCost', 'users.name AS userName', 'users.id AS userID')
        ->where('serviceinfos_groomings.serviceinfos_id', $id)
        ->update(['status' => $request->status]);
        //return redirect()->back()->with('status','Transaction Status Changed');
         return redirect()->route('transaction.transactionlist')->with('success','Transaction Status Updated!');
    }

    // public function destroy($id)
    // {
    //     $service = Serviceinfo::find($id);
    //     $service->delete();
    //     return Redirect::route('transaction.transactionlist')->with('success','Service Cancelled!');
    // }

     public function groomings()
    {
        $groomingstrans = DB::select('select pets.name AS petname, users.name, users.id AS cusID, groomings.title AS gsTitle, serviceinfos_groomings.status AS status, serviceinfos.date_serviced AS dateServiced, serviceinfos.id AS serviceID from users, groomings inner join serviceinfos_groomings on serviceinfos_groomings.groomings_id=groomings.id inner join serviceinfos on serviceinfos.id=serviceinfos_groomings.serviceinfos_id inner join pets on pets.id=serviceinfos_groomings.pet_id inner join pet_user on pet_user.pet_id=pets.id where users.id=serviceinfos.user_id order by serviceinfos_groomings.serviceinfos_id DESC');
                            // ->get();
        return view('groomingtransaction.groomingtrans', compact('groomingstrans'));
    }

    public function search(Request $request)
    {
    // // Get the search value from the request
    $search = $request->input('search');

    // Search in the title and body columns from the posts table
    $cushistory = DB::table('serviceinfos_groomings')
        ->join('serviceinfos','serviceinfos.id','=', 'serviceinfos_groomings.serviceinfos_id')
        ->leftjoin('groomings','groomings.id','=','serviceinfos_groomings.groomings_id')
        ->leftjoin('users', 'users.id','=','serviceinfos.user_id')
        ->leftjoin('pet_user', 'pet_user.user_id','=','users.id')
        ->rightjoin('pets', 'pets.id','=','pet_user.pet_id')
        ->select('serviceinfos.id AS serviceID','pets.Name AS petname' , 'groomings.title AS gsTitle','groomings.grooming_cost AS gsCost', 'serviceinfos.date_serviced AS date_Serviced','users.name AS userName', 'users.id AS userID')
        ->where('users.name', 'LIKE', "%{$search}%")
        ->orWhere('users.id', 'LIKE', "%{$search}%")
        ->orWhere('users.email', 'LIKE', "%{$search}%")
        ->orderBy('serviceinfos_groomings.serviceinfos_id','DESC')
        ->get();

    // Return the search view with the resluts compacted
    // return view('groomingtransaction.search', compact('cushistory'));

    $searchResults = (new Search())
        // ->registerModel(Consulatation::class,'cost', 'diseases_injuries')
        ->registerModel(Serviceinfo::class, 'date_serviced')
        ->registerModel(Pet::class, 'name', 'type')
        ->registerModel(Grooming::class,'title')
        ->registerModel(Groomingtransaction::class,'status')
        ->registerModel(User::class,'name', 'email')
        ->search($request->get('search'));
        // dd($searchResults);
        return view('groomingtransaction.search',compact('searchResults', 'cushistory'));
    }
}
