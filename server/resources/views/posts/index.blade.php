@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Materias</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" href="{!! route('posts.create') !!}">Adicionar materia</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        @if(count($posts) > 0)
        <div class="box box-primary">
            <div class="box-body">
                    @include('posts.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
        @endif
    </div>
@endsection

