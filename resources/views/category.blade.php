@extends('layout.app')
@section('content')

    <div class="container mx-auto my-2">
        <div class="flex flex-wrap items-center justify-center gap-4">
            @foreach($category->children as $parent)
                <div class="w-[18rem] m-2">
                    <a wire:navigate href="{{url('products/'.$parent->id)}}" class="no-underline text-gray-900">
                        <img src="{{asset('storage/'.$parent->image)}}" class="w-full h-[230px] object-cover" alt="Card image">
                        <div class="p-4">
                            <h5 class="text-xl font-semibold text-center">{{$parent->name}}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection