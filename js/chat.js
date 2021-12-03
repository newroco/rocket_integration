document.addEventListener("DOMContentLoaded", function () {
    var elements = document.getElementsByClassName('messenger--add-members-info');

    if (elements.length > 0) {
        setTimeout(function () {
            elements[0].classList.add('messenger--hidden');
        }, 7000);
    }

    var $customOAuthNameInput = document.getElementById('custom-oauth-name');
    var customOAuthName = $customOAuthNameInput.value;

    if (customOAuthName) {
        attemptAutoLoginWithOAuth(customOAuthName);
    }

    function attemptAutoLoginWithOAuth(customOAuthName) {
        var $iframe = document.getElementById('rocket-chat-iframe');

        if ( ! $iframe) {
            return;
        }

        $iframe.onload = function() {
            // var alreadyLoggedIn = window.hasOwnProperty('Meteor') &&
            //     window.Meteor &&
            //     window.Meteor.userId() !== null;
            //
            // if (alreadyLoggedIn) {
            //     return;
            // }

            setTimeout(function () {
                $iframe.contentWindow.postMessage({
                    externalCommand: 'call-custom-oauth-login',
                    service: customOAuthName,
                }, '*');
            }, 500);
        };
    }
});
