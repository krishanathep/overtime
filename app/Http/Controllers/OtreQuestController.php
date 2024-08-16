<?php

namespace App\Http\Controllers;

use App\Http\Resources\OTrequestResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Otrequest;
use App\Models\TruOtTimeModel;
use App\Mail\MyDemoMail;
use Illuminate\Support\Facades\Mail;

class OtreQuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        try {
            $employees = Employee::all();

            $filename = 'exported_ot_data.txt';

            $content = '';

            foreach ($employees as $employee) {
                $content .= $employee->code . ',' . 
                $employee->created_at->format('d') . ',' . 
                $employee->created_at->format('m') . ',' . 
                $employee->created_at->format('Y') . ',' . 
                $employee->created_at->format('H') . ',' . 
                $employee->created_at->format('m') . ',' . 
                $employee->created_at->format('s') . ',' . 
                $employee->created_at->format('H') . ',' . 
                $employee->created_at->format('m') . ',' . 
                $employee->created_at->format('s') . ',' . 
                $employee->created_at->format('s') . "\n";
            }

            return response($content)
                ->header('Content-Type', 'text/plain')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }

    // public function export_File() 
    // {
    //     return Excel::download(new EmployeeExport, 'employees.xlsx');
    // }

    // get ot request by department login
    public function dept_filter(Request $request)
    {
        $data = $request->get('data');

        $otrequests = Otrequest::where('dept', '=', $data)->orderBy('id', 'DESC')->get();
        return response()->json([
            'status' => 200,
            'otrequests' => $otrequests,
        ]);
    }

    public function inprogress(Request $request)
    {
        $data = $request->get('data');
        $otrequests = Otrequest::where('dept', '=', $data)->where('status', 'รออนุมัติ')->get();
        return response()->json([
            'status' => 200,
            'otrequests' => $otrequests,
        ]);
    }

    public function approved(Request $request)
    {
        $data = $request->get('data');
        $otrequests = Otrequest::where('dept', '=', $data)->where('status', 'อนุมัติ')->get();
        return response()->json([
            'status' => 200,
            'otrequests' => $otrequests,
        ]);
    }

    public function rejected(Request $request)
    {
        $data = $request->get('data');
        $otrequests = Otrequest::where('dept', '=', $data)->where('status', 'ไม่อนุมัติ')->get();
        return response()->json([
            'status' => 200,
            'otrequests' => $otrequests,
        ]);
    }

    public function code_filter(Request $request)
    {
        $data = $request->get('data');

        $dept = $request->get('dept');

        $otrequest = Otrequest::where('dept', '=', $dept)->where('ot_member_id', 'like', '%' . $data . '%')->get();

        return response()->json([
            'status' => 200,
            'otrequest' => $otrequest,
        ]);
    }

    public function name_filter(Request $request)
    {
        $data = $request->get('data');

        $dept = $request->get('dept');

        $otrequest = Otrequest::where('dept', '=', $dept)->where('create_name', 'like', '%' . $data . '%')->get();

        return response()->json([
            'status' => 200,
            'otrequest' => $otrequest,
        ]);
    }

    public function department_filter(Request $request)
    {
        $data = $request->get('data');

        $otrequest = Otrequest::where('department', 'like', '%' . $data . '%')->get();

        return response()->json([
            'status' => 200,
            'otrequest' => $otrequest,
        ]);
    }

    // filter by status with dept user login
    public function status_filter(Request $request)
    {
        $data = $request->get('data');
        $dept = $request->get('dept');

        $otrequest = Otrequest::where('dept', '=', $dept)->where('status', 'like', $data . '%')->get();

        return response()->json([
            'status' => 200,
            'otrequest' => $otrequest,
        ]);
    }

    // filter by date with dept user login
    public function date_filter(Request $request)
    {
        $data = $request->get('data');
        $dept = $request->get('dept');

        $otrequest = Otrequest::where('dept', '=', $dept)->where('created_at', 'like', '%' . $data . '%')->get();

        return response()->json([
            'status' => 200,
            'otrequest' => $otrequest,
        ]);
    }

    // filter by date with dept user login
    public function date_all_filter(Request $request)
    {
        $data = $request->get('data');

        $otrequest = Otrequest::where('created_at', 'like', '%' . $data . '%')->get();

        return response()->json([
            'status' => 200,
            'otrequest' => $otrequest,
        ]);
    }

    public function ot_list_filter(Request $request)
    {
        $data = $request->get('data');

        $time = TruOtTimeModel::where('ot_list', '=', $data)
            ->select('ot_start')
            ->groupBy('ot_start')
            ->get();

        return response()->json([
            'status' => 200,
            'time' => $time,
        ]);
    }

    public function ot_list_filter_2(Request $request)
    {
        $data = $request->get('data');

        $time = TruOtTimeModel::where('ot_list', '=', $data)
            ->get();

        return response()->json([
            'status' => 200,
            'time' => $time,
        ]);
    }

    public function ot_finish_filter(Request $request)
    {
        $data = $request->get('data');

        $time = TruOtTimeModel::where('ot_finish', '=', $data)
            ->first();

        return response()->json([
            'status' => 200,
            'time' => $time,
        ]);
    }

    public function index()
    {
        return OTrequestResource::collection(Otrequest::all()->sortByDesc('id'));
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

    public function updateReport(Request $request, $id)
    {
        try {

            foreach ($request['test'] as $employees) {
                Employee::where('id', $employees['id'])
                    ->update([
                        'scan'=>$employees['scan'],
                        'objective' => $employees['objective'],
                        'out_time' => $employees['out_time'],
                        'remark' => $employees['remark'],
                    ]);
            }

            return response()->json([
                'status' => 200,
                'employees' => $employees,
                'message' => 'OT Request Update is Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function approve_2(Request $request, $id)
    {
        try {

            $approve = 'รอการอนุมัติ 2';

            $otrequest = Otrequest::find($id);

            $otrequest->status = $approve;

            $otrequest->update();

            $mailData = [
                'title' => 'OT-REQUEST TEAM',
                'url' => 'http://localhost:5173/approver'
            ];

            Mail::to($otrequest->review1_email)->send(new MyDemoMail($mailData));

            return response()->json([
                'status' => 200,
                'otrequest' => $otrequest,
                'message' => 'Approve Status Updated & Send Email is Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function approve_3(Request $request, $id)
    {
        try {

            $approve = 'รอการอนุมัติ 3';

            $otrequest = Otrequest::find($id);
            
            $otrequest->status = $approve;

            $otrequest->update();

            $mailData = [
                'title' => 'OT-REQUEST TEAM',
                'url' => 'http://localhost:5173/approver'
            ];

            Mail::to($otrequest->review1_email)->send(new MyDemoMail($mailData));

            return response()->json([
                'status' => 200,
                'otrequest' => $otrequest,
                'message' => 'Approve Status Updated & Send Email is Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function approve_4(Request $request, $id)
    {
        try {

            $approve = 'ผ่านการอนุมัติ';
            $result = 'รอการปิด (ส่วน)';

            $otrequest = Otrequest::find($id);
            
            $otrequest->status = $approve;
            $otrequest->result = $result;

            $otrequest->update();

            $mailData = [
                'title' => 'OT-REQUEST TEAM',
                'url' => 'http://localhost:5173/approver'
            ];

            Mail::to($otrequest->review1_email)->send(new MyDemoMail($mailData));

            return response()->json([
                'status' => 200,
                'otrequest' => $otrequest,
                'message' => 'Approve Status Updated & Send Email is Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function approve_5(Request $request, $id)
    {
        try {

            $approve = 'รอการปิด (ผจก)';

            $otrequest = Otrequest::find($id);
            
            $otrequest->result = $approve;

            $otrequest->update();

            $mailData = [
                'title' => 'OT-REQUEST TEAM',
                'url' => 'http://localhost:5173/approver'
            ];

            Mail::to($otrequest->review1_email)->send(new MyDemoMail($mailData));

            return response()->json([
                'status' => 200,
                'otrequest' => $otrequest,
                'message' => 'Approve Status Updated & Send Email is Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function approve_6(Request $request, $id)
    {
        try {

            $approve = 'ปิดการรายงาน';

            $otrequest = Otrequest::find($id);
            
            $otrequest->result = $approve;

            $otrequest->update();

            $mailData = [
                'title' => 'OT-REQUEST TEAM',
                'url' => 'http://localhost:5173/approver'
            ];

            Mail::to($otrequest->review1_email)->send(new MyDemoMail($mailData));

            return response()->json([
                'status' => 200,
                'otrequest' => $otrequest,
                'message' => 'Approve Status Updated & Send Email is Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function reject(Request $request, $id)
    {
        $reject = 'ไม่ผ่านการอนุมัติ';

        $result = 'ไม่ผ่านการอนุมัติ';

        $otrequest = Otrequest::find($id);

        $otrequest->status = $reject;
        $otrequest->result = $result;
        //$otrequest->reject_commemt = $request->input('value');

        $otrequest->update();

        return response()->json([
            'status' => 200,
            'otrequest' => $otrequest,
            'message' => 'Reject Status Updated is Successfully',
        ]);
    }

    //update bust station point
    public function bus_point(Request $request, $id)
    {
        $otrequest = Otrequest::find($id);

        $otrequest->bus_point_1 = $request->input('bus_point_1');
        $otrequest->bus_point_2 = $request->input('bus_point_2');
        $otrequest->bus_point_3 = $request->input('bus_point_3');
        $otrequest->bus_point_4 = $request->input('bus_point_4');

        $otrequest->update();

        return response()->json([
            'status' => 200,
            'otrequest' => $otrequest,
            'message' => 'Bus point Updated is Successfully',
        ]);
    }

    public function store(Request $request)
    {
        try {

            $otemp = rand(100, 1000000000);

            $otrequest = new Otrequest;

            $otrequest->department_name = $request->input('department_name');
            $otrequest->department = $request->input('department');
            $otrequest->ot_member_id = $request->input('ot_member_id');
            $otrequest->start_date = $request->input('start_date');
            $otrequest->end_date = $request->input('end_date');
            $otrequest->create_name = $request->input('create_name');
            $otrequest->work_type = $request->input('work_type');
            $otrequest->ot_date = $request->input('ot_date');
            $otrequest->ot_type = $request->input('ot_type');
            $otrequest->total_date = $request->input('total_date');

            $otrequest->name_app_1 = $request->input('name_app_1');
            $otrequest->name_app_2 = $request->input('name_app_2');
            $otrequest->name_app_3 = $request->input('name_app_3');
            $otrequest->name_app_4 = $request->input('name_app_4');
            $otrequest->email_app_1 = $request->input('email_app_1');
            $otrequest->email_app_2 = $request->input('email_app_2');
            $otrequest->email_app_3 = $request->input('email_app_3');
            $otrequest->email_app_4 = $request->input('email_app_4');
            $otrequest->dept = $request->input('dept');
            // create auto code for ot_type
            $otrequest->ot_emp = $otemp;

            $otrequest->save();

            foreach ($request['test'] as $employees) {
                Employee::create([
                    // create auto code for emp
                    'ot_emp_id' => $otemp,

                    'emp_name' => $employees['emp_name'],
                    'cost_type' => $employees['cost_type'],
                    'job_type' => $employees['job_type'],
                    'bus_stations' => $employees['bus_stations'],
                    'code' => $employees['code'],
                    'target' => $employees['target'],
                ]);
            }

            // $mailData = [
            //     'title' => 'OT-REQUEST TEAM',
            //     'url' => 'http://localhost:5173/overtime/'
            // ];

            // Mail::to('narumonza.p@gmail.com')->send(new MyDemoMail($mailData));

            return response()->json([
                'status' => 200,
                'otrequest' => $otrequest,
                'employees' => $employees,
                'message' => 'OT Request Create & Send Email is Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new OTrequestResource(Otrequest::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        try {

            $otrequest = Otrequest::find($id);

            $otrequest->department_name = $request->input('department_name');
            $otrequest->department = $request->input('department');
            $otrequest->ot_member_id = $request->input('ot_member_id');
            $otrequest->start_date = $request->input('start_date');
            $otrequest->end_date = $request->input('end_date');
            $otrequest->create_name = $request->input('create_name');

            $otrequest->update();

            foreach ($request['test'] as $employees) {
                Employee::where('id', $employees['id'])
                    ->update([
                        'emp_name' => $employees['emp_name'],
                        'cost_type' => $employees['cost_type'],
                        'job_type' => $employees['job_type'],
                        'bus_stations' => $employees['bus_stations'],
                    ]);
            }

            return response()->json([
                'status' => 200,
                'otrequest' => $otrequest,
                'employees' => $employees,
                'message' => 'OT Request Update is Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $otrequest = Otrequest::find($id);

        if ($otrequest) {

            $otrequest->delete();

            return response()->json([
                "status" => 200,
                'message' => 'OT Request Deleted Successfuly!'
            ]);
        } else {
            return response()->json([
                "status" => 404,
                'message' => 'OT Request ID Not Found!'
            ]);
        }
    }
}
