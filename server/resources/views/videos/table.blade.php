<table class="table table-responsive" id="videos-table">
    <thead>
        <tr>
            <th>Titulo</th>
        <th>Descricao</th>
        <th>Link</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($videos as $video)
        <tr>
            <td>{!! $video->titulo !!}</td>
            <td>{!! $video->descricao !!}</td>
            <td>{!! $video->link !!}</td>
            <td>{!! $video->status !!}</td>
            <td>
                {!! Form::open(['route' => ['videos.destroy', $video->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('videos.edit', [$video->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Deseja deletar esse video?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>