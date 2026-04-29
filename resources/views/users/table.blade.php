<table class="table table-responsive" id="users-table">
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($users as $users)
        <tr>
            <td>{!! $users->name !!}</td>
            <td>{!! $users->email !!}</td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $users->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.show', [$users->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></a>
                    <a href="{!! route('users.edit', [$users->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></a>
                    <a href="{{ route('users.assignroles', [$users->id]) }}" class='btn btn-default btn-xs'><i class="far fa-user-tag"></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>