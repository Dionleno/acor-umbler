 @section('css')
<link rel="stylesheet" href="<?php echo asset('css/bootstrap-timepicker.css')?>">

<style>
    .cropit-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-top: 7px;
        width: 130px;
        height: 107px;
    }

    .cropit-preview-image-container {
        cursor: move;
    }

    .image-size-label {
        margin-top: 10px;
    }
</style>
@endsection


<div class="clearfix"></div>

<!-- Titulo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('titulo', 'Titulo:') !!} {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
</div>

<!-- Descricao Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descricao', 'Descricao:') !!} {!! Form::textarea('descricao', null, ['class' => 'form-control','id'=>'event-ckeditor'])
    !!}
</div>

<!-- Data Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data', 'Data:') !!} {!! Form::date('data', $data, ['class' => 'form-control']) !!}
</div>

<!-- Local Field -->
<div class="form-group col-sm-6">
    {!! Form::label('local', 'Local:') !!} {!! Form::text('local', null, ['class' => 'form-control']) !!}
</div>

<!-- Horario Field -->
<div class="form-group col-sm-6">

    <!-- time Picker -->
    <div class="bootstrap-timepicker">
        <div class="form-group" style="margin-bottom: 0px;">
            {!! Form::label('horário', 'Horário:') !!}

            <div class="input-group">
                {!! Form::text('horario', null, ['class' => 'form-control timepicker']) !!}

                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->
    </div>

</div>


<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!} {!! Form::text('valor', null, ['class' => 'form-control','id' => 'valor']) !!}
</div>

<!-- Site Field -->
<div class="form-group col-sm-6">
    {!! Form::label('site', 'Site:') !!} {!! Form::text('site', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!} {!! Form::select('status', ['0' => 'aberto', '1' => 'fechado'], null, ['class' =>
    'form-control']) !!}
</div>

<div class="image-editor">
    <!-- Logo Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('logo', 'Logo:') !!} {!! Form::file('logox',['class' => 'cropit-image-input']) !!} {!! Form::text('logo',
        null, ['class' => 'form-control imagebase hidden']) !!}
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



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::button('Save', ['class' => 'btn btn-primary submit']) !!}
    <a href="{!! route('eventos.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<script src="<?php echo asset('js/cropfile.js')?>"></script>
<script src="<?php echo asset('js/bootstrap-timepicker.js')?>"></script>

<script>
    var logo = '{!! isset($evento) ? $evento->logo : "" !!}';
    $(function () {

        $('.timepicker').timepicker({
            showInputs: false
        });
        $("#valor").maskMoney({
            prefix: 'R$ ',
            allowNegative: true,
            thousands: '.',
            decimal: ',',
            affixesStay: false
        });
        CKEDITOR.replace('event-ckeditor', {
			filebrowserUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}'
		});
        itemcrop('.image-editor', logo,1,130,107);

        $('.submit').click(function () {
            var imageData = $('.image-editor').cropit('export');
            $(this).parents('form').find('.image-editor').find('.imagebase').val(imageData);
            $(this).parents('form').submit();
        });
    });
</script>
@endsection