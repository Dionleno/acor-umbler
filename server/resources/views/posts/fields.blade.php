@section('css')
<style>
      .cropit-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-top: 7px;  
        width: 250px;
        height: 250px;
      }
      
      .image-editor-horizontal .cropit-preview{
         width: 380px;
         height: 150px;
      }

      .cropit-preview-image-container {
        cursor: move;
      }

      .image-size-label {
        margin-top: 10px;
      }

       
    </style>
@endsection

<div class="form-group col-sm-9" style="padding:0;">
<!-- Titulo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('titulo', 'Titulo:') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
</div>

<!-- Linha Fina Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('linha_fina', 'Linha Fina:') !!}
    {!! Form::textarea('linha_fina', null, ['class' => 'form-control','id'=>'post-linha-ckeditor']) !!}
</div>

<!-- Texto Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('texto', 'Texto:') !!}
    {!! Form::textarea('texto', null, ['class' => 'form-control','id'=>'post-ckeditor']) !!}
</div>

<div class="image-editor-horizontal">
        <!-- Logo Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('Thumbnail', 'Thumbnail Horizontal:') !!}
            {!! Form::file('thumbnailx',['class' => 'cropit-image-input']) !!}
            {!! Form::text('banner', null, ['class' => 'form-control imagebase hidden']) !!}
         
            
            <div class="image-size-label">
               Ajuste de imagem
            </div>
            <input type="range" class="cropit-image-zoom-input" style="width:300px">
            <div class="cropit-preview" style="margin: 10px 0;"></div>
            <button type="button" class="rotate-ccw">
                Direita
            </button>
            <button type="button" class="rotate-cw">
              Esquerda
            </button>
      </div>   
</div>

<div class="image-editor">
        <!-- Logo Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('image', 'Thumbnail:') !!}
            {!! Form::file('imagex',['class' => 'cropit-image-input']) !!}
            {!! Form::text('image', null, ['class' => 'form-control imagebase hidden']) !!}

            <div class="image-size-label">
               Ajuste de imagem
            </div>
            <input type="range" class="cropit-image-zoom-input" style="width:300px">
            <div class="cropit-preview" style="margin: 10px 0;"></div>
            <button type="button" class="rotate-ccw">
                Direita
            </button>
            <button type="button" class="rotate-cw">
              Esquerda
            </button>
          

      </div>   
</div>

</div>

<div class="form-group col-sm-3">

<!-- Cobertura Id Field -->
<div class="form-group">
    {!! Form::label('cobertura_id', 'Cobertura de evento:') !!}
    {!! Form::text('cobertura_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Categoria Id Field -->
<div class="form-group">
    {!! Form::label('categoria_id', 'Categoria:') !!}
    {!! Form::select('categoria_id', $categorias , null, ['class' => 'form-control','placeholder' => 'Selecione uma categoria']) !!}
</div>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
      {!! Form::button('Save', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('posts.index') !!}" class="btn btn-default">Cancel</a>
</div>

 
@section('scripts')
<script src="<?php echo asset('js/cropfile.js')?>"></script>

<script>
     var image = '{!! isset($post) ? $post->image : "" !!}';
     var banner = '{!! isset($post) ? $post->banner : "" !!}';
      $(function() {
        
        CKEDITOR.replace( 'post-ckeditor', {
			filebrowserUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}'
		});
        CKEDITOR.replace( 'post-linha-ckeditor', {
			filebrowserUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}'
		});
   
         itemcrop('.image-editor', image,1,380,280);
         itemcrop('.image-editor-horizontal', banner,1,380,150);
            
        $('.submit').click(function() {
          var imageDatathumbnail = $('.image-editor-horizontal').cropit('export');
          var imageData = $('.image-editor').cropit('export');
         
          
         if(imageDatathumbnail != 'undefined'){
            $(this).parents('form').find('.image-editor-horizontal').find('.imagebase').val(imageDatathumbnail);
         }
         if(imageData != 'undefined'){
            $(this).parents('form').find('.image-editor').find('.imagebase').val(imageData);
         }
         
        $(this).parents('form').submit();
 
         return false;
        });
      });
    </script>
@endsection