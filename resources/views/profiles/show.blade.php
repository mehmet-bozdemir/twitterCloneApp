@extends('layouts.app')

@section('content')
    <header class="mb-4">
        <div class="justify-center flex ">
            <img src="/images/logo.png" style="height:200px;" alt="logo">
        </div>
    </header>
    <div class="flex justify-between">
        <div>
            <h2 class="font-bold text-2xl mb-2">{{ $user -> name }}</h2>
            <p class="font-mono mb-2">joined {{$user->created_at->diffForHumans()}}</p>
        </div>
        <div class="flex">
            @if (auth()->user()->is($user))
            <form action="">
                <button type="submit" class="bg-blue-500 rounded-lg shadow py-2 px-2 m-1 text-white">Edit Profile</button>
            </form>
            @endif

            @if (auth()->user()->isNot($user))
            <form method="POST" action="/profiles/{{$user->name}}/follow">
                @csrf
                <button type="submit" class="bg-blue-500 rounded-lg shadow py-2 px-2 m-1 text-white">
                    {{auth()->user()->following($user) ? 'Unfollow Me' : 'Follow Me'}}
                </button>
            </form>
            @endif

        </div>
    </div>


    <hr>

    @include('_timeline', [
    'tweets'=>$user->tweets
])
@endsection

