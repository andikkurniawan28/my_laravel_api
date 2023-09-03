<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        if(User::count() != 0){
            $data = User::all();
            $message = "Users are listed";
            $status = 200;
        } else {
            $data = NULL;
            $message = "Users are blank!";
            $status = 404;
        }
        return response()->json([
            "data" => $data,
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
            $request->request->add(["password" => bcrypt($request->password)]);
            $data = User::create($request->all());
            $message = "User is created";
            $status = 201;
        } catch (\Illuminate\Database\QueryException $exception) {
            $data = NULL;
            $message = "User is failed to created, bad request!";
            $status = 400;
        }
        return response()->json([
            "data" => $data,
            "message" => $message,
        ], $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $find = User::whereId($id);
        if($find->count("id") != 0) {
            $data = $find->get()->last();
            $message = "User is found";
            $status = 200;
        } else {
            $data = NULL;
            $message = "User not found!";
            $status = 404;
        }
        return response()->json([
            "data" => $data,
            "message" => $message,
        ], $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $find = User::whereId($id);
        if($find->count("id") != 0) {
            $find->update($request->except(["_token", "_method"]));
            $data = $find->get()->last();
            $message = "User is updated";
            $status = 200;
        } else {
            $data = NULL;
            $message = "User not found!";
            $status = 404;
        }
        return response()->json([
            "data" => $data,
            "message" => $message,
        ], $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find = User::whereId($id);
        if($find->count("id") != 0) {
            $data = $find->get()->last();
            $find->delete();
            $message = "User is deleted";
            $status = 200;
        } else {
            $data = NULL;
            $message = "User not found!";
            $status = 404;
        }
        return response()->json([
            "data" => $data,
            "message" => $message,
        ], $status);
    }
}
