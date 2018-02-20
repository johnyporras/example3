@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Feeds
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($feeds, ['route' => ['feeds.update', $feeds->id], 'method' => 'patch']) !!}

                        @include('feeds.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection