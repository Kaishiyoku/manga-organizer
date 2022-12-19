<div class="mb-4">
    <x-label for="order" :value="__('validation.attributes.order')" required/>

    <x-input.input id="order" class="block mt-1 w-full" type="number" name="order" :value="old('order', $socialLink->order) ?? $nextOrder" :min="1"/>

    <x-input.validation-error for="order"/>
</div>

<div class="mb-4">
    <x-label for="url" :value="__('validation.attributes.url')" required/>

    <x-input.input id="url" class="block mt-1 w-full" type="url" name="url" :value="old('url', $socialLink->url)"/>

    <x-input.validation-error for="url"/>
</div>

<div class="mb-4">
    <x-label for="title" :value="__('validation.attributes.title')" required/>

    <x-input.input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $socialLink->title)"/>

    <x-input.validation-error for="title"/>
</div>
