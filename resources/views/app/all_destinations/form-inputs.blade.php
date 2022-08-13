@php $editing = isset($destinations) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $destinations->name : '')) }}"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="property_id" label="Property" required>
            @php $selected = old('property_id', ($editing ? $destinations->property_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Property</option>
            @foreach($properties as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
