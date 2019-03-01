@php $allowUnsubscribe = false; @endphp

@extends('emails.layout')

@section('preheader', __('password_reset.subject'))

@section('content')

    @include('emails.include.paragraph', ['text' => __('password_reset.hi') .' '. $user->name . ','])
    @include('emails.include.paragraph', ['text' => __('password_reset.p1')])
    @include('emails.include.button', ['url' => url('/reset-password/'.$token), 'title' => __('password_reset.link_title')])
    @include('emails.include.paragraph', ['text' => __('password_reset.p2')])
    @include('emails.include.paragraph', ['text' => __('password_reset.p3')])

@endsection