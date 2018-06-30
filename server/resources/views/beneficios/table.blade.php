<table class="table table-responsive" id="beneficios-table">
    <thead>
        <tr>
            <th>Titulo</th>
        <th>Descricao</th>
        <th>Tipo</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($beneficios as $beneficio)
        <tr>
            <td>{!! $beneficio->titulo !!}</td>
            <td>{!! $beneficio->descricao !!}</td>
            <td>{!! $beneficio->tipo !!}</td>
            <td>
                {!! Form::open(['route' => ['beneficios.destroy', $beneficio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>

                    <a href="{!! route('beneficios.edit', [$beneficio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>