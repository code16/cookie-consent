<cookie-manage-modal
    endpoint="{{ route('cookie-consent') }}"
    :categories="{{ json_encode($categories) }}"
    required-label="{{ trans('cookieConsent::texts.manage.required_label') }}"
>
    {!! trans('cookieConsent::texts.manage.description') !!}
    <template v-slot:title>{!! trans('cookieConsent::texts.manage.title') !!}</template>
    <template v-slot:cancel-button>{!! trans('cookieConsent::texts.manage.cancel_button') !!}</template>
    <template v-slot:ok-button>{!! trans('cookieConsent::texts.manage.ok_button') !!}</template>
</cookie-manage-modal>