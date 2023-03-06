@props([
    'theme',
])

<x-cookie-consent::themed-component
    component="bar"
    :theme="$theme"
    :attributes="$attributes"
/>
