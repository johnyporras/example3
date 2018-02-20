@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            List of Articles 
        </h1>
    </section>
    <div class="content">
    @if(is_object($rs1))
	 @foreach($rs1 as $item)    
    		<div id="parent">
	            	<header>
	            	<p>Title: <a href=" {!! $item->link !!}">{!! $item->title !!}</a></p>
	            	<p>Author: {!! $item->author !!} </p>
	            	<p>Date:  {!! $item->date !!}</p>
	            	<p>Description: {!! substr(strip_tags($item->description),0,400) !!} <a href="detailarticle/{!! $item->idpadre !!}">details</a></p>
	            	</header>
	           <br>
	           <b>Related Articles</b>
	           <br> 
	           <br> 
	           <br> 
	           @foreach($item->sons as $item2)
	        	<div style="margin-left:20px">
	            	<header>
	            	<p>Title: <a href="{!! $item2->link !!}">{!! $item2->title !!}</a></p>
	            	<p>Author: {!! $item2->author !!} </p>
	            	<p>Date:  {!! $item2->date !!}</p>
	            	<p>Description:{!! substr(strip_tags($item2->description),0,400) !!}<a href="detailarticle/{!! $item2->id !!}">details</a></p>
	            	</header>
	            </div>
	            @endforeach
            </div>
            <br><br>
     @endforeach
     @endif
            <br><br>
    </div>
@endsection