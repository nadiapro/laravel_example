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
   <form method="post" action="{{route('user.update',['user'=>$user->id])}}">
    @csrf
    @method('put')
            <label for="first_name">نام</label>
                <input type="text" name="first_name" id="first_name" value="{{$user->first_name}}">
                @error('first_name') <span>{{$message}}</span> @enderror <br/>
            <label for="last_name">نام خانوادگی</label>
                <input type="text" name="last_name" id="last_name" value="{{$user->last_name}}">
                @error('last_name') <span>{{$message}}</span> @enderror <br/>
            <label for="email">ایمیل</label>
                <input type="email" name="email" id="email" value="{{$user->email}}"><br/>
            <label for="mobile">موبایل</label>
                <input type="tel" name="mobile" id="mobile" placeholder="09100000000" value="{{$user->mobile}}"><br/>
        <p>جنسیت</p>
            <label for="male">آقا</label>
                <input type="radio" name="gender" id="male" value="1" @isset($profile->gender)@if($profile->gender==1)checked @endif @endisset>
            <label for="no">خانم</label>
                <input type="radio" name="gender" id="female" value="2" @isset($profile->gender)@if($profile->gender==2)checked @endif @endisset>
            <br/>
            <label for="birthday">تاریخ تولد</label>
                <input type="date" name="birthday" id="birthday" @isset($profile->birthday) value="{{$profile->birthday}}" @endisset>
            <br/>
        <p>وضعیت تاهل</p>
            <label for="single">مجرد</label>
                <input type="radio" name="marital" id="single" value="1" @isset($profile->marital_status)@if($profile->marital_status==1) checked @endif @endisset>
            <label for="married">متاهل</label>
                <input type="radio" name="marital" id="married" value="2" @isset($profile->marital_status)@if($profile->marital_status==2) checked @endif @endisset>
            <br/>
        <p>اطلاعات موقعیتی</p>
            <label for="province">نام استان</label>
                <input list="province" name="province" @isset($profile->province->name) value="{{$profile->province->name}}" @endisset>
                    <datalist id="province">
                        @foreach ($provinces as $province)<option value="{{$province->name}}"> @endforeach
                    </datalist><br/>
            <label for="address">آدرس</label>
                <textarea name="address" id="address">@isset($profile->address){{$profile->address}} @endisset</textarea><br/>
            <label for="phone">تلفن ثابت</label>
                <input type="tel" name="phone" id="phone" @isset($profile->phone_number) value="{{$profile->phone_number}}" @endisset>
                <br/>
        <p>تحصیلات</p>
            @foreach($user->education as $education)
                <label for="university">نام دانشگاه</label>
                    <input list="university" name="university" @isset($education->university->title) value="{{$education->university->title}}" @endisset>
                        <datalist id="university">
                            @foreach ($universities as $university)
                            <option value="{{$university->title}}">
                            @endforeach
                        </datalist> <br/>
                <label for="grade">مقطع تحصیلی</label>
                    <input type="text" name="grade" id="grade" value="{{$education->grade}}"> <br/>
                <label for="major">رشته تحصیلی</label>
                    <input type="text" name="major" id="major" value="{{$education->major}}"><br/>
                <label for="start_at">تاریخ شروع</label>
                    <input type="date" name="start_at" id="start_at" value="{{$education->start_at}}"><br/>
                <label for="end_at">تاریخ پایان</label>
                    <input type="date" name="end_at" id="end_at" value="{{$education->end_at}}"><br/>
            @endforeach
        <label for="minimum_salary">حداقل حقوق درخواستی</label>
            <input type="range" name="minimum_salary" id="minimum_salary" min="0" max="20" @isset($profile->minimum_salary) value={{$profile->minimum_salary}} @endisset>میلیون
        <br/>
    <p>مایلید پرفایل شما به کارفرما نمایش داده شود؟</p>
        <label for="yes">بله</label>
            <input type="radio" name="show_prfile" id="yes" value="1" @isset($profile->show_profile) @if($profile->show_profile) checked @endif @endisset>
        <label for="no">خیر</label>
            <input type="radio" name="show_prfile" id="no" value="2" @isset($profile->show_profile) @if(!$profile->show_profile) checked @endif @endisset>
    <br/>
        <label for="about_me">درباره من</label>
            <textarea name="about_me" id="about_me">@isset($profile->about_me) {{$profile->about_me}} @endisset</textarea>
        <br/>
    <p>مهارتها</p>
        @foreach($skills as $skill)
                    <label for="{{$skill->title}}">{{$skill->title}}</label>
                        <input type="checkbox" name="skill[]" value="{{$skill->title}}" id="{{$skill->title}}"
                         @foreach($user->skills as $title) @if($skill->title == $title->title) checked @endif @endforeach> 
        @endforeach    
    <br/>
        <label for="skill">مهارتهای دیگر</label>
            <input type="text" name="skill[]" id="skill">
        <br/>
    <p>پروژه هایی که انجام دادید؟</p>
        @foreach($user->projects as $project)
            <label for="project_title">نام پروژه</label>
                <input type="text" name="project_title" id="project_title" value="{{$project->title}}">
                <br/>
            <label for="project_discribtion">توضیحات</label>
                <textarea name="project_discribtion" id="project_discribtion">{{$project->discribtion}}</textarea>
                <br/>
            <label for="start_at_project">تاریخ شروع</label>
                <input type="date" name="start_at_project" id="start_at_project" value="{{$project->start_at}}">
                <br/>
            <label for="end_at_project">تاریخ پایان</label>
                <input type="date" name="end_at_project" id="end_at_project" value="{{$project->end_at}}">
                <br/>
        @endforeach
    <button type="submit"> ذخیره ویرایش</button>
   </form>
</body>
</html>
