<table class="table table-responsive" id="planos-table">
    <thead>
        <tr>
            <th>Vigencia</th>
        <th>Valor</th>
        <th>Tipo</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($planos as $plano)
        <tr>
            <td>{!! $plano->vigencia !!}</td>
            <td>{!! $plano->valor !!}</td>
            <td>{!! $plano->tipo !!}</td>
            <td>
                {!! Form::open(['route' => ['planos.destroy', $plano->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('planos.edit', [$plano->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>