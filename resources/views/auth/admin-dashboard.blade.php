@extends('layouts/admin_layout')
@section('is-active','is-active')
@section('hero_title','Laser Tag - Admin felület')
@section('hero_subtitle','Vezérlőpult')
@section('section')
<div id="app">
	<admin_dashboard></admin_dashboard>
	@csrf
</div>
@stop