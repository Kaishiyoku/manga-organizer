{{ Form::open(['route' => $route, 'method' => 'delete', 'role' => 'form', 'class' => 'inline']) }}
    {{ Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn-link btn-delete', 'data-confirm' => '']) }}
{{ Form::close() }}