@php $allowUnsubscribe = false; @endphp

@extends('emails.layout')

@section('preheader', __('verify_email.title'))

@section('content')

    @include('emails.include.paragraph', ['text' => __('verify_email.hi') .' '. $user->name . ','])
    @include('emails.include.paragraph', ['text' => __('verify_email.p1')])
    @include('emails.include.button', 	 ['url' => url('verify-email/'.$user->email_token), 'title' => __('verify_email.link_title')])
    @include('emails.include.paragraph', ['text' => __('verify_email.p2')])
    @include('emails.include.paragraph', ['text' => __('verify_email.p3')])

@endsection