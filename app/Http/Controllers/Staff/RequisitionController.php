<?php

namespace App\Http\Controllers\Staff;

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
use App\Admin\Division;
use App\DCE\Dailycasuals;
use App\DCE\DCEApprovals;
use App\Staff\Category_history;
use App\Mail\ApprovalMail;
use App\Mail\CashApproval;
use App\Mail\UserRequisition;
use App\Mail\CashRequisition;
use App\Mail\BufferFloat;
use Illuminate\Support\Facades\Mail;
use App\User;
use Auth;
use Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class RequisitionController extends Controller
{
    public function fetchUserRequisitions()
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
        $requisitions = Requisition::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);  

        return view('Staff.staff_requisitions')->with('requisitions',$requisitions);
    }

    //fetch expense categories
    public function fetchCategories()
    {
        $categories = Category::latest('created_at')->paginate(10);  
        return view('Staff.expense_categories')->with('categories',$categories);
    }

    //Fetch HODs approvals and requisitions
    public function fetchHODRequisitions()
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
        $hod_requisitions = Requisition::where('hod_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);  

        return view('Staff.hod_requisitions')->with('hod_requisitions',$hod_requisitions);
    }

    //Fetch budget owner approvals
    public function fetchBudgetOwnerRequisitions()
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
        $budgeto_requisitions = Requisition::where('budgeto_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);  

        return view('Staff.budget_owner_requisitions')->with('budgeto_requisitions',$budgeto_requisitions);
    }

    //Fetch Budget Manager approvals and requisitions
    public function fetchBudgetManagerRequisitions()
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
        $budget_requisitions = Requisition::latest('created_at')->paginate(10);    

        return view('Staff.budget_requisitions')->with('budget_requisitions',$budget_requisitions);
    }

     //Fetch CFO approvals and requisitions
     public function fetchcfoRequisitions()
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
         $cfo_requisitions = Requisition::latest('created_at')->paginate(10);  
 
         return view('Staff.cfo_requisitions')->with('cfo_requisitions',$cfo_requisitions);
     }

       //Fetch IA approvals and requisitions
       public function fetchiaRequisitions()
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
           $ia_requisitions = Requisition::all();  
   
           return view('Staff.ia_requisitions')->with('ia_requisitions',$ia_requisitions);
       }

    //Fetch All Voucher books.
    public function fetchVoucherBooks()
    {   
        if(session('success'))
        {
            toast('Created Successfully','success');
        }
        elseif(session('closed'))
        {
            toast('Clossed Successfully','success');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $incomplete = Requisition::where('process_status','<','100')->get();
        $opened = Voucherbook::where('status',0)->get(); 
        $bridged= Voucherbook::where('status',2)->get();
        $number = count($opened);
        $voucherbooks = Voucherbook::latest('created_at')->paginate(10);

        return view('Staff.voucherbooks')->with('voucherbooks',$voucherbooks)->
                                           with('number',$number)->
                                           with('incomplete',$incomplete)->
                                           with('bridged',$bridged);
    }

    //Fetch Admin approvals and requisitions
    public function fetchAdminRequisitions()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Issued Successfully');
        }
        elseif(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $admin_requisitions = Requisition::all();  

        return view('Staff.admin_requisitions')->with('admin_requisitions',$admin_requisitions);
    }

    //show specific requisition to the HOD
    public function showRequisitions($id)
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Approved Successfully');
        }
        elseif(session('decline'))
        {
            Alert::success('Success!', 'Declined Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $specific_requisition = Requisition::where('token_id',$id)->get(); 
        return view('Staff.hod_view_requisition')->with('specific_requisition', $specific_requisition);
    }

    //show specific requisition to the Budget Manager
    public function showBudgetRequisitions($id)
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Approved Successfully');
        }
        elseif(session('decline'))
        {
            Alert::success('Success!', 'Declined Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $categories = Category::all();
        $specific_budget_requisition = Requisition::where('token_id',$id)->get(); 
        return view('Staff.budget_view_requisition')->with('specific_budget_requisition', $specific_budget_requisition)->
                                                      with('categories', $categories);
    }


    //show specific requisition to the CFO
    public function showcfoRequisitions($id)
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Approved Successfully');
        }
        elseif(session('decline'))
        {
            Alert::success('Success!', 'Declined Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $specific_cfo_requisition = Requisition::where('token_id',$id)->get(); 
        return view('Staff.cfo_view_requisitions')->with('specific_cfo_requisition', $specific_cfo_requisition);
    }


    //show specific requisition to the IA
    public function showiaRequisitions($id)
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
        //fetch comments
        $comments = comment::where('token_id',$id)->get();  
        $specific_ia_requisition = Requisition::where('token_id',$id)->get(); 
        return view('Staff.ia_view_requisitions')->with('specific_ia_requisition', $specific_ia_requisition)
                                                 ->with('comments', $comments);
    }

    //view a choosen expense category
    public function viewCategory($id)
    {
        $specific_category = Category::find($id); 
        $expense_history = Category_history::where('cat_id',$id)->orderBy('created_at','asc')->get(); 
        $categories = Category::all();
        return view('Staff.view_expense')->with('specific_category', $specific_category)
                                         ->with('expense_history', $expense_history)
                                         ->with('categories', $categories);
    }

     //search a choosen expense category
     public function searchCategory(Request $request)
     {
         $specific_category = Category::find($request->category_id); 
         $expense_history = Category_history::where('cat_id',$request->category_id)->orderBy('created_at','asc')->get(); 
         $categories = Category::all();
         return view('Staff.view_expense')->with('specific_category', $specific_category)
                                          ->with('expense_history', $expense_history)
                                          ->with('categories', $categories);
     }

     //expand specific requisition to the IA
     public function expandiaRequisitions($id)
     {
         $specific_expanded_requisition = Requisition::where('voucher_id',$id)->orderBy('created_at','desc')->get(); 
            $all = Requisition::where('voucher_id',$id)->get(); 
               $number_of_all = count($all);
               $number = count($all);
            $complete = Requisition::where([['voucher_id',$id],['process_status',100]])->get(); 
               $number_of_complete = count($complete);
            $incomplete = Requisition::where([['voucher_id',$id],['process_status','<',100]])->get(); 
               $number_of_incomplete = count($incomplete);
         $voucher_data = Voucherbook::find($id);
         $type = 'All Vouchers';
         $cashbook = 0;
         $book_info = Cashbook::where('voucher_book_no', 0)->get();
         return view('Staff.ia_extended_requisitions')->with('specific_expanded_requisition', $specific_expanded_requisition)->
                                                        with('voucher_data', $voucher_data)->
                                                        with('number', $number)->
                                                        with('cashbook', $cashbook)->
                                                        with('book_info', $book_info)->
                                                        with('number_of_all', $number_of_all)->
                                                        with('number_of_complete', $number_of_complete)->
                                                        with('number_of_incomplete', $number_of_incomplete)->
                                                        with('type', $type);
     }

     //expand specific requisition to the IA
     public function checkVoucher(Request $request)
     {
         if($request->button_type == 2)
         {
            $specific_expanded_requisition = Requisition::where('voucher_id',$request->voucher_book_id)->orderBy('created_at','desc')->get(); 
            $number = count($specific_expanded_requisition);
            $voucher_data = Voucherbook::find($request->voucher_book_id);
            $book_info = Cashbook::where('voucher_book_no', $request->voucher_book_id)->get();
            $comments = comment::where('voucher_book_no', $request->voucher_book_id)->get();
            $type = $request->type;
            $cashbook = 0;
         }
         elseif($request->button_type == 1)
         {
            $specific_expanded_requisition = Requisition::where([['voucher_id',$request->voucher_book_id],['process_status',100]])->orderBy('created_at','desc')->get(); 
            $number = count($specific_expanded_requisition);
            $voucher_data = Voucherbook::find($request->voucher_book_id);
            $book_info = Cashbook::where('voucher_book_no', $request->voucher_book_id)->get();
            $comments = comment::where('voucher_book_no', $request->voucher_book_id)->get();
            $type = $request->type;
            $cashbook = 0;
         }
         elseif($request->button_type == 0)
         {
            $specific_expanded_requisition = Requisition::where([['voucher_id',$request->voucher_book_id],['process_status','<',100]])->orderBy('created_at','desc')->get(); 
            $number = count($specific_expanded_requisition);
            $voucher_data = Voucherbook::find($request->voucher_book_id);
            $book_info = Cashbook::where('voucher_book_no', $request->voucher_book_id)->get();
            $comments = comment::where('voucher_book_no', $request->voucher_book_id)->get();
            $type = $request->type;
            $cashbook = 0;
         }
         elseif($request->button_type == 3)
         {
            $specific_expanded_requisition = Requisition::where([['voucher_id',$request->voucher_book_id],['process_status',100]])->orderBy('created_at','desc')->get(); 
            $number ='';
            $voucher_data = Voucherbook::find($request->voucher_book_id);
            $book_info = Cashbook::where('voucher_book_no', $request->voucher_book_id)->get();
            $comments = comment::where('voucher_book_no', $request->voucher_book_id)->get();
            $type = $request->type;
            $cashbook = 1;
         }
         $all = Requisition::where('voucher_id',$request->voucher_book_id)->orderBy('created_at','desc')->get(); 
            $number_of_all = count($all);
         $complete = Requisition::where([['voucher_id',$request->voucher_book_id],['process_status',100]])->orderBy('created_at','desc')->get(); 
            $number_of_complete = count($complete);
        $incomplete = Requisition::where([['voucher_id',$request->voucher_book_id],['process_status','<',100]])->orderBy('created_at','desc')->get(); 
             $number_of_incomplete = count($incomplete);

        return view('Staff.ia_extended_requisitions')->with('specific_expanded_requisition', $specific_expanded_requisition)->
                                                       with('voucher_data', $voucher_data)->
                                                       with('number', $number)->
                                                       with('comments', $comments)->
                                                       with('cashbook', $cashbook)->
                                                       with('book_info', $book_info)->
                                                       with('number_of_all', $number_of_all)->
                                                       with('number_of_complete', $number_of_complete)->
                                                       with('number_of_incomplete', $number_of_incomplete)->
                                                       with('type', $type);
     }
 

     //show specific requisition to the Budget owner
     public function showBudgetOwnerRequisitions($id)
     {
        if(session('success'))
        {
            Alert::success('Success!', 'Approved Successfully');
        }
        elseif(session('decline'))
        {
            Alert::success('Success!', 'Declined Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
         $specific_budget_owner_requisition = Requisition::where('token_id',$id)->get(); 
         return view('Staff.budget_owner_view_requisition')->with('specific_budget_owner_requisition', $specific_budget_owner_requisition);
     }
    
    //show specific requisition to the Admin
    public function showAdminRequisitions($id)
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Issued Successfully');
        }
        elseif(session('decline'))
        {
            Alert::success('Success!', 'Declined Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $specific_admin_requisition = Requisition::where('token_id',$id)->get(); 
        return view('Staff.admin_view_requisition')->with('specific_admin_requisition', $specific_admin_requisition);
    }


    //show specific requisition for documents upload to the admin
    public function showDocumentRequisitions($id)
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Issued Successfully');
        }
        elseif(session('decline'))
        {
            Alert::success('Success!', 'Declined Successfully');
        }
        elseif(session('rolled'))
        {
            Alert::success('Success!', 'Call back Successful');
        }
        $specific_document_requisition = Requisition::where('token_id',$id)->get();
        $file = "Click on a document to view"; 
        $specific_document = Document::where('token_id',$id)->get();
        $comments = comment::where('token_id',$id)->get();
        return view('Staff.document_view_requisition')->with('specific_document_requisition', $specific_document_requisition)->
                                                        with('file', $file)->
                                                        with('comments', $comments)->
                                                        with('specific_document', $specific_document);
    }

    //approve a request by HOD
    public function approveRequisitions(Request $request, $id)
    {
        $to_approve = Requisition::find($request->approval_id);
        $to_approve->hod_approver_id = $request->input('hod_id');
        $to_approve->hod_approval_date = date("l jS \of F Y h:i:s A");
        $to_approve->hod_approval_status = 1;
        $to_approve->process_status = 40;
        $to_approve->update();

        //Getting email addresses of the budget owner.
        $budgeto_id = $to_approve->budgeto_id;
        $budgeto_e = User::find($budgeto_id);
        $budgeto_email = $budgeto_e->email;
        $budgeto_name = $budgeto_e->name;
        $user_id = $to_approve->user_id;
        $finduser = User::find($user_id); 
        $user_name = $finduser->name;

        Mail::to('it.assistant@kimfay.com')->send(new CashApproval($to_approve, $user_name, $budgeto_name));
        
        return back()->with('success','Approved Successfully');
    }


    //validate documents
    public function validateDocument(Request $request)
    {
        $to_validate = Document::find($request->doc_id);
        $to_validate->approval = $request->input('button_type');
        $to_validate->update();

        $checker_validated = Document::where([['token_id',$request->token],['approval',1]])->get();
        $number_validated = count($checker_validated);
        $checker_all = Document::where('token_id',$request->token)->get();
        $number_all = count($checker_all);
        if($number_validated == $number_all)
        {
            $process_status = 100;
        }
        else
        {
            $process_status = 90; 
        }

        $requisition = Requisition::find($request->token_id);
        $requisition->process_status = $process_status;
        $requisition->update();
        
        return back();
    }

     //approve a request by CFO
     public function approvecfoRequisitions(Request $request, $id)
     {
         $to_approve = Requisition::find($request->approval_id);
         $to_approve->cfo_approver_id = $request->input('cfo_id');
         $to_approve->cfo_approval_date = date("l jS \of F Y h:i:s A");
         $to_approve->cfo_approval_status = 1;
         $to_approve->cfo_ia_status = 1;
         $to_approve->process_status = 60;
         $to_approve->update();

         //Getting user details
         $user_id = $to_approve->user_id;
         $finduser = User::find($user_id); 
         $user_name = $finduser->name;
         $email_type = 1;
         $request = $to_approve;
 
         Mail::to('it.assistant@kimfay.com')->send(new CashRequisition($to_approve, $user_name));
         Mail::to('it.assistant@kimfay.com')->send(new UserRequisition($to_approve,$email_type,$request,$user_name));
         
         return back()->with('success','Approved Successfully');
     }


     //approve a request by IA
     public function approveiaRequisitions(Request $request, $id)
     {
         $to_approve = Requisition::find($request->approval_id);
         $to_approve->ia_approver_id = $request->input('ia_id');
         $to_approve->ia_approval_date = date("l jS \of F Y h:i:s A");
         $to_approve->ia_approval_status = 1;
         $to_approve->cfo_ia_status = 1;
         $to_approve->process_status = 60;
         $to_approve->update();


         //Getting user details
         $user_id = $to_approve->user_id;
         $finduser = User::find($user_id); 
         $user_email = $finduser->email;
         $user_name = $finduser->name;
         $email_type = 1;
         $request = $to_approve;
 
         Mail::to('it.assistant@kimfay.com')->send(new CashRequisition($to_approve, $user_name));
         Mail::to('it.assistant@kimfay.com')->send(new UserRequisition($to_approve,$email_type,$request,$user_name));
         
         return back()->with('success','Approved Successfully');
     }

      //destroy category
      public function destroyCategory(Request $request, $id)
      {
          $to_destroy = Category::find($request->category_id);
          $to_destroy->delete();
          return back();
      }

       //find mtd
       public function findMTD(Request $request)
       {
           $data= Category::find($request->id);
           return response()->json($data);
       }
       //find HOD
       public function findHOD(Request $request)
       {
           $data2= Department::find($request->id);
           return response()->json($data2);
       }
       //find mtd
       public function findDivision(Request $request)
       {
           $data= Division::where('department_id',$request->id)->get();
           return response()->json($data);
       }

        //destroy requisition
      public function destroyRequisition(Request $request, $id)
      {
          $to_destroy = Requisition::find($request->requisition_id);
          $to_destroy->delete();
          return back()->with('deleted','Deleted Successfully');
      }
 

    //approve a request Budget Owner
    public function approveBudgetOwnerRequisitions(Request $request, $id)
    {
        $to_approve = Requisition::find($request->approval_id);
        $to_approve->budgeto_approver_id = $request->input('hod_id');
        $to_approve->budgeto_approval_date = date("l jS \of F Y h:i:s A");
        $to_approve->budgeto_approval_status = 1;
        $to_approve->process_status = 40;
        $to_approve->update();

         //Getting user details
         $user_id = $to_approve->user_id;
         $finduser = User::find($user_id); 
         $user_name = $finduser->name;
 
         Mail::to('it.assistant@kimfay.com')->send(new CashRequisition($to_approve, $user_name));
        
        return back()->with('success','Approved Successfully');
    }

    //Close a voucher book
    public function closeVoucherBook(Request $request, $id)
    {
        $to_close = Voucherbook::find($request->close_id);
        $to_close->status = 2;
        $to_close->close_date = date("l jS \of F Y h:i:s A");
        $to_close->update();
        return back()->with('closed', 'Closed Successfully');
    }

    //approve without documents
    public function approveNoDocuments(Request $request, $id)
    {
        $to_approve = Requisition::find($request->no_document_id);
        $to_approve->documents_approver_id = $request->input('user_id');
        $to_approve->documents_approval_date = date("l jS \of F Y h:i:s A");
        $to_approve->documents_approval_status = 1;
        $to_approve->process_status = 100;
        $to_approve->no_documents_reason= $request->input('reason');
        $to_approve->update();
        
        return back();
    }

      //Update Requisition
      public function updateRequest(Request $request, $id)
      {
          $to_update = Requisition::find($request->request_id);
          $to_update->hod_id = $request->input('hod');
          $to_update->budgeto_id = $request->input('budgeto');
          $to_update->description = $request->input('description');
          $to_update->amount = $request->input('amount');
          $to_update->update();
          
          return back()->with('updated','Updated Successfully');
      }
    

    //approve a request by Budget Manager
    public function approveBudgetRequisitions(Request $request, $id)
    {
        $to_approve = Requisition::find($request->approval_id);
        $to_approve->budget_approver_id = $request->input('budget_id');
        $to_approve->expense_class = $request->input('category_id');
        $to_approve->monthly_budget = $request->input('budget');
        $to_approve->mtd_bf = $request->input('mtdbf');
        $to_approve->mtd_current = $request->input('mtdcurrent');
        $to_approve->budget_approval_date = date("l jS \of F Y h:i:s A");
        $to_approve->budget_approval_status = 1;
        $to_approve->process_status = 60;
        $to_approve->update();


         //Getting user details
         $user_id = $to_approve->user_id;
         $finduser = User::find($user_id); 
         $user_name = $finduser->name;
 
         Mail::to('it.assistant@kimfay.com')->send(new CashRequisition($to_approve, $user_name));
        
        return back()->with('success','Approved Successfully');
    }

    //approve a request by Admin
    public function approveAdminRequisitions(Request $request, $id)
    {
        $to_approve = Requisition::find($request->approval_id);
        $to_approve->admin_approver_id = $request->input('admin_id');
        $to_approve->issued_amount = $request->input('issued_amount');
        $to_approve->admin_approval_date = date("l jS \of F Y h:i:s A");
        $to_approve->admin_approval_status = 1;
        $to_approve->process_status = 80;
        $to_approve->update();

        $voucher_book_id = $to_approve->voucher_id;
        $voucher_no = $to_approve->token_id;

        $voucher_book = Voucherbook::find($voucher_book_id);
        $current_balance = $voucher_book->closing_balance;
        $current_expense = $voucher_book->expenses;
        $issued_amount = $request->input('issued_amount');
        $new_balance = ($current_balance - $issued_amount);
        $new_expense = ($current_expense + $issued_amount);
        $voucher_book->closing_balance = $new_balance;
        $voucher_book->expenses = $new_expense;
        $voucher_book->update();


        $cashbook = new Cashbook;
        $cashbook->description = $to_approve->description;
        $cashbook->voucher_no = $to_approve->token_id;
        $cashbook->voucher_book_no = $to_approve->voucher_id;
        $cashbook->amount = $issued_amount;
        $cashbook->balance = $new_balance;
        $cashbook->category_id = $to_approve->expense_class;
        $cashbook->payment_mode = $request->input('payment_mode');
        $cashbook->sending_charges = $request->input('sending_charges');
        $cashbook->withdrawal_charges = $request->input('withdrawal_charges');
        $cashbook->save();

        $get_cat = Category::find($to_approve->expense_class);
        $current_mtd = $get_cat->mtd;
        $current_balance = $get_cat->balance;
        $new_mtd = $current_mtd + $request->input('issued_amount');
        $new_balance = $current_balance - $request->input('issued_amount');
        $get_cat->mtd =  $new_mtd;
        $get_cat->balance =  $new_balance;
        $get_cat->update();

        $cat = new Category_history;
        $cat->description = 'Debit';
        $cat->cat_id = $to_approve->expense_class;
        $cat->debit = $request->input('issued_amount');
        $cat->mtd = $new_mtd;
        $cat->balance = $new_balance;
        $cat->user_id = $to_approve->user_id;
        $cat->pcv = $to_approve->token_id;
        $cat->save();
        
        return back()->with('success','Issued Successfully');
    }


    //submit documents
    public function submitDocuments(Request $request, $id)
    {
        $token_id = $request->input('token_id');
        //Handle documents upload
         //Get document names with extension.
        if($request->hasFile('document1'))
        {  
            $documentOneName = $request->file('document1')->getClientOriginalName();
            $docNameOneToStore = $token_id.'_'.$documentOneName;
        }
        else
        {
            $documentOneName = '';
            $docNameOneToStore = '';
        }
        
             //Uploading the Documents now
            if($request->hasFile('document1'))
            {
                $path1 = $request->file('document1')->storeAs('Documents', $docNameOneToStore);
            }
        if(auth::user()->level == 7)
        {
            $approval = 1;
            $process_status = 100;
        } 
        else
        {
            $approval = 0;
            $process_status = 90;
        } 
        $document = new Document;
        $document->document_name = $docNameOneToStore;
        $document->token_id = $token_id;
        $document->approval = $approval;
        $document->user_id = auth::user()->id;
        $document->save();

        $upload = Requisition::find($request->approval_id);
        $upload->documents_approver_id = $request->input('user_id');
        $upload->documents_approval_date = date("l jS \of F Y h:i:s A");
        $upload->documents_approval_status = 1;
        $upload->process_status = $process_status;
        $upload->update();
        
        return back();
    }
  
    //remove documents
    public function removeDocument(Request $request, $id)
    {
        $to_remove = Document::find($request->remove_id);
        $to_remove->delete();
        
        return back();
    }
  

    //remove comments
    public function removeComment(Request $request, $id)
    {
        $to_remove = comment::find($request->comment_id);
        $to_remove->delete();
        
        return back();
    }

    //decline a request by HOD
    public function declineRequisitions(Request $request, $id)
    {
        $to_decline = Requisition::find($request->decline_id);
        $to_decline->hod_approver_id = $request->input('hod_id');
        $to_decline->decline_id = $request->input('hod_id');
        $to_decline->decline_reason = $request->input('reason');
        $to_decline->hod_approval_date = date("l jS \of F Y h:i:s A");
        $to_decline->hod_approval_status = 2;
        $to_decline->process_status = 20;
        $to_decline->update();
        
        return back()->with('decline','Declined Successfully');
    }

    //comments by internal auditor
    public function Comment(Request $request, $id)
    {
        $to_add = new comment;
        $to_add->user_id = $request->input('ia_id');
        $to_add->comment = $request->input('comment');
        $to_add->token_id = $request->input('comment_id');
        $to_add->voucher_book_no = $request->input('book_id');
        $to_add->save();
        
        return back()->with('saved','Saved Successfully');
    }

     //decline a request by Budget Manager
     public function declineBudgetOwnerRequisitions(Request $request, $id)
     {
         $to_decline = Requisition::find($request->decline_id);
         $to_decline->budgeto_approver_id = $request->input('budgeto_id');
         $to_decline->decline_id = $request->input('budgeto_id');
         $to_decline->decline_reason = $request->input('reason');
         $to_decline->budgeto_approval_date = date("l jS \of F Y h:i:s A");
         $to_decline->budgeto_approval_status = 2;
         $to_decline->process_status = 20;
         $to_decline->update();
         
         return back()->with('decline','Declined Successfully');
     }
    
     //decline a request by Budget Officer
     public function budgetDeclineRequisitions(Request $request, $id)
     {
         $to_decline = Requisition::find($request->decline_id);
         $to_decline->budget_approver_id = $request->input('budget_id');
         $to_decline->decline_id = $request->input('budget_id');
         $to_decline->decline_reason = $request->input('reason');
         $to_decline->budget_approval_date = date("l jS \of F Y h:i:s A");
         $to_decline->budget_approval_status = 2;
         $to_decline->process_status = 40;
         $to_decline->update();
         
         return back()->with('decline','Declined Successfully');
     }

      //decline a request by CFO
      public function cfoDeclineRequisitions(Request $request, $id)
      {
          $to_decline = Requisition::find($request->decline_id);
          $to_decline->cfo_approver_id = $request->input('cfo_id');
          $to_decline->decline_id = $request->input('cfo_id');
          $to_decline->decline_reason = $request->input('reason');
          $to_decline->cfo_approval_date = date("l jS \of F Y h:i:s A");
          $to_decline->cfo_approval_status = 2;
          $to_decline->cfo_ia_status = 2;
          $to_decline->process_status = 40;
          $to_decline->update();
          
          return back();
      }

      //decline a request by CFO
      public function iaDeclineRequisitions(Request $request, $id)
      {
          $to_decline = Requisition::find($request->decline_id);
          $to_decline->ia_approver_id = $request->input('ia_id');
          $to_decline->decline_id = $request->input('ia_id');
          $to_decline->decline_reason = $request->input('reason');
          $to_decline->ia_approval_date = date("l jS \of F Y h:i:s A");
          $to_decline->ia_approval_status = 2;
          $to_decline->cfo_ia_status = 2;
          $to_decline->process_status = 40;
          $to_decline->update();
          
          return back();
      }
     
      //store Voucher Book
    public function addVoucherBook(Request $request)
    {
        $new_voucher = new Voucherbook;
        $new_voucher->token = $request->input('token');
        $new_voucher->name = $request->input('name');
        $new_voucher->user_id = auth::user()->id;
        $new_voucher->status = 0;
        $new_voucher->balance_BF = $request->input('balance_bf');
        $new_voucher->topup = $request->input('topup');
        $new_voucher->opening_balance = $request->input('opening_balance');
        $new_voucher->closing_balance = $request->input('opening_balance');
        $new_voucher->start_voucher = $request->input('start_voucher');
        $new_voucher->end_voucher = $request->input('start_voucher');
        $new_voucher->open_date = date("l jS \of F Y h:i:s A");
        $new_voucher->save();

        $to_update = Voucherbook::find($request->bridge_id);
        $to_update->status = 1;
        $to_update->update();

        return back()->with('success','Submitted successfully');

    }

    //Rollback a transaction
    public function Rollback(Request $request)
    {
        $voucher_book = Voucherbook::where('status',0)->get();
        foreach($voucher_book as $book)
        {
            $closing_balance = $book->closing_balance;
            $voucher_book_no = $book->id;
            $new_balance = $closing_balance + ($request->difference);
            $expense = $book->expenses;
        }
        if($voucher_book_no == $request->input('voucher_book_no'))
        {
            $new_expense = $expense - ($request->difference);
        }
        else
        {
            $new_expense = $expense;
        }
        $to_update = Voucherbook::find($voucher_book_no);
        $to_update->closing_balance = $new_balance;
        $to_update->expenses = $new_expense;
        $to_update->update();

        $cash_book = new Cashbook;
        $cash_book->balance = $new_balance;
        $cash_book->receipt = $request->input('difference');
        $cash_book->voucher_no = $request->input('voucher_no');
        $voucher_id = $request->input('voucher_no');
        $cash_book->voucher_book_no = $voucher_book_no;
        $cash_book->description = 'Call back transaction';
        $cash_book->save();

        $get_cat_id = Requisition::where('token_id',$voucher_id)->get();
        $cat_id = $get_cat_id[0]->expense_class;

        $get_cat = Category::find($cat_id);
        $current_mtd = $get_cat->mtd;
        $current_balance = $get_cat->balance;
        $new_mtd = $current_mtd - $request->input('difference');
        $new_balance = $current_balance + $request->input('difference');
        $get_cat->mtd =  $new_mtd;
        $get_cat->balance =  $new_balance;
        $get_cat->update();
        
        $budget = new Category_history;
        $budget->cat_id = $cat_id;
        $budget->credit = $request->input('difference');
        $budget->description = 'Call back transaction';
        $budget->mtd = $new_mtd;
        $budget->balance = $new_balance;
        $budget->user_id = $get_cat_id[0]->user_id;
        $budget->pcv = $get_cat_id[0]->token_id;
        $budget->save();

        return back()->with('rolled','Submitted successfully');

    }

     //store category
     public function submitCategory(Request $request)
     {
         $new_category = new Category;
         $new_category->name = $request->input('name');
         $new_category->budget = $request->input('budget');
         $new_category->mtd = $request->input('mtd');
         $new_category->owner_id = $request->input('b_owner');
         $new_category->save();
 
         return back()->with('success','Submitted successfully');
 
     }

     //update category
     public function updateCategory(Request $request, $id)
     {
         $new_category = Category::find($request->category_id);
         $new_category->name = $request->input('name');
         $new_category->budget = $request->input('budget');
         $new_category->mtd = $request->input('mtd');
         $new_category->owner_id = $request->input('b_owner');
         $new_category->update();
 
         return back()->with('success','Updated successfully');
 
     }
 


     //store staff requisitions
    public function storeCashRequest(Request $request)
    {
        $new_requisition = new Requisition;
        $new_requisition->user_id = $request->input('userid');
        $new_requisition->amount = $request->input('amount');
        $new_requisition->description = $request->input('description');
        $new_requisition->voucher_id = $request->input('voucher_id');
        $new_requisition->hod_id = $request->input('hod');
        $new_requisition->budgeto_id = $request->input('budgeto');
        $new_requisition->process_status = $request->input('process_status');
        $new_requisition->department_id = $request->input('department');
        $new_requisition->token_id = $request->input('token_id');
        $new_requisition->save();

        //updating voucher number
        $new_current = Voucherbook::find($request->voucher_id);
        $new_current->end_voucher = $request->input('token_id');
        $new_current->update();

        //Getting email addresses of the hod and budget owner.
        $hod_e = User::find($request->hod);
        $hod_email = $hod_e->email;
        $user = $hod_e->name;

        $budgeto_e = User::find($request->budgeto);
        $budgeto_email = $budgeto_e->email;
        $email_type = 0;
        $to_approve = $request;
        $user_name = auth::user()->name;

        Mail::to('it.assistant@kimfay.com')->send(new ApprovalMail($request, $user));
        Mail::to('it.assistant@kimfay.com')->send(new UserRequisition($request,$email_type,$to_approve,$user_name));

        return back()->with('success','Request successfull');

    }

    //show password change form.
    public function getPasswordForm()
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
        return view('Staff.change_password_form');
    }

    public function changePassword(Request $request)
    { 
        if(!(Hash::check($request->get('current_password'), Auth::user()->password)))
        { 
            $message = 'wrong current password';
            return back()->with('error', $message);
        }

        if(strcmp($request->get('password'), $request->get('current_password'))==0 )
        { 
            $message = 'New password can not be same as Old Password';
            return back()->with('match', $message);
        }

       if(strcmp($request->get('password'), $request->get('password_confirmation'))==0 )
        { 
            $user = Auth::user();
            $password = $request->get('password');
            $user->password = Hash::make($password);
            $user->update();
             
            $message = 'Password Changed Successfully';
            return back()->with('success', $message);
            
        }
        else
        {
            $message = 'Confirmation password does not match with New Password';
            return back()->with('mismatch', $message);
        }
    }

     //Update user details
     public function updateUser(Request $request, $id)
     {
         $user = User::find($request->user_id);
         $user->name = $request->input('name');
         $user->email = $request->input('email');
         $user->phone = $request->input('phone');
         $user->title = $request->input('title');
         $user->update();
         
         return back()->with('updated','Updated Successfully');
     }
   
     public function burferFloat()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Requested Successfully');
        }
        elseif(session('issued'))
        {
            Alert::success('Success!', 'Issued Successfully');
        }
        elseif(session('bridged'))
        {
            Alert::success('Success!', 'Bridged Successfully');
        }
        elseif(session('accepted'))
        {
            Alert::success('Success!', 'Confirmed Successfully');
        }
        $burfers = Burferfloat::all();  

        return view('Staff.burfer_float')->with('buffers',$burfers);
    }

    public function addBuffer(Request $request)
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
        
            $add = new Burferfloat;
            $add->voucher_book_token = $request->current_voucher_book_no;
            $add->burfer_amount = $request->buffer_amount;
            $add->current_float = $request->current_float;
            $add->new_float =$request->current_float;
            $add->token_id = $request->token_id;
            $add->user_id = auth::user()->id;
            $add->save(); 

            $amount = $request->buffer_amount;
            $user_name = auth::user()->name;

            Mail::to('it.assistant@kimfay.com')->send(new BufferFloat($amount, $user_name));

            return back()->with('success','Success');
        
        
    }

    //issue buffer float
    public function issueBuffer(Request $request, $id)
    {
        $data = Burferfloat::find($request->request_id);
        $new_float = ($request->current_float) + ($request->buffer_amount);
        $data->new_float = $new_float;
        $data->issue_date =date("l jS \of F Y h:i:s A");
        $data->issue_id = auth::user()->id;
        $data->status =1;
        $data->update();

        $to_update  = Voucherbook::where('token',$request->current_voucher_book_no)->first();
        $to_update->closing_balance = $new_float;
        $to_update->update();

        $cash_book = new Cashbook;
        $cash_book->balance = $new_float;
        $cash_book->receipt = $request->buffer_amount;
        $cash_book->voucher_no = $data->token_id;
        $cash_book->voucher_book_no = $to_update->id;
        $cash_book->description = 'Buffer Amount';
        $cash_book->save();


        return back()->with('issued','Success');
    }

    //refund buffer float
    public function refundBuffer(Request $request, $id)
    {
        $data = Burferfloat::find($request->request_id);
        $data->refund_date =date("l jS \of F Y h:i:s A");
        $data->refund_id = auth::user()->id;
        $data->refund_status =1;
        $data->update();

        return back()->with('bridged','Success');
    }

     //accept buffer float refund
     public function acceptBuffer(Request $request, $id)
     {
         $data = Burferfloat::find($request->request_id);
         $data->refund_status =2;
         $data->update();
 
         $to_update  = Voucherbook::find($request->voucher_book_id);
         $new_float = $to_update->closing_balance - $request->refund_amount;
         $to_update->closing_balance = $new_float;
         $to_update->update();
 
         $cash_book = new Cashbook;
         $cash_book->balance = $new_float;
         $cash_book->amount = $request->refund_amount;
         $cash_book->voucher_no = $request->buffer_token;
         $cash_book->voucher_book_no = $to_update->id;
         $cash_book->description = 'Buffer Refund Amount';
         $cash_book->save();
 
 
         return back()->with('accepted','Success');
     }

     
}
