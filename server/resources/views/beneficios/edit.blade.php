@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Beneficio
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($beneficio, ['route' => ['beneficios.update', $beneficio->id], 'method' => 'patch']) !!}

                        @include('beneficios.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection