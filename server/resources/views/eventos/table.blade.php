<table class="table table-responsive" id="eventos-table">
    <thead>
        <tr>
            <th>Logo</th>
        <th>Titulo</th>
        <th>Data</th>
        <th>Local</th>
        <th>Horario</th>
        <th>Valor</th>
        <th>Site</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($eventos as $evento)
        <tr>
            <td><img src="{!! $evento->logo !!}" width="80"/></td>
            <td>{!! $evento->titulo !!}</td>
            <td>{!! $evento->data !!}</td>
            <td>{!! $evento->local !!}</td>
            <td>{!! $evento->horario !!}</td>
            <td>{!! $evento->valor !!}</td>
            <td>{!! $evento->site !!}</td>
            <td>{!! $evento->status !!}</td>
            <td>
                {!! Form::open(['route' => ['eventos.destroy', $evento->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('eventos.edit', [$evento->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Deseja deletar esse evento?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>