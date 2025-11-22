@extends('layout.app')
@section('content')

<div class="container mx-auto my-2 ">
    <div class="flex flex-wrap items-center justify-center gap-4">
        @foreach($parentCategories as $parent)
            <div class="w-[18rem] m-2 rounded-lg border-2 shadow-sm">
                <a wire:navigate href="{{url('subcategory/'.$parent->id)}}" class="no-underline text-gray-900">
                    <img src="{{asset('storage/'.$parent->image)}}" class="w-full h-[230px] object-cover rounded-t-lg" alt="Card image">
                    <div class="p-4">
                        <h5 class="text-xl font-semibold text-center">{{$parent->name}}</h5>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

@endsection