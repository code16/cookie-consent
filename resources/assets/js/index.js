

const config = {
    name: window.cookieConsent.name,
    lifetimeInDays: window.cookieConsent.lifetimeInDays,
}

function getCookie() {
    // todo
}

function setCookie(value) {
    // todo
}

function parse(cookieValue) {
    const params = new URLSearchParams(cookieValue);
    return Object.fromEntries(params.entries());
}

function serialize(form) {
    const formData = new FormData(form);
    return (new URLSearchParams(formData)).toString();
}

export class CookieConsent {
    static setup() {
        CookieConsent.setupBar();
        CookieConsent.setupModalForm();
    }
    static setupModalForm(form = document.querySelector('#manage-cookies form')) {
        [...form.querySelectorAll('[type=checkbox]')]
            .forEach(checkbox => {
                checkbox.checked = CookieConsent.hasConsented(checkbox.name, true);
            });

        form.addEventListener('submit', e => {
            e.preventDefault();
            setCookie(serialize(e.target));
            location.reload();
        });
    }
    static setupBar(el = document.querySelector('#cc-bar')) {
        if(!CookieConsent.hasConsented()) {
            document.body.classList.add('cc-visible');
        }
        el.querySelector('form').addEventListener('submit', e => {
            e.preventDefault();
            setCookie('all=1');
            location.reload();
        });
    }
    static hasConsented(category, defaultValue = false) {
        const value = parse(getCookie());
        if(!category) {
            return !!value;
        }
        if(!value) {
            return defaultValue;
        }
        return value[category] !== '0';
    }
    static getValue() {
        return parse(getCookie());
    }
}

window.CookieConsent = CookieConsent;
