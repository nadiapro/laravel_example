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
    <p><a href="{{route('user.create')}}">ایجاد کاربر جدید</a></p>
    <table>
    <thead>
        <tr>
            <td>ردیف</td>
            <td>نام</td>
            <td>نام خانوادگی</td>
            <td>ایمیل</td>
            <td>موبایل</td>
            <td>نمایش</td>
            <td>ویرایش</td>
            <td>حذف</td>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($users as $user)
        <tr>
            <td> {{$i++}} </td>
            <td> {{$user->first_name}} </td>
            <td> {{$user->last_name}} </td>
            <td> {{$user->email}} </td>
            <td> {{$user->mobile}} </td>
            <td><a href="{{route('user.show',['user'=>$user->id])}}">نمایش</a>
            <td><a href="{{route('user.edit',['user'=>$user->id])}}">ویرایش</a></td>
            <td><form method="post" action="{{route('user.destroy',['user'=>$user->id])}}">
                    @csrf  @method('delete')
                    <button type="submit">حذف</button> </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
    {{ $users->links() }}
</body>
</html>
