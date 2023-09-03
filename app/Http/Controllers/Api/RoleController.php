<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Role::count() != 0){
            $role = Role::all();
            $message = "Roles are listed";
            $status = 200;
        } else {
            $role = NULL;
            $message = "Roles are blank!";
            $status = 404;
        }
        return response()->json([
            "role" => $role,
            "message" => $message,
        ], $status);
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
        try {
            $role = Role::create($request->all());
            $message = "Role is created";
            $status = 201;
        } catch (\Illuminate\Database\QueryException $exception) {
            $role = NULL;
            $message = "Role is failed to created, bad request!";
            $status = 400;
        }
        return response()->json([
            "role" => $role,
            "message" => $message,
        ], $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $find = Role::whereId($id);
        if($find->count("id") != 0) {
            $role = $find->get()->last();
            $message = "Role is found";
            $status = 200;
        } else {
            $role = NULL;
            $message = "Role not found!";
            $status = 404;
        }
        return response()->json([
            "role" => $role,
            "message" => $message,
        ], $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $find = Role::whereId($id);
        if($find->count("id") != 0) {
            $find->update($request->except(["_token", "_method"]));
            $role = $find->get()->last();
            $message = "Role is updated";
            $status = 200;
        } else {
            $role = NULL;
            $message = "Role not found!";
            $status = 404;
        }
        return response()->json([
            "role" => $role,
            "message" => $message,
        ], $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find = Role::whereId($id);
        if($find->count("id") != 0) {
            $role = $find->get()->last();
            $find->delete();
            $message = "Role is deleted";
            $status = 200;
        } else {
            $role = NULL;
            $message = "Role not found!";
            $status = 404;
        }
        return response()->json([
            "role" => $role,
            "message" => $message,
        ], $status);
    }
}
