@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            List of Articles 
        </h1>
    </section>
    <div class="content">
	  
    		<div id="parent">
	            	<header>
	            	<p>Title: <a href=" {!! $item->link !!}">{!! $item->title !!}</a></p>
	            	<p>Author: {!! $item->author !!} </p>
	            	<p>Date:  {!! $item->date !!}</p>
	            	<p> {!! $item->description !!} <a href="detailarticle/{!! $item->idpadre !!}">details</a></p>
	            	</header>
	            	
	            	<p>{!! $item->content !!}</p>
	           <br>
            <br><br>
    </div>
@endsection