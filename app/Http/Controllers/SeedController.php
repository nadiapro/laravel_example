<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Province;
use App\Models\Education;
use App\Models\University;
use App\Models\Role;
use Illuminate\Routing\Controller;

class SeedController extends Controller
{
    public function seed()
    {
           
        $province = Province::create([
            'name' => 'تهران',
                                    ]);
        $user = User::query()->create([
            'first_name' => 'نادیا',
            'last_name' => 'عبدالوند',
            'email' => 'abdolvandnadia@gmail.com',
            'mobile' => '09124171912',
            'password'=> '12345678',
                                    ]);
        $profile = Profile::query()->create([
            'user_id' => $user->id,
            'gender' => 2,
            'marital_status' => 1,
            'birthday' => '2020-07-04',
            'about_me' => '  برنامه نویس مهربون که از چیزای کوچیک لذت میبره   .',
            'minimum_salary' => '10',
            'show_profile' => 1,
            'province_id' => $province->id,
            'address' => 'تهران /شهرک آزادی ',
            'phone_number' => '09124171912',
                                            ]);
        $university1 = University::query()->create([
            'title' => 'شریف',
                                                ]);

        $university2 = University::query()->create([
            'title' => 'تهران',
                                                ]);
        $skill1 = Skill::query()->create([
            'title' => 'لاراول',
                                        ]);

        $skill2 = Skill::query()->create([
        'title' => 'اچ تی ام ال',
                                        ]);
        $skill3 = Skill::query()->create([
        'title' => 'جاوااسکریپت',
                                        ]);
        $education1 = Education::query()->create([
            'university_id' => $university2->id,
            'user_id' => $user->id,
            'grade' => 'لیسانس',
            'major' => 'کارشناس نرم افزار',
            'start_at' => '1395-02-04',
            'end_at' => '1398-02-04',
                                                ]);
        $project = Project::query()->create([
            'user_id' => $user->id,
            'title' => 'وبسایت شخصی',
            'discribtion' => 'وبسایتی جهت ارائه خدمات مربوط به سئو و تولید محتوا',
            'start_at' => '1399-02-04',
            'end_at' => '1401-02-04',
                                            ]);
        $role1=Role::create([
            'title'=>'admin',
        ]);
        $role2=Role::create([
            'title'=>'user',
        ]);
    User::find($user->id)->skills()->attach(Skill::find($skill1->id));
    User::find($user->id)->skills()->attach(Skill::find($skill3->id));
    User::find($user->id)->roles()->attach(Role::find($role1->id));
    }
}
