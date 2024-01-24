<?php
use App\Mail\ApprovalMail;
use App\Mail\HODmail;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/poll', function () {
//     return view('poll_landing');
// });
Route::get('/poll/signin', function () {
    return view('poll');
});
Route::get('/notification', function () {
    Mail::to('it.assistant@kimfay.com')->send(new HODmail());
    return new ApprovalMail();
});

Auth::routes();

//Admin routes
Route::get('/poll', 'Admin\AdminController@pollLanding')->name('polllanding');
Route::post('/poll-signin', 'Admin\AdminController@pollAuth')->name('pollauth');
Route::get('/admin/dashboard', 'HomeController@index')->name('admin_dashboard');
Route::get('/users', 'Admin\AdminController@fetchUsers')->name('users');
Route::get('/add/user', 'Admin\AdminController@addUser')->name('add_user');
Route::post('/submit_user', 'Admin\AdminController@submitUser')->name('submit_user');
Route::get('/user/{id}', 'Admin\AdminController@showUser')->name('edit_user');
Route::put('/update_user/{id}', 'Admin\AdminController@editUser')->name('update_user');
Route::put('/reset_password/{id}', 'Admin\AdminController@resetPassword')->name('reset_password');
Route::delete('/remove/{id}',  'Admin\AdminController@destroyUser')->name('delete_user');
Route::post('/profile/{id}', 'Admin\AdminController@changeProfile')->name('change_profile');
Route::get('/departments', 'Admin\AdminController@fetchDepartments')->name('departments');
Route::post('/submit_department', 'Admin\AdminController@submitDepartment')->name('submit_department');
Route::put('/update_department/{id}', 'Admin\AdminController@editDepartment')->name('update_department');
Route::delete('/dep/{id}',  'Admin\AdminController@destroyDepartment')->name('delete_department');
Route::get('/access_levels', 'Admin\AdminController@fetchAccessLevels')->name('access_levels');
Route::post('/submit_level', 'Admin\AdminController@submitAccessLevel')->name('submit_level');
Route::put('/update_level/{id}', 'Admin\AdminController@editAccessLevel')->name('update_level');
Route::delete('/level/{id}',  'Admin\AdminController@destroyAccessLevel')->name('delete_level');
Route::put('/reasign_level/{id}', 'Admin\AdminController@reasignAccessLevel')->name('reasign_level');
Route::get('/welcome/user', 'Admin\AdminController@welcomeUser')->name('welcome_user');
Route::get('/divisions', 'Admin\AdminController@fetchDivisions')->name('divisions');
Route::post('/submit_division', 'Admin\AdminController@submitDivision')->name('submit_division');
Route::put('/update_division/{id}', 'Admin\AdminController@editDivision')->name('update_division');
Route::delete('/div/{id}',  'Admin\AdminController@destroyDivision')->name('delete_division');
Route::post('/initiate-transaction',  'Admin\AdminController@stkPush')->name('stk-initial');
Route::get('/pay',  'Admin\AdminController@getPaymentForm')->name('pay');
Route::get('/poll/nominee',  'Admin\AdminController@confirmNominee')->name('nominee');
Route::get('/confirmpayment', 'DCE\DCEController@confirmPayment')->name('confirmpayment');

//Poll Routes
Route::get('/poll/nominee',  'Admin\AdminController@confirmNominee')->name('nominee');
Route::get('/voters/{id}',  'Admin\AdminController@fetchVoters')->name('voters');
Route::post('/submit/poll', 'Admin\AdminController@submitPoll')->name('submit_poll');
Route::post('/submit/voter', 'Admin\AdminController@submitVoter')->name('submit_voter');
Route::post('/update/voter', 'Admin\AdminController@updateVoter')->name('edit_voter');
Route::post('/update/criteria', 'Admin\AdminController@editCriteria')->name('edit_criteria');
Route::get('/admin/poll/{id}',  'Admin\AdminController@adminView')->name('admin_view');
Route::get('/admin/awards/{id}',  'Admin\AdminController@adminAwards')->name('admin_awards');
Route::get('/admin/permissions/{id}',  'Admin\AdminController@rolesPermissions')->name('permissions');
Route::get('/admin/criteria/{id}',  'Admin\AdminController@criteria')->name('criterias');
Route::post('/submit/nominee', 'Admin\AdminController@storeNominee')->name('submit_nominee');
Route::post('/update/nominee', 'Admin\AdminController@updateNominee')->name('update_nominee');
Route::post('/submit/permission', 'Admin\AdminController@storePermission')->name('submit_permission');
Route::post('/submit/criteria', 'Admin\AdminController@storeCriteria')->name('submit_criteria');
Route::post('/submit/vote', 'Admin\AdminController@storeVote')->name('submit_vote');
Route::get('/poll/values/{id}',  'Admin\AdminController@coreValuesAuth')->name('poll_values');
Route::post('/delete/nominee', 'Admin\AdminController@deleteRecord')->name('delete_record');
Route::post('/delete/criteria', 'Admin\AdminController@deleteCriteria')->name('delete_criteria');
Route::post('/edit/image', 'Admin\AdminController@editImage')->name('edit_image');
Route::post('/update/award', 'Admin\AdminController@updateAward')->name('update_award');
Route::post('/add/award', 'Admin\AdminController@addAward')->name('add_award');
Route::post('/delete/award', 'Admin\AdminController@deleteAward')->name('delete_award');
Route::post('/image/post', 'Admin\AdminController@saveImage')->name('add_image');
Route::post('/search/award', 'Admin\AdminController@searchAward')->name('search_award');
Route::get('/images/{id}',  'Admin\AdminController@getImages')->name('get_image');
Route::get('/results/{id}',  'Admin\AdminController@getResults')->name('get_image');
Route::get('/images/delete/{id}',  'Admin\AdminController@deleteImage')->name('delete_image');

