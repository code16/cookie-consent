@props([
    'component',
    'theme',
])

@php($componentName = sprintf('cookie-consent::%s.%s', $theme, $component))

<x-dynamic-component
    :component="$componentName"
    :attributes="$attributes"
/>
