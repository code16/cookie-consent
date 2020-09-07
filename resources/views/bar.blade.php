
<cookie-consent-bar
    endpoint="{{ route('cookie-consent') }}"
    :manage="{{ json_encode($hasManage) }}"
    @if(config('cookie-consent.show-backdrop'))
        backdrop
    @endif
>
    <template v-slot:message>
        {!! trans('cookieConsent::texts.message') !!}
    </template>
    <template v-slot:manage-link>{!! trans('cookieConsent::texts.manage_button') !!}</template>
    <template v-slot:accept-button>{!! trans('cookieConsent::texts.accept_button') !!}</template>
</cookie-consent-bar>