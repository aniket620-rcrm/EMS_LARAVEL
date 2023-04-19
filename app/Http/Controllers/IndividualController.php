<?php

namespace App\Http\Controllers;
use App\Models\Leave;
use App\Models\Salary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndividualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $user=User::where('id' , $id)->with('UserStatus','UserRole')->first();
        return $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function salary($id)
    {
        // return $id;
        $salaries=Salary::where('user_id',$id)->get();
        return $salaries;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

public function leave($id)
{
    $leaves = Leave::where('user_id', $id)->get();

    $data = [];
    foreach ($leaves as $leave) {
        $data[] = [
            "id" => $leave->id,
            "user_id" => $leave->user_id,
            "leave_start_date" => Carbon::parse($leave->leave_start_date)->format('d-m-Y'),
            "leave_end_date" => Carbon::parse($leave->leave_end_date)->format('d-m-Y'),
            "approval_status" => $leave->approval_status,
            "approved_by" => $leave->approved_by,
            "created_at" => Carbon::parse($leave->created_at)->format('d-m-Y'),
            "updated_at" => $leave->updated_at,
        ];
    }

    return response()->json($data);
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

public function updateProfile(Request $request)
{
    // return "Received";
    $id = $request -> id;
  $user = User::findOrFail($id);
  
//   $user->employee_id = $request->input('employee_id');
  $user->name = $request->name;
  $user->email = $request->email;
  $user->phone = $request->phone;
  $user->password = bcrypt($request->password);
//   return $request;
  $user->save();
  

  return $user;
}

}
