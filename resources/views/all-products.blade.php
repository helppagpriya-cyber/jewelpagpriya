@extends('layout.app')
@section('content')

    <livewire:filter :products="$products" :gender="$gender"/>
    <Livewire:cart-component :cartItems="$cartItems"/>

@endsection
