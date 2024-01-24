@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Print Engagement Contract</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Casuals</li>
                  <li class="breadcrumb-item active">H.R Rep</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <!-- Start of tabs content -->
        
        <section class="content">
            <div class="container-fluid winbox-white">
        <!-- End of tabs content -->

        <!-- Start of request history -->
                <div class="tab-content" style="margin-top:16px;">
                 <div class="tab-pane active" id="login_details">
                  <div class="panel panel-default">
                   <div class="panel-heading"><button onclick="printContract('contract')" class="btn btn-info btn-sm" ><i class="fa fa-print"></i>&nbsp;&nbsp;Print</button>
                   </div>
                   <div class="panel-body" id="contract" >
                            <div class="panel panel-default">
                            <div class="panel-body">
                              <img src="{{ asset('dist/img/logo.png')}}" alt="Kimfay Letter Head" width="100%">
                              <hr/>
                              <div class="row">
                                    <div class="col-md-12" align="center">
                                            <p><strong><u><h6>CASUAL EMPLOYMENT CONTRACT</h6></u></strong></p>
                                            <p><strong><h6>HR Record - Version 1</h6></strong></p>
                                    </div>
                              </div>
                                        <div class="row">
                                                <div class="col-md-3" align="left">
                                                        <p><strong>PARTIES</strong></p>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                <strong>THIS AGREEMENT</strong> is made on <strong>{{date("l jS \of F Y")}} BETWEEN; Kim-Fay (E.A) Ltd </strong>(hereinafter called the <i>Company</i>) <strong>AND (See listed
                                                Employees on Page 2)</strong>(hereinafter called the The <i>Employee</i>)<br/><br/>
                                                <strong>WHEREAS</strong> the company has offered the employee a contract of employment on a daily casual basis the employee confirms his/her
                                                acceptance of the offer of the employment contract under the following terms and conditions: -
                                                </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                                <div class="col-md-3" align="left">
                                                        <p><strong>NATURE OF EMPLOYMENT</strong></p>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-3" align="left">
                                                The employee shall: -           
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1" align="left">
                                                        
                                            </div>
                                            <div class="col-md-11" align="left">
                                            (i) The employee has full power to enter into and perform in terms of this Agreement, has taken and shall take all necessary statutory and other actions to allow the fulfillment of his/her obligations under this Agreement;<br/><br/>
                                            (ii) That the employee has obtained a Good Conduct Certificate as evidence of his non involvement of criminal activities
                                            whether in the past or currently;<br/><br/>
                                            (iii) That the employee has provided all the educational certificates as requested by the Company;<br/><br/>
                                            (iv) That the employee is of good health and able to take up his training and assignment.<br/><br/>
                                            (v) That the employee fully understands the nature of his assignment and risks involved and the company has explained
                                            this to him and undertakes his employment knowingly, willingly and voluntarily.
                                            </div>
                                        </div>  
                                         <br/>
                                        <div class="row">
                                            <div class="col-md-3" align="left">
                                                    <p><strong>PERIOD OF EMPLOYMENT</strong></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                    <p>The employee shall be engaged for a period of <strong>{{$dce_requisition->no_of_days}} day(s)</strong> as from <strong>{{$dce_requisition->start_date}}</strong> to <strong>{{$dce_requisition->end_date}}</strong> .<br/><br/>
                                                        Terminating thereof without notice always <strong>BUT SUBJECT</strong> always to the provisions as to earlier termination as set out in the Agreement.
                                                        The Company shall not be obliged to employ the employee after the lapse of the period contracted as per this agreement.
                                                        Should the employee be offered a further period of employment by the company at the expiry of this signed contract,then it shall be on
                                                        the condition that such other period of employment shall be subject to the terms and conditions of a fresh and separate Agreement and
                                                        shall not in anyway be regarded as relating to or as an extension of this old contract.
                                                        The decision whether or not to sign a new agreement as mentioned above shall be entirely upon the discretion of the management.
                                                    </p>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3" align="left">
                                                    <p><strong>NATURE OF DUTIES</strong></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-3" align="left">
                                                The employee shall: -           
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1" align="left">
                                                        
                                            </div>
                                            <div class="col-md-11" align="left">
                                            (i) Undertake to perform duties and exercise powers as the company assigns to the employee.<br/><br/>
                                            (ii) Undertake his/her duties in any location or branch of the company within Kenya, depending on work availability,
                                            as may be required of him/her from time to time.<br/><br/>
                                            (iii) Work for a period of twelve hours daily depending on shift allocations and as required by the company either;<br/>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(a) Reporting at 8:30 a.m. and handing over at 5:00p.m. Or<br/>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b) Reporting at ___________ p.m. and handing over at _____________ a.m.<br/>
                                            The company over may alter the hours of reporting and handing over, without notice to the employee.<br/>
                                            (iv) Be entitled to one day of rest after every period of six consecutive days of duty.
                                            </div>
                                        </div>  
                                        <br/><br/><br/>
                                        @php
                                            $net_pay = 0;
                                            $cnt = 1;
                                        @endphp
                                        @foreach($selected as $casual)
                                            @php
                                                $net_pay += $casual->net_pay;
                                                
                                            @endphp
                                        @endforeach
                                        <div class="row">
                                            <div class="col-md-3" align="left">
                                                    <p><strong>REMUNERATION</strong></p>
                                            </div>
                                        </div>
                                         @php
                                            $net_pay = 0;
                                            $cnt = 1;
                                            $total = ($dce_requisition->rate_per_casual * $dce_requisition->no_of_days);
                                            $deductions = ($dce_requisition->nssf + $dce_requisition->nhif + $dce_requisition->tax);
                                            $net = ($total - $deductions);
                                          @endphp
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                    <p>The company shall pay to the employee a sum of<strong> Kenya Shillings {{number_format($net,2)}}</strong></br></br>
                                                        This payment will be paid at the end of the period of the contract, being the accumulated daily wages due and payable to the employee.</br></br>
                                                        A further deduction of <strong> Kenya Shillings {{number_format($dce_requisition->nhif,2)}}</strong> and <strong> Kenya Shillings {{number_format($dce_requisition->nssf,2)}}</strong> shall be made from your aggregate accumulated wages at the end of this contract and
                                                        shall be remitted to <strong>NHIF</strong> and <strong>NSSF</strong> respectively as is our statutory obligation. Therefore, total deductions shall amount to <strong> Kenya Shillings {{number_format($deductions,2)}}</strong></br></br>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>NOTE: </strong>The sum payable shall be in regard to aggregate days worked only.</br></br>
                                                        Payment of the employees wages as hereinabove shall be deemed as settlement of all his/her claims from the company for the
                                                        period payable to her/him then and/or in the future.
                                                    </p>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" align="left">
                                                    <p><strong>UNIFORMS AND PROTECTIVE GEAR:</strong></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                    <p>The Company shall provide the employee with the uniform and equipment required by the employee for the performance of his duties.</br></br>
                                                        The employee shall be deducted Kshs 500/- from his/her wages for any damage to or loss of the equipment or uniform as a result by the
                                                        neglect of the employee.
                                                    </p>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" align="left">
                                                    <p><strong>CODE OF CONDUCT</strong></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                    <p>The employee shall observe and comply with all regulations and conditions of the company and other standing orders and procedures
                                                        given in the course of employment for the purpose of the efficient and competent carrying out of duties.</br></br>
                                                        Non-compliance with the instructions and regulations may lead to the immediate termination of this contract.</br></br>
                                                        The employee shall devote the whole of his time and attention during duties to the performance of his duties and shall not engage in
                                                        any business or occupation directly or indirectly which may in the opinion of the management hinder or otherwise prevent the satisfactory performance of his/her duties under this agreement.</br></br>
                                                        The Work Injury Benefits Act, 2007 and/or any other relevant statute shall apply strictly in relation to injuries sustained by the
                                                        employee in the course of duty.</br></br>
                                                        The company shall be entitled to claim from the employee compensation incase of losses and/or damages suffered by the company
                                                        owing to the employee negligence either wholly or partly, in the discharge of his duties or otherwise.</br></br>
                                                        The employee shall while in the employment of the company and thereafter treat with utmost confidentiality all the company matter
                                                        not authorized to be disclosed to the public or any other persons.
                                                    </p>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3" align="left">
                                                    <p><strong>TERMINATION</strong></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                The contract shall terminate at the expiry of the period hereinabove specified. However and in addition;         
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1" align="left">
                                                        
                                            </div>
                                            <div class="col-md-11" align="left">
                                            (i) The employee is entitled to terminate the contract by giving to the Company one days written notice or one
                                            days wages in lieu of notice.</br></br>
                                            (ii) The company has authority to summarily terminate the contract without any notice or compensation whatsoever to
                                            the employee in the event of gross negligence, absenteeism, drunkenness, part or suspicion of a criminal offence
                                            of any kind on the part of the employee. of a criminal offence of any kind on the part of the employee.</br></br>
                                            (iii) The employees contract with the company is tied to the companys contracts with third parties; the employees
                                            contract may therefore be terminated automatically without notice upon the termination of the companys contract
                                            with third parties.
                                            </div>
                                        </div>  </br>
                                        <div class="row">
                                            <div class="col-md-6" align="left">
                                                    <p><strong>TERMINATION ON INCAPACITY</strong></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                    <p>If during any period of this agreement you are unable to carry out your duties satisfactorily owing to ill health or other cause the
                                                        company may at its sole discretion determine this contract by giving you one day written notice or payment in lieu of such notice. 
                                                    </p>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" align="left">
                                                    <p><strong>RESTRICTIONS AFTER TERMINATION</strong></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                    <p>After termination of this contract you shall not seek to entice away from the company any of its customers, or use for your own
                                                        benefit to the detriment of the company any information concerning the company business affairs, customers secrets
                                                        which you may have acquired in the course of your employment under this contract.
                                                    </p>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" align="left">
                                                    <p><strong>Signed</strong></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                    <p>For : <strong>Kim-Fay East Africa Limited</strong> </p>
                                                    <p>Signed : <strong>{{auth::user()->name}}</strong> </p>
                                                    <p>Name : <strong>Alice Mworia</strong> </p>
                                                    <p>Designation : <strong>HR and Administration Manager</strong> </p>
                                                </div>
                                        </div>
                              
                              <br/>
                              <div class="row">
                                    <div class="col-md-6" align="left">
                                            <p><h6><u><strong>CASUALS DETAILS</strong></u></h6></p>
                                    </div>
                              </div>
                              <table class="customers-actions">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #000;">No.</th>
                                        <th style="border: 1px solid #000;">Casual Name</th>
                                        <th style="border: 1px solid #000;">I.D No.</th>
                                        <th style="border: 1px solid #000;">NHIF No.</th>
                                        <th style="border: 1px solid #000;">NSSF No.</th>
                                        <th style="border: 1px solid #000;">KRA Pin</th>
                                        <th style="border: 1px solid #000;">Casual Staff Sign</th>
                                        <th style="border: 1px solid #000;">Paying officer Name/Sign</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($selected as $casual)
                                    <tr>
                                        <td style="border: 1px solid #000;">{{$cnt}}</td>
                                        <td style="border: 1px solid #000;">{{$casual->user->casual_name}}</td>
                                        <td style="border: 1px solid #000;">{{$casual->user->casual_id_no}}</td>
                                        <td style="border: 1px solid #000;">{{$casual->user->nhif_no}}</td>
                                        <td style="border: 1px solid #000;">{{$casual->user->nssf_no}}</td>
                                        <td style="border: 1px solid #000;">{{$casual->user->kra_pin}}</td>
                                        <td style="border: 1px solid #000;"></td>
                                        <td style="border: 1px solid #000;"></td>
                                        
                                    </tr>
                                @php
                                    $cnt++
                                @endphp
                                @endforeach
                                </tbody>
                                </table>
                                
                            </div>
                            </div>
                   </div>
                  </div>
                 </div>
        <!-- end of request history-->
    
          </div><!-- /.container-fluid -->
        </section>
@endsection