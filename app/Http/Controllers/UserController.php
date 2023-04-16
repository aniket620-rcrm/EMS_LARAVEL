<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            ->where('user_role_id', '!=', '1')->get();

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
        } elseif ($filter_by_status === 'all' && $filter_by_role === "all") {
            $result = User::with(['UserStatus', 'UserRole'])
                ->where('user_role_id', '!=', '1')
                ->where('name', 'like', '%' . $input . '%')->get();
            return $result;
        } elseif ($filter_by_role !== 'all' && $filter_by_status === 'all') {
            $result = User::with(['UserStatus', 'UserRole'])
                ->where('user_role_id', '!=', '1')
                ->where('User_role_id', '=', $filter_by_role)
                ->where('name', 'like', '%' . $input . '%')->get();
            return $result;
        } elseif ($filter_by_status !== 'all'&&$filter_by_role === 'all') {
            $result = User::with(['UserStatus', 'UserRole'])
                ->where('user_role_id', '!=', '1')
                ->where('User_status_id', '=', $filter_by_status)
                ->where('name', 'like', '%' . $input . '%')->get();
            return $result;
        } else {

            $result = User::with(['UserStatus', 'UserRole'])
                ->where('user_role_id', '!=', '1')
                ->where('User_role_id', '=', $filter_by_role)
                ->where('user_status_id', '=', $filter_by_status)
                ->where('name', 'like', '%' . $input . '%')->get();
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
