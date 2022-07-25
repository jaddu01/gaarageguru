<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\POST;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
//use Illuminate\Contracts\Validation\Validator;

use App\tbl_points;
use App\tbl_vehicles;
use App\tbl_checkout_categories;
use App\User;
use App\CheckoutCategory;
use App\Point;
use App\Vehicle;
use App\Branch;
use App\BranchSetting;

class CheckpointController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //observation list
    public function showall()
    {

        $currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
        $adminCurrentBranch = BranchSetting::where('id','=',1)->first();

        if (isAdmin(Auth::User()->role_id)) 
        {
            $check_data = CheckoutCategory::where([['soft_delete','=',0], ['branch_id','=',$adminCurrentBranch->branch_id]])->groupBy('vehicle_id')->orderBy('id', 'DESC')->get();
        }
        elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
            $check_data = CheckoutCategory::where('soft_delete','=',0)->groupBy('vehicle_id')->orderBy('id', 'DESC')->get();
        }
        else{
            $check_data = CheckoutCategory::where([['soft_delete','=',0], ['branch_id','=',$currentUser->branch_id]])->groupBy('vehicle_id')->orderBy('id', 'DESC')->get();
        }

        return view("/observation/list", compact('check_data'));
    }

    //observation addform
    public function index()
    {        

        $currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
        $adminCurrentBranch = BranchSetting::where('id','=',1)->first();
        
        if (isAdmin(Auth::User()->role_id)){            
            $vehicle_name = Vehicle::where([['soft_delete','=',0], ['branch_id','=',$adminCurrentBranch->branch_id]])->get();
            $cat_name = CheckoutCategory::where([['soft_delete','=',0], ['branch_id','=',$adminCurrentBranch->branch_id]])->distinct()->select('checkout_point')->get();
        }
        elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
            $vehicle_name = Vehicle::where('soft_delete','=',0)->get();
            $cat_name = CheckoutCategory::where('soft_delete','=',0)->distinct()->select('checkout_point')->get();
        }
        else{
            $vehicle_name = Vehicle::where([['soft_delete','=',0], ['branch_id','=',$currentUser->branch_id]])->get();
            $cat_name = CheckoutCategory::where([['soft_delete','=',0], ['branch_id','=',$currentUser->branch_id]])->distinct()->select('checkout_point')->get();
        }

        return view("observation.add", compact('vehicle_name', 'cat_name'));
    }
    
    //observation add category
    public function add_category(Request $request)
    {
        $vehical_name = $request->vehical_name;
        $category = $request->category;
        
        /*For add selected branch_id for all user with admmin also*/
        $currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
        $adminCurrentBranch = BranchSetting::where('id','=',1)->first();
        $bramnchId = "";
        if (isAdmin(Auth::User()->role_id)){            
            $bramnchId = $adminCurrentBranch->branch_id;
        }
        elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
            $bramnchId = "";
        }
        else{
            $bramnchId = $currentUser->branch_id;
        }

        foreach ($vehical_name as $data)
        {
            $results = CheckoutCategory::where([['vehicle_id', '=', $data], ['checkout_point','=',$category]])->count();

            if($results == 0){
                $tbl_checkout_categories = new CheckoutCategory;
                $tbl_checkout_categories->vehicle_id =  $data;
                $tbl_checkout_categories->checkout_point =  $category;
                $tbl_checkout_categories->create_by =  Auth::user()->id;
                $tbl_checkout_categories->branch_id = $bramnchId;
                $tbl_checkout_categories->save();
            }
        }
        return $tbl_checkout_categories->id;
    }

    //observation store
    public function store(Request $request)
    {
        //dd($request->all());
        /*$this->validate($request, [
            'veh_name' => 'required',
            'checkpoint_name' => 'required',
            //'checkpoint' => 'required|regex:/^[a-zA-Z0-9][a-zA-Z0-9\s\.\@\-\_\,]*$/',
            'checkpoint' => 'required',
            ]);*/

        /*$validatedData = $request->validate([
            'veh_name' => 'required',
            'checkpoint_name' => 'required',
            'checkpoint.*' => 'required',
        ]);*/

        /*For add selected branch_id for all user with admmin also*/
        $currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
        $adminCurrentBranch = BranchSetting::where('id','=',1)->first();
        $bramnchId = "";
        if (isAdmin(Auth::User()->role_id)){            
            $bramnchId = $adminCurrentBranch->branch_id;
        }
        elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
            $bramnchId = "";
        }
        else{
            $bramnchId = $currentUser->branch_id;
        }


        $vehical = $request->veh_name;
        foreach ($vehical as $vhi) {
            $v[] = $vhi;
        }
        $chkpoin =  $request->checkpoint_name;
        $chek_sub_pt = $request->checkpoint;
        $data = CheckoutCategory::whereIn('vehicle_id', $v)->where('checkout_point', '=', $chkpoin)->where('branch_id', '=', $bramnchId)->count();
        //dd($data, $v, $vehical);
        if ($data == 0) {
            if (!in_array('0', $vehical)) {
                foreach ($vehical as $data1) {
                    $tbl_checkout_categories = new CheckoutCategory;
                    $tbl_checkout_categories->vehicle_id = $data1;
                    $tbl_checkout_categories->checkout_point = $chkpoin;
                    $tbl_checkout_categories->create_by = Auth::user()->id;
                    $tbl_checkout_categories->branch_id = $bramnchId;
                    $tbl_checkout_categories->save();
                        
                    foreach ($chek_sub_pt as $data) {
                        $tbl_points = new Point;
                        $tbl_points->checkout_subpoints = $tbl_checkout_categories->checkout_point;
                        $tbl_points->vehicle_id = $tbl_checkout_categories->vehicle_id;
                        $tbl_points->checkout_point = $data;
                        $tbl_points->branch_id = $bramnchId;
                        $tbl_points->create_by =  Auth::user()->id;
                        $tbl_points->save();
                    }
                }
            } else {
                $tbl_checkout_categories = new CheckoutCategory;
                $tbl_checkout_categories->vehicle_id = 0;
                $tbl_checkout_categories->checkout_point = $chkpoin;
                $tbl_checkout_categories->create_by = Auth::user()->id;
                $tbl_checkout_categories->branch_id = $bramnchId;
                $tbl_checkout_categories->save();
                
                foreach ($chek_sub_pt as $data) {
                    $tbl_points = new Point;
                    $tbl_points->checkout_subpoints = $tbl_checkout_categories->checkout_point;
                    $tbl_points->vehicle_id = $tbl_checkout_categories->vehicle_id;
                    $tbl_points->checkout_point = $data;
                    $tbl_points->create_by =  Auth::user()->id;
                    $tbl_points->branch_id = $bramnchId;
                    $tbl_points->save();
                }
            }
        } else {
            foreach ($chek_sub_pt as $data) {
                foreach ($vehical as $data1) {
                    $tbl_points = new Point;
                    $tbl_points->checkout_subpoints = $chkpoin;
                    $tbl_points->vehicle_id = $data1;
                    $tbl_points->checkout_point = $data;
                    $tbl_points->create_by =  Auth::user()->id;
                    $tbl_points->branch_id = $bramnchId;
                    $tbl_points->save();
                }
            }
        }
        return redirect('observation/list')->with('message', 'Successfully Submitted');
    }    

    //observation edit
    public function edit(Request $request)
    {
        $id = $request->id;
        //$sub_data = DB::table("tbl_points")->where('id',$id)->get()->toArray();

        $sub_data = Point::where('id', $id)->get();
        
        $html = view('observation.editmodel')->with(compact('id', 'sub_data'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    //observation update
    public function updatedata(Request $request)
    {
        $id = $request->id;
        $subpoint = $request->subpoints;
        
        //$data = DB::table('tbl_points')->where('id','=',$id)->get()->toArray();
        $data = Point::where('id', '=', $id)->get();

        
        foreach ($subpoint as $subpoints) {
            foreach ($data as $datas) {
                $ids = $datas->id;
                $tbl_points =  Point::find($ids);
                $tbl_points->checkout_point = $subpoints;
                $tbl_points->save();
            }
        }
        return 1;
    }
    
    //observation delete
    public function destroy(Request $request)
    {
        $id = $request->id;
        //$data = Point::find($id);
        //$data->delete();

        Point::where('id','=',$id)->update(['soft_delete' => 1]);
        echo $id;
        //return 1;
    }
}
