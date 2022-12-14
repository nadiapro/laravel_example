<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" style="direction:rtl" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{auth()->user()->first_name }}عزیز خوش آمدی
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p><a href="{{route('user.edit',['user'=>auth()->id()])}}">ویرایش پروفایل</a></p>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p><a href="{{route('user.show',['user'=>auth()->id()])}}">نمایش پروفایل</a></p>
        </div>
        @foreach(auth()->user()->roles as $role)
            @if($role->title == 'admin')
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <p><a href="{{route('user.index')}}">همه کاربران </a></p>
                </div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <p><a href="{{route('user.create')}}">ایجاد کاربر</a></p>
                </div>
            @endif
        @endforeach
    </div>
</x-app-layout>
