<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Descricao Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descricao', 'Descricao:') !!}
    {!! Form::textarea('descricao', null, ['class' => 'form-control','id'=>'descricao']) !!}
</div>

<!-- Objetivo Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('objetivo', 'Objetivo:') !!}
    {!! Form::textarea('objetivo', null, ['class' => 'form-control','id'=>'objetivo']) !!}
</div>

<!-- Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('projetos.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<script>
      $(function() {
        CKEDITOR.replace( 'descricao', {
			filebrowserUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}'
		});  
      });
    </script>
@endsection