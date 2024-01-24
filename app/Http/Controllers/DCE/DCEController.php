<?php

namespace App\Http\Controllers\DCE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Staff\Requisition;
use App\Staff\Document;
use App\Staff\comment;
use App\Staff\Voucherbook;
use App\Staff\Burferfloat;
use App\Staff\Category;
use App\Staff\Cashbook;
use App\Staff\Department;
use App\Admin\MobilePayment;
use App\Admin\StkResponse;
use App\Admin\Division;
use App\DCE\Dailycasuals;
use App\DCE\DCEApprovals;
use App\DCE\Casual;
use App\HiredCasuals;
use App\Deduction;
use App\Staff\Category_history;
use App\Mail\ApprovalMail;
use App\Mail\CashApproval;
use App\Mail\UserRequisition;
use App\Mail\CashRequisition;
use App\Mail\BufferFloat;
use App\Mail\DailyCasual;
use App\Mail\DailyCasualApproval;
use App\Mail\DailyCasualsApprovalRequest;
use Illuminate\Support\Facades\Mail;
use App\User;
use Auth;
use Log;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class DCEController extends Controller
{
    public function userApplications()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Request Successfully');
        }
        elseif(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $applications = DailyCasuals::where('user_id', auth::user()->id)->get();
        $approvals = DCEApprovals::all();
        return view('DCE.user_applications')->with('applications',$applications)
                                            ->with('approvals', $approvals);
    }

    public function applicationForm()
    {
        return view('DCE.application_form');
    }

    //store staff DCE requisitions
    public function storeDCERequest(Request $request)
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Request Successfully');
        }
        elseif(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $day=$request->input('day');
            if($day == 1)
            {
                $total_days = 1;
            }
            elseif($day == 0.5)
            {
                $total_days = 0.5;
            }
            else
            {
                $upto_date=strtotime($request->input('end_date')); 
                $from_date = strtotime($request->input('start_date'));
                $day_diff = $upto_date - $from_date;
                $rounded_days = floor($day_diff/(60*60*24)+1);
                $total_days = ($rounded_days - $request->input('saturday') - $request->input('sunday'));
            }

        if($total_days < 1)
        {
            $rate_per_casual = 350;
        }
        else
        {
            $rate_per_casual = 653;
        }
        //getting department details
        $dep_id = $request->input('department_id');
        $hod = Department::find($dep_id);
        $hod_id = $hod->hod_id;
        $hod_data = User::find($hod_id);
        $hod_email = $hod_data->email;
       
        //getting division details
        if($request->input('division_id') == 0)
        {
            $div_id = $request->input('department_id');
            $line_manager_id = $hod_id;
        }
        else
        {
        $div_id = $request->input('division_id');
        $division = Division::find($div_id);
        $line_manager_id = $division->line_manager_id;
        $manager_data = User::find($line_manager_id);
        $line_manager_email = $manager_data->email;
        }
        
        //Getting user data
        $user_email = auth::user()->email;
       
        $new_requisition = new Dailycasuals;
        $new_requisition->user_id = $request->input('user_id');
        $new_requisition->dept_id = $request->input('department_id');
        $new_requisition->div_id = $request->input('division_id');
        $new_requisition->no_of_casuals = $request->input('no_of_casuals');
        $new_requisition->start_date = $request->input('start_date');
        $new_requisition->end_date = $request->input('end_date');
        $new_requisition->no_of_days = $total_days;
        $new_requisition->reason = $request->input('reason');
        $new_requisition->token_id = $request->input('request_token');
        $new_requisition->hod_id = $hod_id;
        $new_requisition->manager_id = $line_manager_id;
        $new_requisition->rate_per_casual = $rate_per_casual;
        $new_requisition->save();

        $new_approval = new DCEApprovals;
        $new_approval->token_id = $request->input('request_token');
        $new_approval->process_status = 20;
        $new_approval->hod_id = $hod_id;
        $new_approval->save();

        $email_type = 0;


        Mail::to($user_email)->send(new DailyCasual($request, $total_days, $email_type));
        Mail::to($hod_email)->send(new DailyCasualApproval($request, $total_days, $hod_data));
        Mail::to('it.assistant@kimfay.com')->send(new DailyCasual($request, $total_days, $email_type));
        Mail::to('it.assistant@kimfay.com')->send(new DailyCasualApproval($request, $total_days, $hod_data));
        //Mail::to('it.assistant@kimfay.com')->send(new UserRequisition($request,$email_type,$to_approve,$user_name));
        $applications = DailyCasuals::where('user_id', auth::user()->id)->get();
        $approvals = DCEApprovals::all();
        return view('DCE.user_applications')->with('success','Request successfull')
                                            ->with('applications',$applications)
                                            ->with('approvals', $approvals);

    }

    public function editForm($id)
    {
        $dce_requisition = Dailycasuals::where('token_id',$id)->first();
        $approvals = DCEApprovals::where('token_id',$id)->first();
        return view('DCE.edit_application')->with('dce_requisition',$dce_requisition)
                                           ->with('approvals',$approvals);
    }

    //Edit staff DCE requisitions
    public function editDCERequest(Request $request, $id)
    {
        $day=$request->input('day');
            if($day == 1)
            {
                $total_days = 1;
            }
            elseif($day == 0.5)
            {
                $total_days = 0.5;
            }
            else
            {
                $upto_date=strtotime($request->input('end_date')); 
                $from_date = strtotime($request->input('start_date'));
                $day_diff = $upto_date - $from_date;
                $rounded_days = floor($day_diff/(60*60*24)+1);
                $total_days = ($rounded_days - $request->input('saturday') - $request->input('sunday'));
            }
        //getting department details
        $dep_id = $request->input('department_id');
        $hod = Department::find($dep_id);
        $hod_id = $hod->hod_id;
        $hod_data = User::find($hod_id);
        $hod_email = $hod_data->email;

        
        //Getting user data
        $user_email = auth::user()->email;
       
        $new_requisition = Dailycasuals::find($id);
        $new_requisition->dept_id = $request->input('department_id');
        $new_requisition->no_of_casuals = $request->input('no_of_casuals');
        $new_requisition->start_date = $request->input('start_date');
        $new_requisition->end_date = $request->input('end_date');
        $new_requisition->no_of_days = $total_days;
        $new_requisition->reason = $request->input('reason');
        $new_requisition->token_id = $request->input('request_token');
        $new_requisition->hod_id = $hod_id;
        $new_requisition->update();

        //Mail::to('it.assistant@kimfay.com')->send(new ApprovalMail($request, $user));
        //Mail::to('it.assistant@kimfay.com')->send(new UserRequisition($request,$email_type,$to_approve,$user_name));
        $applications = DailyCasuals::where('user_id', auth::user()->id)->get();
        $approvals = DCEApprovals::all();
        return back()->with('success','Request successfull')
                                            ->with('applications',$applications)
                                            ->with('approvals', $approvals);

    }

    public function hodApplications()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Request Successfully');
        }
        elseif(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $applications = DailyCasuals::where('hod_id', auth::user()->id)->orderBy('created_at','DESC')->limit(20)->get();
        $approvals = DCEApprovals::all();
        return view('DCE.hod_applications')->with('applications',$applications)
                                            ->with('approvals', $approvals);
    }

    public function hodViewApplication($id)
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Approved Successfully');
        }
        elseif(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $dce_requisition = Dailycasuals::where('token_id',$id)->first();
        $approvals = DCEApprovals::where('token_id',$id)->first();
        return view('DCE.hod_view_application')->with('dce_requisition',$dce_requisition)
                                               ->with('approvals', $approvals);
    }

     //approve a request by HOD
     public function approveDCERequisitionsHOD(Request $request, $id)
     {
        if(session('success'))
        {
            Alert::success('Success!', 'Approved Successfully');
        }
        elseif(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
         $to_approve = DCEApprovals::find($request->approval_id);
         $to_approve->hod_id = $request->input('hod_id');
         $to_approve->hod_approval_date = date("l jS \of F Y h:i:s A");
         $to_approve->hod_approval = 1;
         $to_approve->process_status = 40;
         $to_approve->update();

         $requisition_details = Dailycasuals::where('token_id',$request->token_id)->first();
 
         Mail::to('hr.assistant@kimfay.com')->send(new DailyCasualsApprovalRequest($requisition_details));
         Mail::to('it.assistant@kimfay.com')->send(new DailyCasualsApprovalRequest($requisition_details));
         Mail::to('hr.officer@kimfay.com')->send(new DailyCasualsApprovalRequest($requisition_details));
         return back()->with('success','Approved Successfully');
     }

     //decline a request by HOD
    public function declineDCERequisitions(Request $request, $id)
    {
        $to_decline = DCEApprovals::find($request->decline_id);
        $to_decline->hod_approval = 2;
        $to_decline->decline_id = $request->input('hod_id');
        $to_decline->decline_reason = $request->input('reason');
        $to_decline->decline_date = date("l jS \of F Y h:i:s A");
        $to_decline->update();
        
        return back()->with('decline','Declined Successfully');
    }

    public function wagesApplications()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Request Successfully');
        }
        elseif(session('error'))
        {
            Alert::error('Error!', 'Casual already added to this engagement');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $applications = DailyCasuals::latest('created_at')->paginate(10);
        $approvals = DCEApprovals::all();
        return view('DCE.wages_application')->with('applications',$applications)
                                            ->with('approvals', $approvals);
    }

    public function wagesViewApplication($id)
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Request Successfully');
        }
        elseif(session('error'))
        {
            Alert::error('Error!', 'Casual already added to this engagement');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $dce_requisition = Dailycasuals::where('token_id',$id)->first();
        $approvals = DCEApprovals::where('token_id',$id)->first();
        $casuals = Casual::all();
        $selected = HiredCasuals::where('token_id',$id)->get();
        return view('DCE.wages_view_application')->with('dce_requisition',$dce_requisition)
                                                 ->with('casuals',$casuals)
                                                 ->with('selected',$selected)
                                               ->with('approvals', $approvals);
    }

    public function budgetApplications()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Request Successfully');
        }
        elseif(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $applications = DailyCasuals::latest('created_at')->paginate(10);
        $approvals = DCEApprovals::all();
        return view('DCE.budget_applications')->with('applications',$applications)
                                            ->with('approvals', $approvals);
    }

    public function budgetViewApplication($id)
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Approved Successfully');
        }
        elseif(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $dce_requisition = Dailycasuals::where('token_id',$id)->first();
        $approvals = DCEApprovals::where('token_id',$id)->first();
        return view('DCE.budget_view_application')->with('dce_requisition',$dce_requisition)
                                               ->with('approvals', $approvals);
    }

    //budget a request
    public function budgetDCERequisitions(Request $request, $id)
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Approved Successfully');
        }
        elseif(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $to_approve = DCEApprovals::find($request->approval_id);
        $to_approve->budgetofficer_id = $request->input('budget_id');
        $to_approve->budget_approval_date = date("l jS \of F Y h:i:s A");
        $to_approve->budget_approval = 1;
        $to_approve->process_status = 80;
        $to_approve->update();

        $requisition_details = Dailycasuals::where('token_id',$request->token_id)->first();

        Mail::to('hr@kimfay.com')->send(new DailyCasualsApprovalRequest($requisition_details));
        Mail::to('hr.assistant@kimfay.com')->send(new DailyCasualsApprovalRequest($requisition_details));
        Mail::to('hr.officer@kimfay.com')->send(new DailyCasualsApprovalRequest($requisition_details));
        Mail::to('it.assistant@kimfay.com')->send(new DailyCasualsApprovalRequest($requisition_details));
        return back()->with('success','Approved Successfully');
    }

    //decline a request by budget officer
   public function declineDCERequisitionsBudget(Request $request, $id)
   {
       $to_decline = DCEApprovals::find($request->decline_id);
       $to_decline->budget_approval = 2;
       $to_decline->decline_id = $request->input('hod_id');
       $to_decline->decline_reason = $request->input('reason');
       $to_decline->decline_date = date("l jS \of F Y h:i:s A");
       $to_decline->update();
       
       return back()->with('decline','Declined Successfully');
   }

   public function fetchCasuals()
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
        $casuals = Casual::latest('created_at')->get();
        
        return view('DCE.casuals')->with('casuals', $casuals);
    }

    public function addCasualForm()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'User Added Successfully');
        }
        elseif(session('error'))
        {
            Alert::error('Error!', 'ID Already Registerd');
        }
        elseif(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        return view('DCE.add_casual_form');
    }

    public function submitCasual(Request $request)
    {
        $user = new Casual;
        $user->casual_name = $request->input('name');
        $user->casual_id_no = $request->input('number');
        $user->nssf_no = $request->input('nssf');
        $user->nhif_no = $request->input('nhif');
        $user->kra_pin = $request->input('kra');
        $user->tel_no = $request->input('phone');
        $user->next_of_kin_name = $request->input('next_of_kin_name');
        $user->next_of_kin_relationship = $request->input('relationship');
        $user->next_of_kin_id = $request->input('next_of_kin_id');
        $user->next_of_kin_tel = $request->input('next_of_kin_tel');
        $user->gender = $request->input('gender');
        $ID_check = Casual::where('casual_id_no', $request->number)->get();
        if(count($ID_check) > 0)
        {
            return back()->with('error', 'ID in Use');
        }
        else
        {
            $user->save();
            return view('DCE.casuals')->with('success', 'User Added Successfully');
            
        }
        
    }

    public function showCasual($id)
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

        $casual= Casual::find($id);

        return view('DCE.edit_casual_form')->with('casual',$casual);
    }

    public function editCasual(Request $request, $id)
    {
        $user = Casual::find($id);
        $user->casual_name = $request->input('name');
        $user->casual_id_no = $request->input('number');
        $user->nssf_no = $request->input('nssf');
        $user->nhif_no = $request->input('nhif');
        $user->kra_pin = $request->input('kra');
        $user->tel_no = $request->input('phone');
        $user->next_of_kin_name = $request->input('next_of_kin_name');
        $user->next_of_kin_relationship = $request->input('relationship');
        $user->next_of_kin_id = $request->input('next_of_kin_id');
        $user->next_of_kin_tel = $request->input('next_of_kin_tel');
        $user->gender = $request->input('gender');
        $ID_check = Casual::where('casual_id_no', $request->number)->get();
        $user->update();

        $casuals = Casual::latest('created_at')->get();
        return redirect('/casuals')->with('success', 'User Added Successfully')->with('casuals',$casuals);

    }

    public function findCasual(Request $request)
    {
        $data4 = Deduction::where('user_id',$request->id)->get();
        return response()->json($data4);
    }
    public function confirmPayment(Request $request)
    {
        $data4 = StkResponse::where('CheckoutRequestID',$request->id)->first();
        return response()->json($data4);
    }

     //wages approval
     public function wagesDCERequisitions(Request $request, $id)
     {
         $requisition_details = Dailycasuals::where('token_id',$request->token_id)->first();
         $to_approve = DCEApprovals::find($request->wages_id);
         $to_approve->wages_id = auth::user()->id;
         $to_approve->wages_approval_date = date("l jS \of F Y h:i:s A");
         $to_approve->wages_approval = 1;
         if($to_approve->wages_approval != 1)
         {
             $to_approve->process_status = 60;
             Mail::to('productionanalyst@kimfay.com')->send(new DailyCasualsApprovalRequest($requisition_details));
              Mail::to('it.assistant@kimfay.com')->send(new DailyCasualsApprovalRequest($requisition_details));
         }
         $to_approve->update();

         $update_deductions = Dailycasuals::where('token_id',$request->token_id)->first();
         $update_deductions->tax = $request->input('tax');
         $update_deductions->nhif = $request->input('nhif');
         $update_deductions->nssf = $request->input('nssf');
         $update_deductions->rate_per_casual = $request->input('rate');
         $update_deductions->update();
 
         $requisition_details = Dailycasuals::where('token_id',$request->token_id)->first();
        if($to_approve->wages_approval != 1)
         {
              Mail::to('productionanalyst@kimfay.com')->send(new DailyCasualsApprovalRequest($requisition_details));
              Mail::to('it.assistant@kimfay.com')->send(new DailyCasualsApprovalRequest($requisition_details));
         }
        
         return back()->with('success','Approved Successfully');
     }

     public function submitPreferedCasual(Request $request)
     {
        $casual = new HiredCasuals;
        $casual->user_id = $request->input('casual_id');
        $casual->tax = $request->input('tax');
        $casual->token_id = $request->input('token_id');
        $casual->nhif = $request->input('nhif');
        $casual->nssf = $request->input('nssf');
        $casual->total_deductions = $request->input('total_deductions');
        $casual->gross_pay = $request->input('gross');
        $casual->net_pay = $request->input('net');

        $casual_check = HiredCasuals::where([['token_id',$request->input('token_id')],['user_id',$request->input('casual_id')]])->get();
        if(count($casual_check) !=0)
        {
            $selected = HiredCasuals::where('token_id',$request->input('token_id'))->get();
            return back()->with('error','ID Already Registerd')->with('selected',$selected);
        }
        else
        {
            $casual->save();
        }
        

        $selected = HiredCasuals::where('token_id',$request->input('token_id'))->get();
        return back()->with('selected',$selected);
     }

      //destroy department
    public function destroyChoosenCasual(Request $request, $id)
    {
        $to_destroy = HiredCasuals::find($id);
        $to_destroy->delete();

        return back()->with('deleted','User Deleted Successfully');   
    }
 
    public function hrManagerApplications()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Request Successfully');
        }
        elseif(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $applications = DailyCasuals::latest('created_at')->paginate(10);
        $approvals = DCEApprovals::all();
        return view('DCE.hr_manager_applications')->with('applications',$applications)
                                            ->with('approvals', $approvals);
    }

    public function hrManagerViewApplication($id)
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Approved Successfully');
        }
        elseif(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $dce_requisition = Dailycasuals::where('token_id',$id)->first();
        $approvals = DCEApprovals::where('token_id',$id)->first();
        return view('DCE.hr_manager_view_applications')->with('dce_requisition',$dce_requisition)
                                               ->with('approvals', $approvals);
    }

    public function hrManagerDCERequisitions(Request $request, $id)
    {
        $to_approve = DCEApprovals::find($request->approval_id);
        $to_approve->hr_id = $request->input('hr_id');
        $to_approve->hr_approval_date = date("l jS \of F Y h:i:s A");
        $to_approve->hr_approval = 1;
        $to_approve->process_status = 100;
        $to_approve->update();

        $requisition_details = Dailycasuals::where('token_id',$request->token_id)->first();
        $user_data = User::find($requisition_details->user_id);
        $user_email = $user_data->email;
        $email_type = 1;
        $request = $requisition_details;
        $total_days = $requisition_details->no_of_days;

        Mail::to($user_email)->send(new DailyCasual($request, $total_days, $email_type));
        Mail::to('hr.assistant@kimfay.com')->send(new DailyCasualsApprovalRequest($requisition_details));
        Mail::to('hr.officer@kimfay.com')->send(new DailyCasualsApprovalRequest($requisition_details));
        Mail::to('it.assistant@kimfay.com')->send(new DailyCasualsApprovalRequest($requisition_details));
        return back()->with('success','Approved Successfully');
    }

    
   public function declineDCERequisitionshrManager(Request $request, $id)
   {
       $to_decline = DCEApprovals::find($request->decline_id);
       $to_decline->hr_approval = 2;
       $to_decline->decline_id = $request->input('hr_id');
       $to_decline->decline_reason = $request->input('reason');
       $to_decline->decline_date = date("l jS \of F Y h:i:s A");
       $to_decline->update();
       
       return back()->with('decline','Declined Successfully');
   }

   public function approvals($id)
   {
    $selected = HiredCasuals::where('token_id',$id)->get();
    $dce_requisition = Dailycasuals::where('token_id',$id)->first();
    $approvals = DCEApprovals::where('token_id',$id)->first();

    return view('DCE.print_approvals')->with('selected',$selected)
                                      ->with('dce_requisition',$dce_requisition)
                                      ->with('approvals',$approvals);
   }
   public function contract($id)
   {
    $selected = HiredCasuals::where('token_id',$id)->get();
    $dce_requisition = Dailycasuals::where('token_id',$id)->first();
    $approvals = DCEApprovals::where('token_id',$id)->first();

    return view('DCE.print_contract')->with('selected',$selected)
                                      ->with('dce_requisition',$dce_requisition)
                                      ->with('approvals',$approvals);
   }
   public function reports()
   {
       $reports = Dailycasuals::whereDate('created_at', Carbon::today())->get();
       
       return view('DCE.reports')->with('reports', $reports);
   }
  
    public function dailyReports(Request $request)
   {
        $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date);
        $reports = Dailycasuals::whereBetween('created_at', [$startDate, $endDate])->get();
       
       return view('DCE.reports')->with('reports', $reports);
   }




}
