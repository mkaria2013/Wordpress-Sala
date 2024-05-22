jQuery(document).ready(function ($) {
    let selector = '.whoisxmlapicom-whois-element';
    let element = $(selector);
    let tooltip = element.tooltipster({
        content: '<div class="lds-ring"><div></div><div></div><div></div><div></div></div>',
        animation: 'fade',
        theme: 'tooltipster-light',
        contentAsHTML: true,
        interactive: true,
        functionBefore: function (instance, helper) {
            let $origin = $(helper.origin);
            let url = 'https://whoisapi.whoisxmlapi.com/api/whois-short-info';
            if ($origin.data('loaded') === true)
                return;

            $.post(
                url,
                {
                    domain: helper.origin.textContent
                },
                function (data, status, request) {
                    instance.content(buildHtmlView(data, buildLink($origin.text()), $origin.data('target')));
                    $origin.data('loaded', true);
                }
            );
        }
    }).tooltipster('instance');

    let buildHtmlView = function (data, url, target) {
        let result = '<div class="whois-info-box">';
        result += '<p>Domain availability: <strong>' + data.domainAvailability + '</strong></p>';
        result += '<p>Contact email: <strong>' + data.contactEmail + '</strong></p>';
        result += '<p>Created date: <strong>' + data.createdDate + '</strong></p>';
        result += '<p>Expires date: <strong>' + data.expiresDate + '</strong></p>';
        result += '<p><a href="' + url + '" target="' + target + '">Full report</a></p>';
        return result;
    };

    let buildLink = function (domain) {
        return 'https://whoisapi.whoisxmlapi.com/whois/' + domain;
    };
});
