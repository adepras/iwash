@extends('layouts.app')

@section('title', 'Payment Success')

@section('content')
<div class="container py-5">
    <h2>Payment Successful</h2>
    <p>Your payment was successful. Thank you for your purchase!</p>
    <a href="{{ route('profile') }}">Go to Profile</a>
</div>
@endsection
