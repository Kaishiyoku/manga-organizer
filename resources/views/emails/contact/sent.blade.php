@section('title', trans('home.emails.contact.title'))

{{ __('validation.attributes.fullname') }}: {{ $fullname }}
{{ __('validation.attributes.email') }}: {{ $email }}

{{ __('validation.attributes.content') }}:

{{ $content }}