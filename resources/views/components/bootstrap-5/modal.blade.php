@props([
    'categories',
])

<div class="modal fade cc-manage-modal" id="manage-cookies" tabindex="-1" aria-hidden="true" aria-labelledby="manageCookiesTitle">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageCookiesTitle">
                    {!! trans('cookieConsent::texts.manage.title') !!}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cc-manage-modal__description mb-3">
                    {!! trans('cookieConsent::texts.manage.description') !!}
                    @if(config('cookie-consent.page_url'))
                        -
                        <a class="cc-manage-modal__page-link" href="{{ config('cookie-consent.page_url') }}">
                            {{ trans('cookieConsent::texts.manage.link_label') }}
                        </a>
                    @endif
                </div>
                <div class="cc-manage-form">
                    <div class="list-group list-group-flush">
                        @foreach($categories as $category)
                            <input type="hidden" name="{{ $category['key'] }}" value="0" form="manage-cookies-form">
                            <div class="list-group-item px-1">
                                <div class="form-check">
                                    <input class="form-check-input" name="{{ $category['key'] }}" type="checkbox" value="1" id="cookie-{{ $category['key'] }}"
                                        @if($category['required'])
                                            disabled
                                        @endif
                                        @if($category['required'])
                                            checked
                                        @endif
                                        form="manage-cookies-form"
                                    >
                                    <label class="form-check-label cc-manage-form__item-label" for="cookie-{{ $category['key'] }}">
                                        <span class="cc-manage-form__item-title">
                                            {!! $category['title'] !!}
                                            @if($category['required'])
                                                <span class="cc-manage-form__required-label">
                                                    {{ trans('cookieConsent::texts.manage.required_label') }}
                                                </span>
                                            @endif
                                        </span>
                                        <span class="cc-manage-form__item-description">
                                            {!! $category['description'] !!}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form id="manage-cookies-form" method="post" action="{{ route('cookie-consent') }}">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                        {!! trans('cookieConsent::texts.manage.ok_button') !!}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
