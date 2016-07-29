@extends('layout')

@section('header')
All Cards
@stop


@section('content')
<ul>
@foreach($cards as $cards)
<li><a href="cards/{{$cards->id}}">
{{$cards->title}}
</a></li>
@endforeach
</ul>
@stop
