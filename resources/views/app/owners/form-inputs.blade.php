@php $editing = isset($owner) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.textarea name="name" label="Name" maxlength="255" required
            >{{ old('name', ($editing ? $owner->name : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