//Staff Routes
Route::get('/admin/dashboard', 'HomeController@adminDashboard')->name('admin');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('staff_dashboard');
Route::get('/requests', 'Staff\RequisitionController@fetchUserRequisitions')->name('user_requisitions');
Route::get('hod/requests', 'Staff\RequisitionController@fetchHODRequisitions')->name('hod_requisitions');
Route::get('budget_owner/requests', 'Staff\RequisitionController@fetchBudgetOwnerRequisitions')->name('budget_owner_requisitions');
Route::get('budget_manager/approvals', 'Staff\RequisitionController@fetchBudgetManagerRequisitions')->name('budget_requisitions');
Route::get('cfo/approvals', 'Staff\RequisitionController@fetchcfoRequisitions')->name('cfo_requisitions');
Route::get('ia/approvals', 'Staff\RequisitionController@fetchiaRequisitions')->name('ia_requisitions');
Route::get('/admin', 'Staff\RequisitionController@fetchAdminRequisitions')->name('admin_requisitions');
Route::get('/view_request/{id}', 'Staff\RequisitionController@showRequisitions')->name('show_requisitions');
Route::get('/budget_request/{id}', 'Staff\RequisitionController@showBudgetRequisitions')->name('show_budget_requisitions');
Route::get('/cfo_request/{id}', 'Staff\RequisitionController@showcfoRequisitions')->name('show_cfo_requisitions');
Route::get('/ia_request/{id}', 'Staff\RequisitionController@showiaRequisitions')->name('show_ia_requisitions');
Route::get('/expand/{id}', 'Staff\RequisitionController@expandiaRequisitions')->name('expand_ia_requisitions');
Route::get('/budget_owner_request/{id}', 'Staff\RequisitionController@showBudgetOwnerRequisitions')->name('show_budget_owner_requisitions');
Route::get('/documents/{id}', 'Staff\RequisitionController@showDocumentRequisitions')->name('show_documents');
Route::get('/admin_request/{id}', 'Staff\RequisitionController@showAdminRequisitions')->name('show_admin_requisitions');
Route::post('/add_request', 'Staff\RequisitionController@storeCashRequest')->name('store_request');
Route::put('/approve-request/{id}', 'Staff\RequisitionController@approveRequisitions')->name('approve_request');
Route::put('/budget/{id}', 'Staff\RequisitionController@approveBudgetRequisitions')->name('budget_approve_request');
Route::put('/cfo/{id}', 'Staff\RequisitionController@approvecfoRequisitions')->name('cfo_approve_request');
Route::put('/ia/{id}', 'Staff\RequisitionController@approveiaRequisitions')->name('ia_approve_request');
Route::put('/budget_owner/{id}', 'Staff\RequisitionController@approveBudgetOwnerRequisitions')->name('budget_owner_approve_request');
Route::put('/admin/{id}', 'Staff\RequisitionController@approveAdminRequisitions')->name('admin_approve_request');
Route::post('/documents/{id}', 'Staff\RequisitionController@submitDocuments')->name('submit_documents');
Route::put('/decline-request/{id}', 'Staff\RequisitionController@declineRequisitions')->name('decline_request');
Route::put('/budgeto_decline-request/{id}', 'Staff\RequisitionController@declineBudgetOwnerRequisitions')->name('budgeto_decline_request');
Route::delete('/remove_document/{id}', 'Staff\RequisitionController@removeDocument')->name('remove_document');
Route::get('/staff_edit/{id}', 'Staff\RequisitionController@showRequestToEdit')->name('edit_request');
Route::put('/update/{id}', 'Staff\RequisitionController@updateRequest')->name('update_request');
Route::put('/no-documents/{id}', 'Staff\RequisitionController@approveNoDocuments')->name('no_documents');
Route::put('/budget-decline/{id}', 'Staff\RequisitionController@budgetDeclineRequisitions')->name('budget_decline_request');
Route::put('/cfo-decline/{id}', 'Staff\RequisitionController@cfoDeclineRequisitions')->name('cfo_decline_request');
Route::put('/ia-decline/{id}', 'Staff\RequisitionController@iaDeclineRequisitions')->name('ia_decline_request');
Route::get('/voucherbooks', 'Staff\RequisitionController@fetchVoucherBooks')->name('voucher_requisitions');
Route::put('/close-voucher/{id}', 'Staff\RequisitionController@closeVoucherBook')->name('close_voucher');
Route::post('/add_voucher', 'Staff\RequisitionController@addVoucherBook')->name('add_voucher');
Route::post('/vouchers_check', 'Staff\RequisitionController@checkVoucher')->name('vouchers_check');
Route::get('/categories', 'Staff\RequisitionController@fetchCategories')->name('categories');
Route::post('/submit_category', 'Staff\RequisitionController@submitCategory')->name('submit_category');
Route::put('/category/{id}', 'Staff\RequisitionController@updateCategory')->name('update_category');
Route::delete('/delete/{id}', 'Staff\RequisitionController@destroyCategory')->name('delete_category');
Route::put('/valid', 'Staff\RequisitionController@validateDocument')->name('valid');
Route::put('/invalid', 'Staff\RequisitionController@validateDocument')->name('invalid');
Route::delete('/destroy/{id}', 'Staff\RequisitionController@destroyRequisition')->name('delete_requisition');
Route::get('/password', 'Staff\RequisitionController@getPasswordForm')->name('password_form');
Route::post('/change-password', 'Staff\RequisitionController@changePassword')->name('change_password');
Route::post('/user/{id}', 'Staff\RequisitionController@updateUser')->name('update_user');
Route::put('/comment/{id}', 'Staff\RequisitionController@Comment')->name('comment');
Route::delete('/remove_comment/{id}', 'Staff\RequisitionController@removeComment')->name('remove_comment');
Route::put('/rollback', 'Staff\RequisitionController@Rollback')->name('rollback');
Route::get('/view_category/{id}', 'Staff\RequisitionController@viewCategory')->name('view_category');
Route::post('/search_category', 'Staff\RequisitionController@searchCategory')->name('search_category');
Route::get('/burfer-float', 'Staff\RequisitionController@burferFloat')->name('burfer_float');
Route::post('/add-buffer', 'Staff\RequisitionController@addbuffer')->name('add_buffer');
Route::put('/buffer/{id}', 'Staff\RequisitionController@issueBuffer')->name('issue_buffer');
Route::put('/refund/{id}', 'Staff\RequisitionController@refundBuffer')->name('refund_buffer');
Route::put('/accept/{id}', 'Staff\RequisitionController@acceptBuffer')->name('accept_buffer');



