<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TruEmployees;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = TruEmployees::all();
        return response()->json([
            'status'=>200,
            'employees'=>$employees,
        ]);
    }

    public function role_filter(Request $request)
    {
        $data = $request->get('data'); 
       
        $employees = TruEmployees::where('dept', '=', $data)
        ->get();

        return response()->json([
            'status'=> 200,
            'employees'=> $employees,
        ]);
    }

    public function select_filter(Request $request)
    {
        $data = $request->get('data'); 
       
        $employees = TruEmployees::where('full_name', '=', $data)
        ->first();

        return response()->json([
            'status'=> 200,
            'employees'=> $employees,
        ]);
    }

    public function importFile(Request $request) 
    {
        try {
            $importFile = $request->file('importFile');
            Excel::import(new EmployeesImport, $importFile);              
        } catch (\Throwable $th){
            return response()->json([
                'status'=>'error',
                'message'=>$th->getMessage()
            ],400);
        }
        return response()->json([
            'status'=>'success',
            'message' => 'Import file successfully.'
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = TruEmployees::find($id);
        if($employee){
            return response()->json([
                'status'=>200,
                'employee'=>$employee,
            ]);
        } else {
            return response()->json([
                'status'=>400,
                'message'=>'No employee id found!!!'
            ]);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
