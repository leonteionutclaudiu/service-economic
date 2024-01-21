@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-economic-darkgreen focus:ring-economic-darkgreen rounded-md shadow-sm']) !!}>