//Routes to autopopulate dependent fieldsfinddivision
Route::get('/findmtd', 'Staff\RequisitionController@findMTD')->name('findmtd');
Route::get('/finddivisions', 'Admin\AdminController@findDivision')->name('finddivisions');
Route::get('/findhod', 'Admin\AdminController@findHOD')->name('findhod');
Route::get('/findcasual', 'DCE\DCEController@findCasual')->name('findcasual');

//Route to download uploaded receipts
Route::get('/download/{id}', function ($id)
{
   $file = public_path()."/Documents".$id;
   $headers = array(
       'Content-Type: application/pdf',
   );
   return Response::download($file, $id, $headers);
});

//Route to view uploaded receipts
Route::get('/view/{id}', function ($id)
{
   $file = public_path()."/Documents".$id;
   $headers = array(
       'Content-Type: application/pdf',
   );
   return view('Staff.document_view_requisition')->with('file', $file);
});

//Routes to send email notifications
//Route::get('/notification', 'Staff\RequisitionController@sendNotification')->name('notification');

//Fleet routes
Route::get('/fleet/dashboard', 'Fleet\FleetController@index')->name('fleet');
Route::get('/vehicles', 'Fleet\FleetController@fetchVehicles')->name('vehicles');
Route::get('/drivers', 'Fleet\FleetController@fetchDrivers')->name('drivers');
Route::post('/post/vehicle', 'Fleet\FleetController@postVehicle')->name('post-vehicle');
Route::put('/edit/vehicle/{id}', 'Fleet\FleetController@editVehicle')->name('edit-vehicle');
Route::delete('/vehicle/{id}', 'Fleet\FleetController@destroyVehicle')->name('delete_vehicle');
Route::post('/post/driver', 'Fleet\FleetController@postDriver')->name('post-driver');
Route::put('/edit/driver/{id}', 'Fleet\FleetController@editDriver')->name('edit-driver');
Route::delete('/driver/{id}', 'Fleet\FleetController@destroyDriver')->name('delete_driver');
Route::get('/driver-requisitions', 'Fleet\FleetController@driverRequisition')->name('driver_requisitions');
Route::post('/place_request', 'Fleet\FleetController@postRequest')->name('place_request');
Route::get('/view_fuel/{id}', 'Fleet\FleetController@viewFuelRequest')->name('view_fuel');

