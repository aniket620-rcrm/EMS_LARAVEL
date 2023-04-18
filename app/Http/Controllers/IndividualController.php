<?php

namespace App\Http\Controllers;
use App\Models\Leave;
use App\Models\Salary;
use App\Models\User;
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
        // return $id;
        $leaves=Leave::where('user_id',$id)->get();
        return $leaves;
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
    $id = $request -> id;
  $user = User::findOrFail($id);
  
//   $user->employee_id = $request->input('employee_id');
  $user->name = $request->input('name');
  $user->email = $request->input('email');
  $user->phone = $request->input('phone');
  $user->password = $request->input('password');
//   return $request;
  $user->save();
  
  return response()->json(['message' => 'Profile updated successfully']);
}

}
