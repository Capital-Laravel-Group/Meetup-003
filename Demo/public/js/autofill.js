var autofill = {

    init: function () {
        autofill.bindEvents();
    },

    bindEvents: function() {
        // Click on "Facebook Connect" button
        $('.btn-facebook').click(function() {
            FB.getLoginStatus(autofill.facebookLoginStatusCallback);
            return false;
        });
    },

    facebookLoginStatusCallback: function (response) {
        if (response && response.status === 'connected') {
            autofill.facebookAutofill();
        } else {
            FB.login(autofill.facebookLoginCallback, { scope: 'email' });
        }
    },

    facebookLoginCallback: function (response) {
        if (response && response.authResponse) {
            autofill.facebookAutofill();
        } else {
            console.log(response);
            alert('Could not autofill with Facebook');
        }
    },

    facebookAutofill: function () {
        FB.api('/me', function(user) {
            // Fill out form fields
            $('#name').val(user.name);
            $('#email').val(user.email);
        });
    }

};

// Initialize on DOM ready
$(autofill.init);