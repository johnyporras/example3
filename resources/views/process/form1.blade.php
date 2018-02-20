@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Main Process 
        </h1>
    </section>
    <div class="content">
    


        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                 <button type="button" class="btn btn-primary btn-lg" id="import1">Import articles from feeds</button>
                </div>
                <br>
                <br>
                <div class="row" style="padding-left: 20px">
                 <button type="button" class="btn btn-primary btn-lg" id="relate1">Relate articles</button>
                 
                    
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
$("#import1").on('click',function()
  {
	waitingDialog.show('Importing new artcles from your RSS feeds list');
	//alert("sdsd");    
    url2="showarticles";
    var params =
    {
      
    }
    
    $.getJSON(url2,params,function(data)
    {
      if(data.success==true)
      {
        	alert("Done");
        	waitingDialog.hide()
      }
      else
      {
    	    alert("Failed");
    	    waitingDialog.hide();
      }
    })
  })
  
  
  $("#relate1").on('click',function()
  {
	  waitingDialog.show('Relating the articles by their content');
	//alert("sdsd");    
    url2="relatearticles";
    var params =
    {
      
    }
    
    $.getJSON(url2,params,function(data)
    {
      if(data.success==true)
      {
    	  	waitingDialog.hide();
        	alert("Done");
      }
      else
      {
    	  waitingDialog.hide();
    	    alert("Failed");
      }
    })
  })
  
  </script>
  @endsection