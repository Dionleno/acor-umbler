<table class="table table-responsive" id="projetos-table">
    <thead>
        <tr>
            <th>Nome</th>
        <th>Objetivo</th>
        <th>Descricao</th>
        <th>Link</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($projetos as $projeto)
        <tr>
            <td>{!! $projeto->nome !!}</td>
            <td>{!! $projeto->objetivo !!}</td>
            <td>{!! $projeto->descricao !!}</td>
            <td>{!! $projeto->link !!}</td>
            <td>
                {!! Form::open(['route' => ['projetos.destroy', $projeto->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('projetos.edit', [$projeto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Deseja deletar esse projeto?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>