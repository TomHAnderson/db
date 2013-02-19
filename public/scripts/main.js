require(['modernizr.min', 'bootstrap.min', 'datemask', 'underscore-min', 'jqBootstrapValidation'], function() {
    $('a.confirm').live('click', function(event) {
        return confirm('Are you sure?');
    });

    $('a.returnUrl').live('click', function(event) {
        if (!confirm('Are you sure?')) return false;

        window.location = $(this).attr('href') + '&returnUrl=' + window.location.href;

        return false;
    });

    $("input,textarea,select").not("[type=submit]").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // Here I do nothing, but you could do something like display
            // the error messages to the user, log, etc.
            alert('submit error');
        },
        submitSuccess: function($form, event) {
//            alert("Form OK");
//            event.preventDefault();
        },
        filter: function() {
            return $(this).is(":visible");
        }
    });
});
