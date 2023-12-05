<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\AddNewRequest;
use App\Http\Requests\User\UpdateRequest;
use Excepsion;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=User::paginate(10);
        return view('user.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role=Role::get();
        return view('user.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddNewRequest $request)
    {
        try {
            $data=new User();
            $data->name_en=$request->userName_en;
            $data->name_bn=$request->userName_bn;
            $data->email=$request->EmailAddress;
            $data->contact_no_en=$request->contactNumber_en;
            $data->contact_no_bn=$request->contactNumber_bn;
            $data->role_id=$request->roleId;
            $data->status=$request->status;
            $data->full_access=$request->fullAccess;
            $data->language='en';

            $data->password=Hash::make($request->password);

            if($request->hasFile('image')){
                $imageName=rand(111,999).time().'.'.$request->image->extension();
                $request->image->move(public_path('uploads/users'),$imageName);
                $data->image=$imageName;
            }
            $data->created_by=currentUserId();
           
            if($data->save()){
                $this->notice::success('Users successfully Added');
                return redirect()->route('user.index');
            }else{
                $this->notice::error('Please try again');
                return redirect()->back()->withInput;
            }
            } catch (Excepsion $e) {
                dd($data);
                $this->notice::error('Please try again');
                return redirect()->back()->withInput;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role=Role::get();
        $user=User::findorFail(encryptor('decrypt',$id));
        return view('user.edit',compact('user','role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $data=User::findorFail(encryptor('decrypt',$id));
            $data->name_en=$request->userName_en;
            $data->name_bn=$request->userName_bn;
            $data->email=$request->EmailAddress;
            $data->contact_no_en=$request->contactNumber_en;
            $data->contact_no_bn=$request->contactNumber_bn;
            $data->role_id=$request->roleId;
            $data->status=$request->status;
            $data->full_access=$request->fullAccess;

            if($request->password)
                $data->password=Hash::make($request->password);

            if($request->hasFile('image')){
                $imageName = rand(111,999).time().'.'.$request->image->extension();
                $request->image->move(public_path('uploads/users'),$imageName);
                $data->image=$imageName;
            }
            $data->updated_by=currentUserId();
            if($data->save()){
                $this->notice::success('Data successfully Updated');
                return redirect()->route('user.index');
            }else{
                return redirect()->back()->withInput();
            }
        } catch (Excepsion $e) {
            dd($e);
            return redirect()->back()->withInput()->with('error','Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try {
            $data= User::findOrFail(encryptor('decrypt',$id));
        $image_path=public_path('uploads/users/').$data->image;

        if($data->delete()){
            if(File::exists($image_path))
                File::delete($image_path);

                $this->notice::success('Data successfully deleted');
           return redirect()->back();
        }
        } catch (Exception $e) {
            dd($e);
        }



    }
}
