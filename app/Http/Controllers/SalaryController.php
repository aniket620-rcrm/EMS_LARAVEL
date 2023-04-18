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
        $salary = Salary::with('user.UserRole')->get();
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

    public function filter(Request $request) {
        $filter_by_role = $request['filter_by_role'];
        $filter_by_status = $request['filter_by_status'];
        $input = $request['input'];

    }

    public function generateSalary()
    {
        $users = User::with(['UserStatus', 'UserRole'])
            ->whereHas('UserStatus', function ($query) {
                $query->where('status', '=', 1);
            })
            ->whereHas('UserRole', function ($query) {
                $query->where('role_name', '!=', 'Admin');
            })->get();

        foreach ($users as $user) {
            //finding current date, month, year and total_days
            $current_date = Carbon::now();
            $month = $current_date->month;
            $year = $current_date->year;
            $total_days = $current_date->daysInMonth;

            //finding userRoletable,base_salary, tax, and deductions from user_role_id
            $userRole = UserRole::find($user['user_role_id']);
            $base_salary = $userRole['base_salary'];
            $tax = $userRole['tax'];
            $deductions = $userRole['deductions'];

            //total_leave_count for this month
            $leave_count = $this->findTotalLeave($user['id']);
            //monthly_salary
            $monthly_salary = $base_salary / 12;
            //daily_salary
            $daily_salary = $monthly_salary / $total_days;
            //total_working_days
            $total_working_days = $total_days - $leave_count;
            //calculating final salary
            $final_salary = $total_working_days * $daily_salary;
            $final_salary = $final_salary - (($final_salary * $tax) / 100);
            $final_salary = $final_salary - $deductions;
            if ($final_salary < 0) {
                $final_salary = 0;
            }

            // creating salary info
            $salary_info = [
                'user_id' => $user['id'],
                'month' => $month,
                'year' => $year,
                'leave_count' => $leave_count,
                'payable_salary' => $final_salary,
                'paid_status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $result = Salary::create($salary_info);
        }
    }

    protected function findTotalLeave($id)
    {
        $currentDate = Carbon::now();
        $month = $currentDate->month;
        $totalDaysInMonth = $currentDate->daysInMonth;
        //leave start and end date is in this month only
        $leaves1 = Leave::where('user_id', '=', $id)
            ->where('approval_status', '=', '1')
            ->whereMonth('leave_start_date', '=', ($month))
            ->whereMonth('leave_end_date', '=', $month)
            ->get();
        //leave start date is in previous month
        $leaves2 = Leave::where('user_id', '=', $id)
            ->whereMonth('leave_start_date', '=', ($month - 1))
            ->whereMonth('leave_end_date', '=', $month)
            ->get();
        //leave end date is in next month
        $leaves3 = Leave::where('user_id', '=', $id)
            ->whereMonth('leave_start_date', '=', $month)
            ->whereMonth('leave_end_date', '=', $month + 1)
            ->get();

        $count = 0;
        //counting leave of type 1
        foreach ($leaves1 as $leave) {
            $leaveStartDate = Carbon::parse($leave->leave_start_date);
            $leaveEndDate = Carbon::parse($leave->leave_end_date);
            $count += $leaveEndDate->diffInDays($leaveStartDate) + 1;
        }
        //counting leave of type 2
        foreach ($leaves2 as $leave) {
            $leaveEndDate = Carbon::parse($leave->leave_end_date);
            $count += $leaveEndDate->day;
        }
        //counting leave of type 3
        foreach ($leaves3 as $leave) {
            $leaveStartDate = Carbon::parse($leave->leave_start_date);
            $count += ($totalDaysInMonth - ($leaveStartDate->day)) + 1;
        }
        return $count;
    }

    public function latestSalary($userId)
    {
        $latestSalary = Salary::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();

        return $latestSalary;
    }

    public function Tax($userId){
        // echo($userId);
        $user = User::where('id', $userId)->first();
        // echo($user);
        $user_role_id = $user['user_role_id'];
        $Tax = UserRole::where('id' , $user_role_id)->first();
        return $Tax;
    }
}
