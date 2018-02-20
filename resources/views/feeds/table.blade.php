<table class="table table-responsive" id="feeds-table">
    <thead>
        <th>Type</th>
        <th>Name</th>
        <th>Description</th>
        <th>Url</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($feeds as $feeds)
        <tr>
            <td>{!! $feeds->type !!}</td>
            <td>{!! $feeds->name !!}</td>
            <td>{!! $feeds->description !!}</td>
            <td>{!! $feeds->url !!}</td>
            <td>
                {!! Form::open(['route' => ['feeds.destroy', $feeds->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('feeds.show', [$feeds->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('feeds.edit', [$feeds->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>