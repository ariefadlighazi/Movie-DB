@extends('layouts.app')

@section('title', "Login")

@section('content')
<div class="flex flex-col gap-4 mt-4 w-full max-w-md bg-gray-200 p-4 rounded-md shadow-md">
    <h1 class="text-2xl font-bold mb-4">Login</h1>
    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
        @csrf
        <div>
            <label for="username" class="block mb-1">Username</label>
            <input type="text" id="username" name="username" required
                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="password" class="block mb-1">Password</label>
            <input type="password" id="password" name="password" required
                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="flex justify-center">
        <button type="submit"
            class="w-[50%] bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition duration-200">Login</button>
        </div>
    </form>
    <div>
        @if ($errors->any())
            <div class="mt-4 text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
</div>
@endsection