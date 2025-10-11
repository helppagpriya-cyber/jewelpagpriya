@extends('layout.app')
@section('content')

    <livewire:filter :products="$products" :gender="$gender"/>

@endsection
