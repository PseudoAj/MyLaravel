@extends('layout')

@section('mytitle')
<h1>Test News</h1>
@stop

@section('content')
@foreach($news as $news)
<div>
  <h2><a  href="data/{{$news->id}}">{{$news->title}}</a><h2>
</div>
<div>
  <p>{{$news->desc}}<p>
</div>
@endforeach
@stop
