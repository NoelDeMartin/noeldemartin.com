@extends('layouts.master')

@section('content')

    <form method="POST" action="{{ route('login') }}" class="rounded border p-4 border-grey mx-auto max-w-xl">

        @csrf

        <input
            type="email"
            name="email"
            placeholder="Email"
            class="block appearance-none border rounded mb-4 py-2 px-3 text-grey-darker w-full focus:shadow"
        >

        <input
            type="password"
            name="password"
            placeholder="Password"
            class="block appearance-none border rounded mb-4 py-2 px-3 text-grey-darker w-full focus:shadow"
        >

        @foreach ($errors->all() as $error)
            <p class="text-error text-center my-2">{{ $error }}</p>
        @endforeach

        <div class="flex items-center justify-between">

            <button
                type="submit"
                class="bg-blue-dark hover:bg-blue-darker text-white font-bold py-2 px-4 rounded"
            >
                Login
            </button>

            <label class="flex items-center cursor-pointer">
                <input
                    type="checkbox"
                    name="remember"
                    class="mr-2"
                    {{ old('remember') ? 'checked' : '' }}
                > Remember Me
            </label>

        </div>

    </form>
@stop