//DCE Routes
Route::get('/dce/applications', 'DCE\DCEController@userApplications')->name('user_applications');
Route::get('/application', 'DCE\DCEController@applicationForm')->name('application_form');
Route::post('/add_dce_request', 'DCE\DCEController@storeDCERequest')->name('store_dce_request');
Route::get('/edit_dce_application/{id}', 'DCE\DCEController@editForm')->name('edit_dce_application');
Route::put('/update_dce_request/{id}', 'DCE\DCEController@editDCERequest')->name('update_dce_request');
Route::get('/hod/applications', 'DCE\DCEController@hodApplications')->name('hod_applications');
Route::get('/hod_view_application/{id}', 'DCE\DCEController@hodViewApplication')->name('hod_view_application');
Route::put('/approve-dce-request/{id}', 'DCE\DCEController@approveDCERequisitionsHOD')->name('hod_approve_dce_request');
Route::put('/decline-DCE-request/{id}', 'DCE\DCEController@declineDCERequisitions')->name('decline_dce_request');
Route::get('/wages/applications', 'DCE\DCEController@wagesApplications')->name('wages_applications');
Route::get('/wages_view_application/{id}', 'DCE\DCEController@wagesViewApplication')->name('wages_view_application');
Route::get('/budget/applications', 'DCE\DCEController@budgetApplications')->name('budget_applications');
Route::get('/budget_view_application/{id}', 'DCE\DCEController@budgetViewApplication')->name('budget_view_application');
Route::put('/budget-dce-request/{id}', 'DCE\DCEController@budgetDCERequisitions')->name('budget_approve_dce_request');
Route::put('/decline-budget-request/{id}', 'DCE\DCEController@declineDCERequisitionsBudget')->name('decline_budget_request');
Route::get('/casuals', 'DCE\DCEController@fetchCasuals')->name('casuals');
Route::get('/add/casual', 'DCE\DCEController@addCasualForm')->name('add_casual_form');
Route::post('/submit_casual', 'DCE\DCEController@submitCasual')->name('submit_casual');
Route::get('/casual/{id}', 'DCE\DCEController@showCasual')->name('show_casual');
Route::put('/update_casual/{id}', 'DCE\DCEController@editCasual')->name('update_casual');
Route::put('/wages-dce-request/{id}', 'DCE\DCEController@wagesDCERequisitions')->name('wages_approve_dce_request');
Route::post('/submit_prefered_casual', 'DCE\DCEController@submitPreferedCasual')->name('submit_prefered_casual');
Route::delete('/remove_casual/{id}', 'DCE\DCEController@destroyChoosenCasual')->name('remove_casual');
Route::get('/hr_manager_view_application/{id}', 'DCE\DCEController@hrManagerViewApplication')->name('hr_manager_view_application');
Route::get('/hr_manager/applications', 'DCE\DCEController@hrManagerApplications')->name('hr_manager_applications');
Route::put('/hr_manager-dce-request/{id}', 'DCE\DCEController@hrManagerDCERequisitions')->name('hr_manager_approve_dce_request');
Route::put('/decline-hr_manager-request/{id}', 'DCE\DCEController@declineDCERequisitionshrManager')->name('decline_hr_manager_request');
Route::get('/approvals/{id}', 'DCE\DCEController@approvals')->name('approvals');
Route::get('/contract/{id}', 'DCE\DCEController@contract')->name('contract');
Route::get('/reports', 'DCE\DCEController@reports')->name('reports');
Route::post('/get_daily_report', 'DCE\DCEController@dailyReports')->name('daily_report');