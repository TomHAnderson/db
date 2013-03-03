require(['modernizr.min', 'bootstrap.min', 'datemask', 'underscore-min', 'jqBootstrapValidation', 'DbEtreeOrg'], function() {
    DbEtreeOrg.init();

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

    // Map all icons to title name
    $('a i.icon-film').attr('title', 'Performer');
    $('a i.icon-facetime-video').attr('title', 'Performer Alias');
    $('a i.icon-magic').attr('title', 'Performance');
    $('a i.icon-certificate').attr('title', 'Performance Set');
    $('a i.icon-map-marker').attr('title', 'Venue');
    $('a i.icon-folder-close').attr('title', 'Venue Group');
    $('a i.icon-folder-close').attr('title', 'Event');
    $('a i.icon-folder-close').attr('title', 'Producer');
    $('a i.icon-group').attr('title', 'Lineup');
    $('a i.icon-cogs').attr('title', 'Band');
    $('a i.icon-folder-close').attr('title', 'Band Group');
    $('a i.icon-folder-close').attr('title', 'Alias');
    $('a i.icon-headphones').attr('title', 'Source');
    $('a i.icon-ok-circle').attr('title', 'Checksum');
    $('a i.icon-bolt').attr('title', 'Performance Song');
    $('a i.icon-music').attr('title', 'Song');
    $('a i.icon-folder-close').attr('title', 'Composer');
    $('a i.icon-folder-close').attr('title', 'Abstract Comment');
    $('a i.icon-folder-close').attr('title', 'Abstract Link');
    $('a i.icon-group').attr('title', 'Performer Lineup');

    // Change submit button to disabled and add spinner
    $('button[type="send"]').live('click', function(event) {
        $(this).attr('disabled', 'disabled')
            .removeClass('btn-success')
            .addClass('btn-default');

        // Disable cancel button
        $(this).parent().find('button[data-dismiss="modal"]').attr('disabled', 'disabled');

        $(this).find('i').removeClass()
            .removeClass('icon-map-marker')
            .addClass('icon-spinner')
            .addClass('icon-spin');
    });
});
