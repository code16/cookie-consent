@props([
    'hasManage',
    'backdrop'
])

@if($backdrop)
    <div class="modal-backdrop cc-cookie-bar__backdrop"></div>
@endif
<div class="cc-cookie-bar cc-slide-up {{ $backdrop ? 'cc-cookie-bar--modal container' : '' }}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md">
                {!! trans('cookieConsent::texts.message') !!}
            </div>
            <div class="col-md-auto mt-2 mt-md-0">
                <div class="row align-items-center justify-content-end">
                    @if($hasManage)
                        <div class="col-auto">
                            <button class="btn btn-link btn-sm cc-cookie-bar__link px-0" data-bs-toggle="modal" data-bs-target="#manage-cookies">
                                {!! trans('cookieConsent::texts.manage_button') !!}
                            </button>
                        </div>
                    @endif
                    <div class="col-auto">
                        <form method="post" action="{{ route('cookie-consent') }}" data-cc-form>
                            <button type="submit" class="btn btn-primary btn-lg cc-cookie-bar__btn">
                                {!! trans('cookieConsent::texts.accept_button') !!}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
