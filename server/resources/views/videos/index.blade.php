@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Videos</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" href="{!! route('videos.create') !!}">Adicionar video</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        @if(count($videos) > 0)
        <div class="box box-primary">
            <div class="box-body">
                    @include('videos.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
        @endif
    </div>
@endsection

