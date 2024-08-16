<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeScanModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TimeScanImport;

class TimeScanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scan = TimeScanModel::all();

        return response()->json([
            'status'=> 200,
            'scan'=> $scan,
        ]);
    }

    // filter by emp_id and first time
    public function filter_first_time(Request $request)
    {
        $data = $request->get('data');
        $time = $request->get('time');

        $scan = TimeScanModel::where('pin', '=', $data)
        // ->where('time', 'like', '%'.$time.'%')
        // ->orderBy('index', 'ASC')
        ->first();

        return response()->json([
            'status' => 200,
            'scan' => $scan,
        ]);
    }

    // filter by emp_id and last time
    public function filter_last_time(Request $request)
    {
        $data = $request->get('data');
        $time = $request->get('time');

        $scan = TimeScanModel::where('pin', '=', $data)
        ->where('time', 'like', '%'.$time.'%')
        ->orderBy('index', 'DESC')
        ->first();

        return response()->json([
            'status' => 200,
            'scan' => $scan,
        ]);
    }

    // import text file from time scan record
    public function importFile(Request $request) 
    {
        try {
            $csvFile = $request->file('csvFile');
            Excel::import(new TimeScanImport, $csvFile);              
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
        //
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
