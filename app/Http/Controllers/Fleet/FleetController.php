<?php

namespace App\Http\Controllers\Fleet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Fleet\Vehicle;
use App\Fleet\FuelRequisition;
use App\User;
use Auth;

class FleetController extends Controller
{
    public function index()
    {
        return view('Fleet.dashboard_fleet');
    }

    public function fetchVehicles()
    {
        if(session('success'))
        {
            toast('Vehicle Added Successfully','success');
        }
        elseif(session('updated'))
        {
            toast('Vehicle Updated Successfully','success');
        }
        elseif(session('deleted'))
        {
            toast('Vehicle Deleted Successfully','success');
        }
        $vehicles = Vehicle::all();
        $drivers = User::where('vehicle_id','!=',0)->get();
        return view('Fleet.vehicles')->with('vehicles', $vehicles)->with('drivers',$drivers);
    }

    public function postVehicle(Request $request)
    {

        //Handle documents upload
        if($request->hasFile('vehicle_photo'))
        {  
            $picturename = $request->file('vehicle_photo')->getClientOriginalName();
            $picturename_to_store = time().'_'.$picturename;
        }
        else
        {
            $picturename = '';
            $picturename_to_store = '';
        }
        
             //Uploading the picture now
            if($request->hasFile('vehicle_photo'))
            {
                $path1 = $request->file('vehicle_photo')->storeAs('Documents', $picturename_to_store);
            }
        $add = new Vehicle;
        $add->reg_no = $request->reg_no;
        $add->make = $request->make;
        $add->model = $request->model;
        $add->tank_capacity = $request->tank_capacity;
        $add->coverage_per_litre = $request->coverage_per_km;
        $add->current_milage = $request->mileage;
        $add->image = $picturename_to_store;
        $add->coverage_full_tank = $request->coverage_per_km * $request->tank_capacity;
        $add->save();

        return back()->with('success','Added Successfully');
    }

    public function editVehicle(Request $request, $id)
    {
         //Handle documents upload
         if($request->hasFile('vehicle_photo'))
         {  
             $picturename = $request->file('vehicle_photo')->getClientOriginalName();
             $picturename_to_store = time().'_'.$picturename;
         }
         else
         {
             $picturename = $request->old_vehicle_photo;
             $picturename_to_store = $request->old_vehicle_photo;
         }
         
              //Uploading the picture now
             if($request->hasFile('vehicle_photo'))
             {
                 $path1 = $request->file('vehicle_photo')->storeAs('Documents', $picturename_to_store);
             }
        $add = Vehicle::find($id);
        $add->reg_no = $request->reg_no;
        $add->make = $request->make;
        $add->model = $request->model;
        $add->tank_capacity = $request->tank_capacity;
        $add->coverage_per_litre = $request->coverage_per_km;
        $add->current_milage = $request->mileage;
        $add->image = $picturename_to_store;
        $add->driver_id = $request->driver;
        $add->coverage_full_tank = $request->coverage_per_km * $request->tank_capacity;
        $add->update();

        return back()->with('updated','Added Successfully');
    }

    //destroy vehicle
    public function destroyVehicle(Request $request, $id)
    {
        $to_destroy = Vehicle::find($id);
        $to_destroy->delete();

        return back()->with('deleted','Level Deleted Successfully');   
    }

    public function fetchDrivers()
    {
        if(session('success'))
        {
            toast('Driver Added Successfully','success');
        }
        elseif(session('updated'))
        {
            toast('Driver Updated Successfully','success');
        }
        elseif(session('deleted'))
        {
            toast('Driver Deleted Successfully','success');
        }
        $drivers = User::where('vehicle_id','!=',0)->get();
        $vehicles = Vehicle::all();
        return view('Fleet.drivers')->with('drivers', $drivers)->with('vehicles', $vehicles);
    }
    
    public function postDriver(Request $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->vehicle_id = $request->input('vehicle');
        $user->title = 'Driver';
        $user->level = 8;
        $user->department_id = 'Fleet';
        $user->imgurl = 'profile.png';
        $user->phone = $request->input('phone');
        $user->ext = 0;
        $password = 'user123';
        $user->password = Hash::make($password);
        $email_check = User::where('email', $request->email)->get();
        if(count($email_check) > 0)
        {
            return back()->with('error', 'Email in Use');
        }
        else
        {
            $user->save();
            return back()->with('success', 'User Added Successfully');
            
        }
    }

    public function editDriver(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->vehicle_id = $request->input('vehicle');
        $user->title = 'Driver';
        $user->level = 1;
        $user->department_id = 'Fleet';
        $user->imgurl = 'user.png';
        $user->phone = $request->input('phone');
        $user->ext = 0;
        $user->update();

        return back()->with('updated', 'User Added Successfully');
    }

    //destroy driver
    public function destroyDriver(Request $request, $id)
    {
        $to_destroy = User::find($id);
        $to_destroy->delete();

        return back()->with('deleted','Level Deleted Successfully');   
    }

     //Driver requisitions
     public function driverRequisition()
     {
        $myvehicle = Vehicle::where('driver_id',auth::user()->id)->first();
        $requisitions = FuelRequisition::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);  
 
         return view('Fleet.driver_requisitions')->with('requisitions', $requisitions)->with('myvehicle', $myvehicle);   
     }

     public function postRequest(Request $request)
     {
        $place = new FuelRequisition;
        $place->user_id = auth::user()->id;
        $place->vehicle_id = $request->vehicle_id;
        $place->current_mileage = $request->current_mileage;
        $place->previous_mileage = $request->previous_mileage;
        $place->litres_requested = $request->current_diesel_requisition;
        $place->progress = 25;

        $place->save();

        $vehicle = Vehicle::find($request->vehicle_id);
        $vehicle->current_milage = $request->current_mileage;
        $vehicle->previous_fuel = $request->current_diesel_requisition;
        $vehicle->update();

        return back()->with('success','Requested Successfully');

     }

     public function viewFuel($id)
     {
         $fuel_requisition = FuelRequisition::find($id);
         return view('Fleet.view_fuel')->with('fuel_requisition', $fuel_requisition);
     }


}
