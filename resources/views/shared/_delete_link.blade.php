{{ Form::open(['route' => $route, 'method' => 'delete', 'role' => 'form', 'class' => 'inline']) }}
    {!! Html::decode(Form::button('<i class="fas fa-trash"></i> ' . __('common.delete'), ['type' => 'submit', 'class' => 'link-danger', 'data-confirm' => ''])) !!}
{{ Form::close() }}
