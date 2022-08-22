<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Province;
use App\Models\Education;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        foreach(auth()->user()->roles as $role)
        {
                if($role->title == 'admin')
                {
                return view('user.index',[
                    'users'=>User::paginate(1)->withQueryString()
                                        ]);
                }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        foreach(auth()->user()->roles as $role)
        {
            if($role->title == 'admin')
            {
                return view('user.create',[
                    'skills'=>Skill::all(),
                    'provinces'=>Province::all(),
                    'universities'=>University::all(),
                                        ]);
            }
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
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'mobile'=>'required',
            'email'=>'required',
            'password'=>'required',
                            ]);

        $user=User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
                            ]);
        $province=Province::firstOrCreate([
                    'name'=>$request->province,
                                        ]);
        Profile::create([
            'user_id'=>$user->id,
            'gender'=>$request->gender,
            'marital_status'=>$request->marital,
            'birthday'=>$request->birthday,
            'about_me'=>$request->about_me,
            'minimum_salary'=>$request->minimum_salary,
            'address'=>$request->address,
            'phone_number'=>$request->phone,
            'show_prfile'=>$request->show_prfile,
            'province_id'=>$province->id,
            ]);
        foreach($request->skill as $title)
        {
            if(trim($title) != null)
            {
                $skill=Skill::firstOrCreate([
                    'title'=>$title,
                                            ]);
                User::find($user->id)->skills()->attach(Skill::find($skill->id));
            }
        }
        $university=University::firstOrCreate([
            'title'=>$request->university,
                                            ]);
        Education::create([
            'user_id'=>$user->id,
            'university_id'=>$university->id,
            'grade'=>$request->grade,
            'major'=>$request->major,
            'start_at'=>$request->start_at,
            'end_at'=>$request->end_at,
                        ]);
        Project::create([
            'user_id'=>$user->id,
            'title'=>$request->project_title,
            'discribtion'=>$request->project_discribtion,
            'start_at'=>$request->start_at_project,
            'end_at'=>$request->end_at_project,
                        ]);
        return Redirect::route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->id()==$id)
        {
        return view('user.show',[
            'user'=>User::find($id),
            'profile'=>User::find($id)->profile,
                                ]);
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
        if(auth()->id()==$id)
        {
        return view('user.edit',[
            'user'=>User::find($id),
            'profile'=>User::find($id)->profile,
            'skills'=>Skill::all(),
            'provinces'=>Province::all(),
            'universities'=>University::all(),
                                ]);
        }                       
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
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'mobile'=>'required',
            'email'=>'required',
                            ]);
       $user=User::find($id)->update([
        'first_name'=>$request->first_name,
        'last_name'=>$request->last_name,
        'email'=>$request->email,
        'mobile'=>$request->mobile,
                                    ]);
        $province=Province::firstOrCreate([
                'name'=>$request->province,
                                        ]);
       
        Profile::updateOrCreate([
            'user_id'=>$id,],[
            'gender'=>$request->gender,
            'marital_status'=>$request->marital,
            'birthday'=>$request->birthday,
            'about_me'=>$request->about_me,
            'minimum_salary'=>$request->minimum_salary,
            'address'=>$request->address,
            'phone_number'=>$request->phone,
            'show_profile'=>$request->show_prfile,
            'province_id'=>$province->id,
                                ]);
        User::find($id)->skills()->detach();
        foreach($request->skill as $title)
        {
            if(trim($title) != null)
            {
                $skill=Skill::firstOrCreate([
                    'title'=>$title,
                                            ]);
                User::find($id)->skills()->attach(Skill::find($skill->id));
            }
        }
        $university=University::firstOrCreate([
            'title'=>$request->university,
                                            ]);
        Education::updateOrCreate(
            ['user_id'=>$id,],[
            'university_id'=>$university->id,
            'grade'=>$request->grade,
            'major'=>$request->major,
            'start_at'=>$request->start_at,
            'end_at'=>$request->end_at,
                                                ]);
        Project::updateOrCreate(
            ['user_id'=>$id,],[
            'title'=>$request->project_title,
            'discribtion'=>$request->project_discribtion,
            'start_at'=>$request->start_at_project,
            'end_at'=>$request->end_at_project,
                                                ]);
       return Redirect::route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        foreach(auth()->user()->roles as $role)
        {
            if($role->title == 'admin')
            {
                User::find($id)->delete();
                return Redirect::route('user.index');
            }
        }
    }
}
