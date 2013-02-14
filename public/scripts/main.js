require(['modernizr.min', 'bootstrap.min', 'datemask'], function() {
    $('.confirm').live('click', function(event) {
        return confirm('Are you sure?');
    });
});
