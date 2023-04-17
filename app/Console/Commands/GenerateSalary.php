<?php

namespace App\Console\Commands;

use App\Models\Leave;
use App\Models\Salary;
use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateSalary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:GenerateSalary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate and add salaries for all active employees in salary table every month on a specific date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
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
            if($final_salary<0) $final_salary = 0;
            // creating salary info
            $salary_info = [
                'user_id'=>$user['id'],
                'month'=> $month,
                'year'=>$year,
                'leave_count'=>$leave_count,
                'payable_salary'=>$final_salary,
                'paid_status'=>0,
                'created_at'=>now(),
                'updated_at'=>now(),
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
            $count += $leaveEndDate->diffInDays($leaveStartDate)+1;
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
}
