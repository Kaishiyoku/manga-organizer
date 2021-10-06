@props(['for'])

@error($for)
    <div class="text-sm text-red-800 pt-1">
        {{ $message }}
    </div>
@enderror
