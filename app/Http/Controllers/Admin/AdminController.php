<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Staff\Department;
use App\Staff\Corevalue;
use App\Staff\Voter;
use App\Staff\Vote;
use App\Staff\Role;
use App\Staff\Permission;
use App\Staff\Nominee;
use App\Staff\Reward;
use App\Staff\Image;
use App\Staff\Criteria;
use App\Staff\Valuevote;
use App\Admin\Division;
use App\Admin\AccessLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Log;
use App\Mail\PasswordReset;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchUsers()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Request Successfully');
        }
        elseif(session('error'))
        {
            Alert::error('Error!', 'You can NOT delete yourself');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $users = User::latest('created_at')->get();
        
        return view('Admin.users')->with('users', $users);
    }

    public function addUser()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'User Added Successfully');
        }
        elseif(session('error'))
        {
            Alert::error('Error!', 'Email Already Taken');
        }
        elseif(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        return view('Admin.add_user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitUser(Request $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->title = $request->input('title');
        $user->level = $request->input('level');
        $user->department_id = $request->input('department');
        $user->imgurl = $request->input('profile');
        $user->phone = $request->input('phone');
        $user->ext = $request->input('ext');
        $password = $request->input('password');
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

    //Submit department
    public function submitDepartment(Request $request)
    {
        $dep = new Department;
        $dep->name = $request->input('name');
        $dep->hod_id = $request->input('hod');
        $dep->save();
            
        return back()->with('success', 'Department Added Successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUser($id)
    {

        if(session('success'))
        {
            Alert::success('Success!', 'User Added Successfully');
        }
        elseif(session('error'))
        {
            Alert::error('Error!', 'Email Already Taken');
        }
        elseif(session('updated'))
        {
            toast('Updated Successfully', 'success');
        }
        elseif(session('reset'))
        {
            Alert::success('Success!', 'Password Reset Successfully');
        }

        $user = User::find($id);

        return view('Admin.edit_user')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->title = $request->input('title');
        $user->level = $request->input('level');
        $user->department_id = $request->input('department');
        $user->imgurl = $request->input('profile');
        $user->phone = $request->input('phone');
        $user->ext = $request->input('ext');
        $email_check = User::where([['email', $request->email],['id','!=',$id]])->get();
        if(count($email_check) > 0)
        {
            return back()->with('error', 'Email in Use');
        }
        else
        {
            $user->update();
            return back()->with('updated', 'Details Updated Successfully');
            
        }
    }

    //Reset Users passwords
    public function resetPassword(Request $request, $id)
    {
        $user = User::find($id);
        $password = $request->input('new_password');
        $user_email = $request->input('email_to_send');
        $user->password = Hash::make($password);
        $user->update();
        
        Mail::to($user_email)->send(new PasswordReset($user_email,$password));
        return back()->with('reset', 'Password reset Successfully');
    }

    //Reset all passwords and welcome
    public function welcomeUser()
    {
        $users = User::all();
        foreach($users as $user)
        {
            $user_email = $user->email;
            $password = "user123";
            $find_user = User::find($user->id);
            $find_user->password = Hash::make($password);
            $find_user->update();

            Mail::to($user_email)->send(new PasswordReset($user_email,$password));
        }
        return back()->with('reset', 'Password reset Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //destroy user
     public function destroyUser(Request $request, $id)
     {
         $to_destroy = User::find($request->user_id);
         if($request->user_id == auth::user()->id)
         {
            return back()->with('error','You can not delete yourself');
         }
        else
        {
            $to_destroy->delete();
            return back()->with('deleted','User Deleted Successfully');   
        }
       
     }


    //Change Profile
    public function changeProfile(Request $request, $id)
    {
        $user_id = $request->input('user_id');
        //Handle documents upload
         //Get document names with extension.
        if($request->hasFile('profile_picture'))
        {  
            $picturename = $request->file('profile_picture')->getClientOriginalName();
            $picturename_to_store = $user_id.'_'.$picturename;
        }
        else
        {
            $picturename = '';
            $picturename_to_store = '';
        }
        
             //Uploading the picture now
            if($request->hasFile('profile_picture'))
            {
                $path1 = $request->file('profile_picture')->storeAs('Documents', $picturename_to_store);
            }
        $user = User::find($user_id);
        $user->imgurl = $picturename_to_store;
        $user->update();
        
        return back();
    }

    //Fetch departments
    public function fetchDepartments()
    {
        if(session('success'))
        {
            toast('Department Created Successfully','success');
        }
        elseif(session('updated'))
        {
            toast('Department Updated Successfully','success');
        }
        elseif(session('deleted'))
        {
            toast('Department Deleted Successfully','success');
        }
        $departments = Department::latest('created_at')->get();
        
        return view('Admin.departments')->with('departments', $departments);
    }

    //update department
    public function editDepartment(Request $request, $id)
    {
        $dep = Department::find($request->dep_id);
        $dep->name = $request->input('name');
        $dep->hod_id = $request->input('hod');
        $dep->update();

        return back()->with('updated', 'Details Updated Successfully');
    }

     //find divisions
     public function findDivision(Request $request)
     {
         $data= Division::where('department_id',$request->id)->get();
         return response()->json($data);
     }

      //find hod
      public function findHOD(Request $request)
      {
          $data2= Division::find($request->id)->with('hod');
          return response()->json($data2);
      }

    //destroy department
    public function destroyDepartment(Request $request, $id)
    {
        $to_destroy = Department::find($request->dep_id);
        $to_destroy->delete();

        return back()->with('deleted','User Deleted Successfully');   
    }

     //Submit Access Level
     public function submitAccessLevel(Request $request)
     {
         $acc = new AccessLevel;
         $acc->name = $request->input('name');
         $acc->level = $request->input('level');
         $acc->save();
             
         return back()->with('success', 'Level Added Successfully');
         
     }

    //Fetch access levels
    public function fetchAccessLevels()
    {
        if(session('success'))
        {
            toast('Level Created Successfully','success');
        }
        elseif(session('updated'))
        {
            toast('Level Updated Successfully','success');
        }
        elseif(session('deleted'))
        {
            toast('Level Deleted Successfully','success');
        }
        elseif(session('reasigned'))
        {
            toast('Re-assigned Successfully','success');
        }
        $users = User::all();
        $access_levels = AccessLevel::orderBy('level','desc')->get();
        
        return view('Admin.access_level')->with('access_levels', $access_levels)->with('users', $users);
    }

    //update access level
    public function editAccessLevel(Request $request, $id)
    {
        $acc = AccessLevel::find($request->acc_id);
        $acc ->name = $request->input('name');
        $acc ->level = $request->input('level');
        $acc ->update();

        return back()->with('updated', 'Details Updated Successfully');
    }
    //reasign access level
    public function reasignAccessLevel(Request $request, $id)
    {
        $user = User::find($request->user_id);
        $user ->level = $request->input('new_level');
        $user ->update();

        return back()->with('reasigned', 'Details Updated Successfully');
    }

    //destroy access level
    public function destroyAccessLevel(Request $request, $id)
    {
        $to_destroy = AccessLevel::find($request->acc_id);
        $to_destroy->delete();

        return back()->with('deleted','Level Deleted Successfully');   
    }

    //Submit division
    public function submitDivision(Request $request)
    {
        $div = new Division;
        $div->name = $request->input('name');
        $div->department_id = $request->input('dep');
        $div->line_manager_id = $request->input('lm');
        $div->save();
            
        return back()->with('success', 'Department Added Successfully');
        
    }
    //Fetch divisions
    public function fetchDivisions()
    {
        if(session('success'))
        {
            toast('Division Created Successfully','success');
        }
        elseif(session('updated'))
        {
            toast('Division Updated Successfully','success');
        }
        elseif(session('deleted'))
        {
            toast('Division Deleted Successfully','success');
        }
        $divisions = Division::latest('created_at')->get();
        
        return view('Admin.divisions')->with('divisions', $divisions);
    }

    //update department
    public function editDivision(Request $request, $id)
    {
        $div = Division::find($request->div_id);
        $div->name = $request->input('name');
        $div->line_manager_id = $request->input('manager');
        $div->department_id = $request->input('dept');
        $div->update();

        return back()->with('updated', 'Details Updated Successfully');
    }

    //destroy department
    public function destroyDivision(Request $request, $id)
    {
        $to_destroy = Division::find($request->div_id);
        $to_destroy->delete();

        return back()->with('deleted','User Deleted Successfully');   
    }
    public function stkPush(Request $request)
    {
        $amount = $request->amount;
        $number = $request->number;
        date_default_timezone_set('Africa/Nairobi');

        # access token
        $consumerKey = '4K1Aq2LGOCw5nQxUV60zLeONfmOwwuXw'; 
        $consumerSecret = 'kscGMdGb89nQNhCt'; 
        $headers = ['Content-Type:application/json; charset=utf8'];
        $access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        
        $curl = curl_init($access_token_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);
        $access_token = $result->access_token;  
        //echo $access_token;
        curl_close($curl);

        
        $BusinessShortCode = '215723';
        $Passkey = '0b92f7580f273c1ed010675030514649f9ed75e6008d811e419064f21014f3d5';
        $PartyA = $number; 
        $PartyB = '218918';
        $AccountReference = 'Inv 1';
        $TransactionDesc = 'Payment trial';
        $Amount = $amount;
        $Timestamp = date('YmdHis');    
        $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

        $initiate_url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        # callback url
        $CallBackURL = 'https://www.kimfay.com/dev/callback_url.php';  

        
        # header for stk push
        $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

        # initiating the transaction
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $initiate_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => $Password,
            'Timestamp' => $Timestamp,
            'TransactionType' => 'CustomerBuyGoodsOnline',
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $PartyB,
            'PhoneNumber' => $PartyA,
            'CallBackURL' => $CallBackURL,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc
        );

        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        $response = json_decode($curl_response, true); 
        $CheckoutRequestID = $response['CheckoutRequestID'];
        $ResponseCode = $response['ResponseCode'];
        $CustomerMessage = $response['CustomerMessage'];

        return view('Admin.payment_form')->with('CheckoutRequestID',$CheckoutRequestID)
                                         ->with('CustomerMessage',$CustomerMessage)
                                         ->with('ResponseCode',$ResponseCode);
       
        
    }

    public function getPaymentForm()
    {
        $CheckoutRequestID = '';
        $ResponseCode = 222;
        $CustomerMessage = '';
        return view('Admin.payment_form')->with('CheckoutRequestID',$CheckoutRequestID)
                                         ->with('CustomerMessage',$CustomerMessage)
                                         ->with('ResponseCode',$ResponseCode);
    }
    
    public function pollAuth(Request $request)
    {
        $polluser = Voter::where([['id_no',$request->pnumber],['password', $request->password]])->first();
        
        if(!empty($polluser))
        {
        $users =  Voter::all();
        $kpusers = Voter::where("department", "Professional Sales" )->get();
        $salesusers = Voter::where("department", "Consumer Sales" )->get();
        $merchandizers = Voter::where("division", "Modern Trade" )->get();
         $stores = Voter::where("division", "Stores" )->get();
        $financeusers = Voter::where("department", "Finance" )->get();
        $dispatchusers = Voter::where("division", "Dispatch" )->get();
        $operationsusers = Voter::where("department", "Operations" )->get();
        $sixkusers = Voter::where("department", "sixk" )->get();
        $corevalues = Corevalue::all();
        $rewards = Reward::all();
        $roles = Role::all();
        $permissions = Permission::where('role_id', $polluser->role_id)->orWhere('role_id', 1)->get();
        $criterias = Criteria::all();
        $votes = Vote::where('user_id', $polluser->id)->get();
        $topleft = Image::where('location', 2)->get();
        
       
            $checker = Vote::where([['user_id',$polluser->id],['period','Quater 1']])->first();
            // if(!empty($checker))
            // {
            // $selectedvalues = Valuevote::where('token_id',$checker->vote_token)->get();
            // $nominated = Voter::find($checker->nominated_id);
            //     return view('Poll.voted_dashboard')->with('checker',$checker)->with('polluser',$polluser)->with('selectedvalues',$selectedvalues)->with('nominated',$nominated);
            // }
            // else
            // {
            // return view('Poll.poll_dashboard')->with('polluser',$polluser)->with('users',$users)->with('corevalues',$corevalues);
            // }
            
            return view('Poll.dashboard')->with('polluser',$polluser)->with('users',$users)->with('corevalues',$corevalues)->with('rewards', $rewards)->with('criterias', $criterias)->with('votes', $votes)->with('roles', $roles)->with('topleft', $topleft)->with('kpusers', $kpusers)->with('financeusers', $financeusers)->with('sixkusers', $sixkusers)->with('dispatchusers', $dispatchusers)->with('operationsusers', $operationsusers)->with('stores', $stores)->with('merchandizers', $merchandizers)->with('salesusers', $salesusers)->with('permissions', $permissions);
        }
        else
        {
            return redirect()->back()->with('success', 'Invalid Password or ID Number');
            
        }
 
    }
    
        public function coreValuesAuth($id)
    {
        $polluser = Voter::find($id);
        $users =  Voter::all();
        $corevalues = Corevalue::all();
        $rewards = Reward::all();
        $criterias = Criteria::all();
        $votes = Vote::where('user_id', $polluser->id)->get();
        
        if(!empty($polluser))
        {
            $checker = Vote::where([['user_id',$polluser->id],['reward_id', 12],['year',date('Y')]])->first();
            if(!empty($checker))
            {
            $selectedvalues = Valuevote::where('token_id',$checker->vote_token)->get();
            $nominated = Voter::find($checker->nominated_id);
                return view('Poll.voted_dashboard')->with('checker',$checker)->with('polluser',$polluser)->with('selectedvalues',$selectedvalues)->with('nominated',$nominated);
            }
            else
            {
            return view('Poll.poll_dashboard')->with('polluser',$polluser)->with('users',$users)->with('corevalues',$corevalues);
            }

        }
        else
        {
            return redirect()->back()->with('success', 'Invalid ID Number');
            
        }
 
    }
     
     public function confirmNominee(Request $request)
    {

        $data = Voter::find($request->id);
        return response()->json($data);
    }
    
    //Submit Poll
    public function submitPoll(Request $request)
    {
        $vot_token = rand(100000,999999);
        $polluser = Voter::find($request->user_id);
        //$polluser = User::where('email',$request->pnumber)->first();
        $users =  Voter::all();
        $corevalues = Corevalue::all();
        $vot = new Vote;
        $vot->user_id = $request->input('user_id');
        $vot->nominated_id = $request->input('nominee');
        $vot->user_id = $request->input('user_id');
        $vot->story = $request->input('story');
        $vot->reward_id = 12;
        $vot->year = date('Y');
        $vot->period = $request->input('period');
        $vot->vote_token = $vot_token;
        $vot->save();
        
        
        if(count($request->corevalue) > 0)
      {
          foreach($request->corevalue as $entry=>$v)
          {
              $info=array(
                  'corevalue_id'=>$request->corevalue[$entry],
                  'nominated_id'=>$request->input('nominee'),
                  'voter_id'=>$request->input('user_id'),
                  'token_id'=>$vot_token);
              
              $valuevote = new Valuevote;
              $valuevote->insert($info);
          }
      }
         
            $checker = Vote::where([['user_id',$request->input('user_id')],['period','Quater 1']])->first();
            $selectedvalues = Valuevote::where('token_id',$checker->vote_token)->get();
            $nominated = Voter::find($checker->nominated_id);
            return view('Poll.voted_dashboard')->with('checker',$checker)->with('polluser',$polluser)->with('selectedvalues',$selectedvalues)->with('nominated',$nominated);

    }
    
    public function adminView($id)
    {
        $polluser = Voter::find($id);
        $Integrity = Valuevote::where('corevalue_id',1)->orderBy('nominated_id', 'desc')->get();
        $Customer_Focus = Valuevote::where('corevalue_id',2)->orderBy('nominated_id', 'desc')->get();
        $Team_Spirit = Valuevote::where('corevalue_id',3)->orderBy('nominated_id', 'desc')->get();
        $Respect = Valuevote::where('corevalue_id',4)->orderBy('nominated_id', 'desc')->get();
        $Continual_Improvement = Valuevote::where('corevalue_id',5)->orderBy('nominated_id', 'desc')->get();
        $Openness_and_Honesty = Valuevote::where('corevalue_id',6)->orderBy('nominated_id', 'desc')->get();
        $total_votes = Vote::all();
        $total_value_votes = Valuevote::all();
        $users = Voter::all();
        return view('Poll.admin')->with('polluser',$polluser)->with('users',$users)->with('Integrity',$Integrity)->with('Customer_Focus',$Customer_Focus)->with('Team_Spirit',$Team_Spirit)
        ->with('Respect',$Respect)->with('total_value_votes',$total_value_votes)->with('Continual_Improvement',$Continual_Improvement)->with('Openness_and_Honesty',$Openness_and_Honesty)->with('total_votes',$total_votes);
    }
    
    public function adminAwards($id)
    {
        $nominees = Nominee::all();
        $rewards =  Reward::all();
        $voters = Voter::all();
        $departments = Department::all();
        $polluser = Voter::find($id);
        return view('Poll.awards')->with('polluser', $polluser)->with('nominees', $nominees)->with('voters', $voters)->with('rewards', $rewards);
    }
    
    public function pollLanding()
    {
        $nominees_twentyone = Nominee::where('year', 2021)->get();
        $nominees_twentytwo = Nominee::where('year', 2022)->get();
        $topleft = Image::where('location', 2)->get();
        $topright = Image::where('location', 1)->get();
        $bottomleft = Image::where('location', 4)->get();
        $bottomright = Image::where('location', 3)->get();
        $centers = Image::where('location', 5)->get();
        
        return view('poll_landing')->with('nominees_twentyone', $nominees_twentyone)->with('topleft', $topleft)->with('topright', $topright)->with('bottomleft', $bottomleft)->with('bottomright', $bottomright)->with('nominees_twentytwo', $nominees_twentytwo)->with('centers', $centers);
    }
    
    public function storeNominee(Request $request)
    {
             $token_id = rand(10000,90000);
            //Handle documents upload
             //Get document names with extension.
            if($request->hasFile('image'))
            {  
                $documentOneName = $request->file('image')->getClientOriginalName();
                $docNameOneToStore = $token_id.'_'.$documentOneName;
            }
            else
            {
                $documentOneName = '';
                $docNameOneToStore = '';
            }
        
             //Uploading the Documents now
            if($request->hasFile('image'))
            {
                $path1 = $request->file('image')->storeAs('Documents', $docNameOneToStore);
            }

        $nominee = new Nominee;
        $nominee->img_url = $docNameOneToStore;
        $nominee->reward_id = $request->reward;
        $nominee->user_id = $request->nominee;
        $nominee->year = $request->year;
        $nominee->justification = $request->justification;
        $nominee->save();

        
        return back();
    }
    public function updateNominee(Request $request)
    {
             $token_id = rand(10000,90000);
             $nominee = Nominee::find($request->nominee_id);
            //Handle documents upload
             //Get document names with extension.
            if($request->hasFile('image'))
            {  
                $documentOneName = $request->file('image')->getClientOriginalName();
                $docNameOneToStore = $token_id.'_'.$documentOneName;
            }
            else
            {
                $documentOneName = $nominee->img_url;
                $docNameOneToStore = $nominee->img_url;
            }
        
             //Uploading the Documents now
            if($request->hasFile('image'))
            {
                $path1 = $request->file('image')->storeAs('Documents', $docNameOneToStore);
            }

        $nominee = Nominee::find($request->nominee_id);
        $nominee->img_url = $docNameOneToStore;
        $nominee->reward_id = $request->reward;
        $nominee->user_id = $request->nominee;
        $nominee->year = $request->year;
        $nominee->justification = $request->justification;
        $nominee->update();

        
        return back();
    }
    
     public function rolesPermissions($id)
    {
        $awards = Reward::all();
        $polluser = Voter::find($id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('Poll.role_permissions')->with('polluser', $polluser)->with('awards', $awards)->with('roles', $roles)->with('permissions', $permissions);
    }
    
     public function storePermission(Request $request)
    {
        $destroypermission = Permission::where('reward_id', $request->award)->delete();
       
        $data = $request->all();
        if(count($request->role) > 0)
        {
            foreach($request->role as $entry=>$v)
            {
                $info=array(
                    'role_id'=>$request->role[$entry],
                    'reward_id'=>$request->award
                           );
                $checker = Permission::where([['role_id',$request->role[$entry]],['reward_id',$request->award]])->first();
                if( $checker == '')
                {
                $deposit = new Permission;
                $deposit->insert($info);
                }
                
            }
        }
        
        return back();
    }
    
    public function criteria($id)
    {
        $rewards = Reward::all();
        $polluser = Voter::find($id);
        $criterias = Criteria::all();
        return view('Poll.criteria')->with('polluser', $polluser)->with('rewards', $rewards)->with('criterias', $criterias);
    }
    
    public function storeCriteria(Request $request){
        $store = new Criteria;
        $store->reward_id = $request->reward;
        $store->criteria = $request->criteria;
        $store->description = $request->description;
        $store->save();
        
        return back();
    }
     public function editCriteria(Request $request){
        $store = Criteria::find($request->criteria_id);
        $store->reward_id = $request->reward;
        $store->criteria = $request->criteria;
        $store->description = $request->description;
        $store->update();
        
        return back();
    }
    
    public function storeVote(Request $request){
        $votes = Vote::where('user_id', $request->user_id)->get();
        $users =  Voter::all();
        $corevalues = Corevalue::all();
        $rewards = Reward::all();
        $criterias = Criteria::all();
        $polluser = Voter::find($request->user_id);
        $merchandizers = Voter::where("division", "Modern Trade" )->get();
        $stores = Voter::where("division", "Stores" )->get();
        $kpusers = Voter::where("department", "Professional Sales" )->get();
        $salesusers = Voter::where("department", "Consumer Sales" )->get();
        $financeusers = Voter::where("department", "Finance" )->get();
        $operationsusers = Voter::where("department", "Operations" )->get();
         $dispatchusers = Voter::where("division", "Dispatch" )->get();
        $sixkusers = Voter::where("department", "sixk" )->get();
        $roles = Role::all();
        $topleft = Image::where('location', 2)->get();
        
        
        $permissions = Permission::where('role_id', $polluser->role_id)->orWhere('role_id', 1)->get();
        $checker = Vote::where([['user_id',$request->user_id],['reward_id',$request->reward_id ]])->get();
        
        if(count($checker) == 0){
            $store = new Vote;
            $store->reward_id = $request->reward_id;
            $store->user_id = $request->user_id;
            $store->year = $request->year;
            $store->nominated_id = $request->nominee;
            $store->vote_token = rand(100000,900000);
            $store->story = $request->story;
            $store->period = $request->period;
            $store->status = 1;
            $store->save();
            
             return view('Poll.dashboard')->with('polluser',$polluser)->with('users',$users)->with('corevalues',$corevalues)->with('rewards', $rewards)->with('criterias', $criterias)->with('votes', $votes)->with('roles', $roles)->with('topleft', $topleft)->with('sixkusers', $sixkusers)->with('dispatchusers', $dispatchusers)->with('kpusers', $kpusers)->with('financeusers', $financeusers)->with('operationsusers', $operationsusers)->with('stores', $stores)->with('salesusers', $salesusers)->with('merchandizers', $merchandizers)->with('permissions', $permissions);
        }
        
            return view('Poll.dashboard')->with('polluser',$polluser)->with('users',$users)->with('corevalues',$corevalues)->with('rewards', $rewards)->with('criterias', $criterias)->with('votes', $votes)->with('roles', $roles)->with('topleft', $topleft)->with('sixkusers', $sixkusers)->with('dispatchusers', $dispatchusers)->with('kpusers', $kpusers)->with('financeusers', $financeusers)->with('operationsusers', $operationsusers)->with('salesusers', $salesusers)->with('permissions', $permissions);
    }
    
    public function fetchVoters($id)
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Request Successfully');
        }
        elseif(session('error'))
        {
            Alert::error('Error!', 'You can NOT delete yourself');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $voters = Voter::all();
        
        $polluser = Voter::find($id);
        $roles = Role::all();
        return view('Poll.voters')->with('voters', $voters)->with('polluser', $polluser)->with('roles', $roles);
    }
    
     public function submitVoter(Request $request)
     {
        $store = new Voter;
        $store->name = $request->name;
        $store->role_id = $request->role_id;
        $store->id_no = $request->id_no;
        $store->designation = $request->designation;
        $store->level = 0;
        $store->save();
        
        return back();
    }
    
    public function updateVoter(Request $request)
     {
        $store = Voter::find($request->voter_id);
        $store->name = $request->name;
        $store->role_id = $request->role_id;
        $store->id_no = $request->id_no;
        $store->designation = $request->designation;
        $store->level = 0;
        $store->update();
        
        return back();
    }
    
    public function deleteRecord(Request $request)
     {
        $record = Nominee::find($request->record_id);
        $record->delete();
        
        return back();
    }
     public function deleteCriteria(Request $request)
     {
        $record = Criteria::find($request->record_id);
        $record->delete();
        
        return back();
    }
    
    public function editImage(Request $request)
     {
        $record = Image::find($request->image_id);
        $record->caption = $request->caption;
        $record->update();
        
        return back();
     }
     
     public function deleteImage($id)
     {
        $record = Image::find($id);
        $record->delete();
        
        return back();
     }
    
    public function deleteAward(Request $request)
     {
        $record = Reward::find($request->award_id);
        $record->delete();
        
        return back();
    }
    public function updateAward(Request $request)
     {
        $record = Reward::find($request->award_id);
        $record->description = $request->description;
        $record->name = $request->award;
        $record->update();
        
        return back();
    }
    
     public function addAward(Request $request)
     {
        $record = new Reward;
        $record->name = $request->award;
        $record->description = $request->description;
        $record->role_id = 0;
        $record->save();
        
        return back();
    }
    
    public function getResults($id)
     {
         $results = array();
        $awards = Reward::all();
        $polluser = Voter::find($id);
        
        
        return view('Poll.results')->with('results', $results)->with('awards', $awards)->with('polluser', $polluser);
    }
    
    public function searchAward(Request $request)
     {
        $results = Vote::where('reward_id', $request->award_id)->get();
        $nominees =  Vote::where('reward_id', $request->award_id)->pluck('nominated_id')->unique();
        $award = Reward::find($request->award_id);
        $awards = Reward::all();
        $polluser = Voter::find($request->poll_id);
        
        
        return view('Poll.results')->with('results', $results)->with('awards', $awards)->with('award', $award)->with('nominees', $nominees)->with('polluser', $polluser);
    } 
    public function getImages($id)
     {
        $topright = Image::where('location', 1)->get();
        $bottomright = Image::where('location', 3)->get();
        $topleft = Image::where('location', 2)->get();
        $bottomleft = Image::where('location', 4)->get();
        $centers = Image::where('location', 5)->get();
        $polluser = Voter::find($id);
    
        
        return view('Poll.images')->with('topright', $topright)->with('topleft', $topleft)->with('bottomright', $bottomright)->with('bottomleft', $bottomleft)->with('centers', $centers)->with('polluser', $polluser);
    }
    
     public function saveImage(Request $request)
    {
             $token_id = rand(10000,90000);
            //Handle documents upload
             //Get document names with extension.
            if($request->hasFile('image'))
            {  
                $documentOneName = $request->file('image')->getClientOriginalName();
                $docNameOneToStore = $token_id.'_'.$documentOneName;
            }
            else
            {
                $documentOneName = $nominee->img_url;
                $docNameOneToStore = $nominee->img_url;
            }
        
             //Uploading the Documents now
            if($request->hasFile('image'))
            {
                $path1 = $request->file('image')->storeAs('Documents', $docNameOneToStore);
            }

        $image = new Image;
        $image->image_url = $docNameOneToStore;
        $image->location = $request->location;
        $image->caption = $request->caption;
        $image->save();

        
        return back();
    }

}
