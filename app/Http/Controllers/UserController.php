<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User();
        $result = $user::with(['UserStatus', 'UserRole'])
            ->notAdmin()->get();
        return $result;
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
        $filter_by_status = $request['filter_by_status'];
        $filter_by_role = $request['filter_by_role'];
        $input = $request['input'];
        if ($filter_by_status === "all" && $filter_by_role === "all" && strlen($input) === 0) {
            return $this->index();
        }
        
        elseif ($filter_by_status === 'all' && $filter_by_role === "all") {
            $result = User::with(['UserStatus', 'UserRole'])
                ->notAdmin()
                ->filterBySearch($input)->get();
            return $result;
        } 
        
        elseif ($filter_by_role !== 'all' && $filter_by_status === 'all') {
            $result = User::with(['UserStatus', 'UserRole'])
            ->notAdmin()
                ->filterByRole($filter_by_role)
                ->filterBySearch($input)->get();
            return $result;
        } 
        
        elseif ($filter_by_status !== 'all' && $filter_by_role === 'all') {
            $result = User::with(['UserStatus', 'UserRole'])
            ->notAdmin()
                ->filterByStatus($filter_by_status)
                ->filterBySearch($input)->get();
            return $result;
        } 
        
        else {
            $result = User::with(['UserStatus', 'UserRole'])
            ->notAdmin()
                ->filterByRole($filter_by_role)
                ->filterByStatus($filter_by_status)
                ->filterBySearch($input)->get();
            return $result;
        }
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
    public function update(Request $request)
    {
        //
        $user_id=$request->user_id;
        $user = User::where('id','=',$user_id)->first();
        $user_role_id = $user->user_role_id;
        $UserRole = UserRole::where('id','=',$user_role_id)->first();
        $user_role =  $UserRole->role_name;
        if($user_role!=='Admin') {
            return response()->json([
                'error' => 'User is not Admin',
            ], 400);
        }
        $user = User::findorfail($request->id);
        $user->user_status_id = $request->user_status_id;
        $result = $user->save();
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
}
