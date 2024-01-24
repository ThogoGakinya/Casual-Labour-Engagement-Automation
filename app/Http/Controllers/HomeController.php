<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Fleet\Vehicle;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        toast('Welcome ' .auth::user()->name,'success');
        if(auth::user()->level == 8 )
        {
                if(session('success'))
                    {
                        Alert::success('Success!', 'Password Changed Successfully');
                    }
                elseif(session('error'))
                    {
                        Alert::error('Error', 'Wrong Current Password');
                    }
                elseif(session('mismatch'))
                    {
                        Alert::error('Error!', 'Confirmation password does not match with New Password');
                    }
                elseif(session('match'))
                    {
                        Alert::error('Error!', 'New password can not be same as Old Password');
                    }
        
                $myvehicle = Vehicle::where('driver_id',auth::user()->id)->first();
                return view('Staff.driver_dashboard')->with('myvehicle', $myvehicle); 

        }
        else
        {
                if(session('success'))
                {
                    Alert::success('Success!', 'Password Changed Successfully');
                }
                elseif(session('error'))
                {
                    Alert::error('Error', 'Wrong Current Password');
                }
                elseif(session('mismatch'))
                {
                    Alert::error('Error!', 'Confirmation password does not match with New Password');
                }
                elseif(session('match'))
                {
                    Alert::error('Error!', 'New password can not be same as Old Password');
                }
            
                    return view('Staff.dashboard_staff');
        }   
    }

    public function adminDashboard()
    {
        return view('Admin.dashboard_admin');
    }
}
