@props([
    'theme',
])


<x-cookie-consent::themed-component
    component="modal"
    :theme="$theme"
    :attributes="$attributes->merge([
        'categories' => $categories,
        'value' => $value,
    ])"
/>
