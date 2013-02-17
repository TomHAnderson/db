require(['modernizr.min', 'bootstrap.min', 'datemask', 'underscore-min'], function() {
    $('a.confirm').live('click', function(event) {
        return confirm('Are you sure?');
    });

    $('a.returnUrl').live('click', function(event) {
        if (!confirm('Are you sure?')) return false;

        window.location = $(this).attr('href') + '&returnUrl=' + window.location.href;

        return false;
    });
});
