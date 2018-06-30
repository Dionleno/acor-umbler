<table class="table table-responsive" id="links-table">
    <thead>
        <tr>
            <th>Titulo</th>
        <th>Link</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($links as $link)
        <tr>
            <td>{!! $link->titulo !!}</td>
            <td>{!! $link->link !!}</td>
            <td>
                {!! Form::open(['route' => ['links.destroy', $link->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('links.edit', [$link->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>