@extends('layouts.admin_layout')

@section('content')
	<div class="logout">
		<admindashboard></admindashboard>
		<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Kijelentkezés </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
	</div>
@endsection