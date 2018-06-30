<table class="table table-responsive" id="servicos-table">
    <thead>
        <tr>
            <th>Titulo</th>
        <th>Descricao</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($servicos as $servico)
        <tr>
            <td>{!! $servico->titulo !!}</td>
            <td>{!! $servico->descricao !!}</td>
            <td>
                {!! Form::open(['route' => ['servicos.destroy', $servico->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('servicos.edit', [$servico->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>