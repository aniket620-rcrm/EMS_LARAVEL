<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Salary;
use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $salary = Salary::with('user.UserRole')
        ->orderByDate()
        ->get();
        
        return $salary;
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

    public function makeSalaryPaid(Request $request) {
        $user_id=$request->user_id;
        $user = User::where('id','=',$user_id)->first();
        $user_role_id = $user->user_role_id;
        $UserRole = UserRole::find($user_role_id);
        $user_role =  $UserRole->role_name;
        if($user_role!=='Admin') {
            return response()->json([
                'error' => 'User is not Admin',
            ], 400);
        }
        $id = $request->id;
        $paid_status = $request->paid_status;
        $salary = Salary::find($id);
        $salary->paid_status = $paid_status;
        $salary->save();
        return ["paid_status"=>"paid"];
    }

    public function filter(Request $request) {
        $filter_by_role = $request['filter_by_role'];
        $filter_by_status = $request['filter_by_status'];
        $input = $request['input'];
        $salary = Salary::with('user.UserRole');
        if ($filter_by_role === 'all' && $filter_by_status === 'all' && strlen($input) === 0) {
            return $this->index();
        } 
        
        elseif ($filter_by_role === 'all' && $filter_by_status === 'all') { 
            $results = $salary
            ->filterBySearch($input)
            ->orderByDate()->get();
            return $results;
        }
        
        else if ($filter_by_role !== 'all' && $filter_by_status === 'all') {
            $results =  $salary
            ->filterByRole($filter_by_role)
            ->filterBySearch($input)
            ->orderByDate()->get();
            return $results;
        }

        else if ($filter_by_role === 'all' && $filter_by_status !== 'all') {
            $results =  $salary
            ->where('paid_status','=',$filter_by_status)
            ->filterBySearch($input)
            ->orderByDate()->get();
            return $results;
        }

        else {
            $results =  $salary
            ->where('paid_status','=',$filter_by_status)
            ->filterByRole($filter_by_role)
            ->filterBySearch($input)
            ->orderByDate()->get();
            return $results;
        }

    }

    public function latestSalary($userId)
    {
        $latestSalary = Salary::where('user_id','=', $userId)
            ->orderBy('created_at', 'desc')
            ->first();

        return $latestSalary;
    }

    public function Tax($userId)
    {
        // echo($userId);
        $user = User::where('id', $userId)->first();
        // echo($user);
        $user_role_id = $user['user_role_id'];
        $Tax = UserRole::where('id' , $user_role_id)->first();
        return $Tax;
    }
}
