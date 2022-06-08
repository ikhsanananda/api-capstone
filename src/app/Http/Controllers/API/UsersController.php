<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Akun;
use Illuminate\Http\Request;
use Exception;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Akun::all();

        if($data)
        {
            return ApiFormatter::createApi(200, 'Success', $data);
        }
        else 
        {
            return ApiFormatter::createApi(400, 'Fail');
        }
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
        try{
            $request -> validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'telepon' => 'required',
                'rule' => 'required'
            ]);
            $user = Akun::create([
                'name' => $request -> name,
                'email' => $request -> email,
                'password' => $request -> password,
                'telepon' => $request -> telepon,
                'rule' => $request -> rule,
            ]);
            $data = Akun::where('id','=',$user->id)->get();
            if($data)
            {
                return ApiFormatter::createApi(200, 'Success', $data);
            }
            else 
            {
                return ApiFormatter::createApi(400, 'Fail');
            }
        }
        catch (Exception $error)
        {
            return ApiFormatter::createApi(400, 'Fail');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        $data = Akun::where('email','=',$email)->get();
        if($data)
        {
            return ApiFormatter::createApi(200, 'Success', $data);
        }
        else 
        {
            return ApiFormatter::createApi(400, 'Fail');
        }
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
        try{
            $request -> validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'telepon' => 'required',
                'rule' => 'required'
            ]);

            $user = Akun::findOrFail($id);
            $user -> update([
                'name' => $request -> name,
                'email' => $request -> email,
                'password' => $request -> password,
                'telepon' => $request -> telepon,
                'rule' => $request -> rule,
            ]);
            $data = Akun::where('id','=',$user->id)->get();
            if($data)
            {
                return ApiFormatter::createApi(200, 'Success', $data);
            }
            else 
            {
                return ApiFormatter::createApi(400, 'Fail');
            }
        }
        catch (Exception $error)
        {
            return ApiFormatter::createApi(400, 'Fail');
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
        $user = Akun::findOrFail($id);
        $data = $user->delete();
        if($data)
        {
            return ApiFormatter::createApi(200, 'Delete Success');
        }
        else 
        {
            return ApiFormatter::createApi(400, 'Fail');
        }
    }
}
