@props([
    'categories'
])


<cookie-manage-modal
    endpoint="{{ route('cookie-consent') }}"
    :categories="{{ json_encode($categories) }}"
    required-label="{{ trans('cookieConsent::texts.manage.required_label') }}"
    anonymize-label="{{ trans('cookieConsent::texts.manage.anonymize_checkbox') }}"
>
    {!! trans('cookieConsent::texts.manage.description') !!} -
    <a class="cc-manage-modal__page-link" href="{{ config('cookie-consent.page_url') }}">{{ trans('cookieConsent::texts.manage.link_label') }}</a>

    <template v-slot:title>{!! trans('cookieConsent::texts.manage.title') !!}</template>
    <template v-slot:cancel-button>{!! trans('cookieConsent::texts.manage.cancel_button') !!}</template>
    <template v-slot:ok-button>{!! trans('cookieConsent::texts.manage.ok_button') !!}</template>
</cookie-manage-modal>
