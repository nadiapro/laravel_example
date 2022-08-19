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
    @if ($errors->all())
    خطا
    @foreach ($errors->all() as $error) <li style="color:red">{{$error}}</li> @endforeach
    <hr/>
    @endif
   <form method="post" action="{{route('user.store')}}">
    @csrf
    <label for="first_name">نام</label>
    <input type="text" name="first_name" id="first_name">
    <br/>
    @error('first_name') <span style="color:red">{{$message}}</span> <br/>@enderror
    <label for="last_name">نام خانوادگی</label>
    <input type="text" name="last_name" id="last_name">
    <br/>
    @error('last_name') <span style="color:red">{{$message}}</span> <br/>@enderror
    <label for="email">ایمیل</label>
    <input type="email" name="email" id="email">
    <br/>
    @error('email') <span style="color:red">{{$message}}</span> <br/>@enderror
    <label for="mobile">موبایل</label>
    <input type="tel" name="mobile" id="mobile" placeholder="09100000000">
    <br/>
    @error('mobile') <span style="color:red">{{$message}}</span> <br/>@enderror
    <label for="password">پسوورد</label>
    <input type="password" name="password" id="password">
    <br/>
    @error('password') <span style="color:red">{{$message}}</span> <br/>@enderror
    <br/> <hr/>
    <p>جنسیت</p>
    <label for="male">آقا</label>
    <input type="radio" name="gender" id="male" value="1">
    <label for="no">خانم</label>
    <input type="radio" name="gender" id="female" value="2">
    <br/>
    <label for="birthday">تاریخ تولد</label>
    <input type="date" name="birthday" id="birthday">
    <br/>
    <p>وضعیت تاهل</p>
    <label for="single">مجرد</label>
    <input type="radio" name="marital" id="single" value="1">
    <label for="married">متاهل</label>
    <input type="radio" name="marital" id="married" value="2">
    <br/>
    <p>اطلاعات محل سکونت</p>
    <label for="province">نام استان</label>
        <input list="province" name="province">
        <datalist id="province">
            @foreach ($provinces as $province) <option value="{{$province->name}}"> @endforeach
        </datalist>
    <br/>
    <label for="address">آدرس</label>
    <textarea name="address" id="address"></textarea>
    <br/>
    <label for="phone">تلفن ثابت</label>
    <input type="tel" name="phone" id="phone">
    <br/>
    <p>تحصیلات</p>
    <label for="university">نام دانشگاه</label>
    <input list="university" name="university">
    <datalist id="university">
        @foreach ($universities as $university)
            <option value="{{$university->title}}">
        @endforeach
    </datalist>
    <br/>
    <label for="grade">مقطع تحصیلی</label>
    <input type="text" name="grade" id="grade">
    <br/>
    <label for="major">رشته تحصیلی</label>
    <input type="text" name="major" id="major">
    <br/>
    <label for="start_at">تاریخ شروع</label>
    <input type="date" name="start_at" id="start_at">
    <br/>
    <label for="end_at">تاریخ پایان</label>
    <input type="date" name="end_at" id="end_at">
    <br/>

    <label for="minimum_salary">حداقل حقوق درخواستی</label>
    <input type="range" name="salary" id="minimum_salary" min="0" max="20">میلیون
    <br/>
    <p>مایلید پرفایل شما به کارفرما نمایش داده شود؟</p>
    <label for="yes">بله</label>
    <input type="radio" name="show_prfile" id="yes" value="1">
    <label for="no">خیر</label>
    <input type="radio" name="show_prfile" id="no" value="2">
    <br/>

    <label for="about_me">درباره من</label>
    <textarea name="about_me" id="about_me"></textarea>
    <br/>
    <p>مهارتها</p>
    @foreach ($skills as $skill)
    <label for="{{$skill->title}}">{{$skill->title}}</label>
    <input type="checkbox" name="skill[]" value="{{$skill->title}}" id="{{$skill->title}}">
    @endforeach
    <br/>
    <label for="skill">مهارتهای دیگر</label>
    <input type="text" name="skill[]" id="skill">
    <br/>

    <p>پروژه هایی که انجام دادید؟</p>
    <label for="project_title">نام پروژه</label>
    <input type="text" name="project_title" id="project_title">
    <br/>
    <label for="project_discribtion">توضیحات</label>
    <textarea name="project_discribtion" id="project_discribtion"></textarea>
    <br/>
    <label for="start_at_project">تاریخ شروع</label>
    <input type="date" name="start_at_project" id="start_at_project">
    <br/>
    <label for="end_at_project">تاریخ پایان</label>
    <input type="date" name="end_at_project" id="end_at_project">
    <br/>
    <button type="submit">ذخیره</button>
   </form>
</body>
</html>
