@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Plano
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($plano, ['route' => ['planos.update', $plano->id], 'method' => 'patch']) !!}

                        @include('planos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection