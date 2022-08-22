<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style> body{ direction: rtl; } </style>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
    </x-slot> 
    <h3>اطلاعات پایه</h3>
        <p>نام و نام خانوادگی : {{$user->first_name}} {{$user->last_name}}</p>
        <p>ایمیل : {{$user->email}}</p>
        <p>شماره موبایل : {{$user->mobile}}</p>
    <hr/>
    <h3>اطلاعات شخصی</h3>
    @isset($profile->gender)<p>جنسیت: @if($profile->gender==1)آقا @elseif($profile->gender==2) خانم @endif </p>
    @endisset
    @isset($profile->birthday)<p>تاریخ تولد: {{$profile->birthday}}</p>@endisset
    @isset($profile->marital_status)<p>وضعیت تاهل: @if($profile->marital_status==1)مجرد  @elseif($profile->marital_status==2) متاهل @endif </p>@endisset
    @isset($profile->about_me)<p>درباره من:{{$profile->about_me}}</p>@endisset
    <hr/>
    <h3>اطلاعات محل سکونت</h3>
    @isset($profile->province->name)
        <p>استان محل سکونت:{{$profile->province->name}}</p> @endisset
        @isset($profile->address) <p>آدرس:{{$profile->address}}</p> @endisset
        @isset($profile->phone_number)<p>تلفن ثابت:{{$profile->phone_number}}</p>@endisset
    <hr/>
    <h3>اطلاعات تحصیلی</h3>
        @foreach ($user->education as $education)
            <ul>
                <li>رشته تحصیلی: {{$education->major}}</li>
                <li>نام دانشگاه: {{$education->university->title}}</li>
                <li>مقطع تحصیلی: {{$education->grade}}</li>
                <li>تاریخ شروع: {{$education->start_at}}</li>
                <li>تاریخ پایان: {{$education->end_at}}</li>
            </ul> <br/>
        @endforeach
    <hr/>
    <h3>مهارتها</h3>
        <ul> @foreach($user->skills as $skill)<li>{{$skill->title}}</li>@endforeach </ul>
    <hr/>
    <h3> پروژه ها</h3>
        @foreach ($user->projects as $project)
            <ul>
                <li>نام پروژه: {{$project->title}}</li>
                <li>توضیحات: {{$project->discribtion}}</li>
                <li>تاریخ شروع: {{$project->start_at}}</li>
                <li>تاریخ پایان: {{$project->end_at}}</li>
            </ul>
        @endforeach
    <hr/>
        <h3>سایر اطلاعات</h3>
        @isset($profile->minimum_salary)<p>حداقل حقوق درخواستی:{{$profile->minimum_salary}}</p>@endisset
        @isset($profile->show_profile) <p>آیا مایلید پروفایل شما به کارفرما نمایش داده شود؟
        @if($profile->show_profile==1)بله @elseif($profile->show_profile==2) خیر @endif </p>@endisset
    </x-app-layout>  
</body>
</html>
