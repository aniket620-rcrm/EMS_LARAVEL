<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeRequests = Leave::with('user.UserRole')
        ->orderByCreatedAt()->get();
        return $activeRequests;

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

    public function filter(Request $request)
    {
        $filter_by_role = $request['filter_by_role'];
        $filter_by_status = $request['filter_by_status'];
        $input = $request['input'];
        if ($filter_by_role === 'all' && $filter_by_status === 'all' && strlen($input) === 0) {
            return $this->index();
        } 
        
        elseif ($filter_by_role === 'all' && $filter_by_status === 'all') {
            $requests = Leave::with('user.UserRole')
                ->filterBySearch($input)
                ->orderByCreatedAt()->get();
            return $requests;
        } 
        
        else if ($filter_by_role !== 'all' && $filter_by_status === 'all') {
            $requests = Leave::with('user.UserRole')
                ->filterByRole($filter_by_role)
                ->filterBySearch($input)
                ->orderByCreatedAt()->get();
            return $requests;
        } 
        
        else if ($filter_by_role === 'all' && $filter_by_status !== 'all') {
            $requests = Leave::with('user.UserRole')
                ->where('approval_status', '=', $filter_by_status)
                ->filterBySearch($input)
                ->orderByCreatedAt()->get();
            return $requests;
        } 
        
        else {
            $requests = Leave::with('user.UserRole')
                ->where('approval_status', '=', $filter_by_status)
                ->filterByRole($filter_by_role)
                ->filterBySearch($input)
                ->orderByCreatedAt()->get();
            return $requests;
        }
    }
   

    // public function search(Request $request) {
    //     $input = $request['input'];
        
    //     return $result;
    // }

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
    public function update(Request $request)
    {
        //
        $leave = Leave::findorfail($request->id);
        $leave->approval_status = $request->approval_status;
        $leave->approved_by = 'Admin';
        $result = $leave->save();
        if ($result) {
            return ['Result' => 'user_status updated'];
        } else {
            return ['Result' => 'operation failed!!'];
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
        //
    }

    // public function LeaveRequestForMonth($userId){
    //     $count = Leave::where('user_id', $userId)->count();
    //     return $count;
    // }

    public function RecentLeave($userId){
        $leave = Leave::where('user_id', $userId)->orderBy('created_at','desc')->first();
        return $leave;
    }

public function leaveRequest(Request $request)
{
   // Validate the form input
   $validatedData = $request->validate([
    'user_id' => 'required|integer',
    // 'employee_name' => 'required|string|max:255',
    'leave_start_date' => 'required|date',
    'leave_end_date' => 'required|date|after_or_equal:leave_start_date',
]);

// Create a new leave record with the validated data
$leave = new Leave();
$leave->user_id = $validatedData['user_id'];
$leave->leave_start_date = $validatedData['leave_start_date'];
$leave->leave_end_date = $validatedData['leave_end_date'];
$leave->approval_status = 0;
$leave->approved_by = 'Admin';
$leave->created_at = now();
$leave->updated_at = now();

// Save the leave record to the database
$leave->save();

// Redirect back to the form with a success message
return redirect()->back()->with('success', 'Leave request submitted successfully.');
}

}
