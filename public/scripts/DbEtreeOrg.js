DbEtreeOrg = {
    settings: {

    },

    init: function() {
        s = this.settings;
        this.bindUIActions();
    },

    bindUIActions: function() {
        $('.expand-all').live('click', function() {
            console.log($('i.icon-double-angle-down').parent().not('.expand-all').trigger('click'));
            return false;
        });

        $('.create-performer').live('click', function() {
            DbEtreeOrg.createModal('/performer/create');
            return false;
        });

        $('.create-band').live('click', function() {
            DbEtreeOrg.createModal('/band/create');
            return false;
        });

        $('.create-venue').live('click', function() {
            DbEtreeOrg.createModal('/venue/create');
            return false;
        });

        $('.create-song').live('click', function() {
            DbEtreeOrg.createModal('/song/create');
            return false;
        });

        $('.create-lineup').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/lineup/create/' + id);
            return false;
        });

        $('.create-performer-alias').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performer-alias/create/' + id);
            return false;
        });

        $('.add-performer-to-lineup').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performer-lineup/create/' + id);
            return false;
        });

        $('.edit-performer-lineup').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performer-lineup/edit/' + id);
            return false;
        });

        $('.edit-performer-alias').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performer-alias/edit/' + id);
            return false;
        });

        $('.edit-lineup').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/lineup/edit/' + id);
            return false;
        });

        $('.create-performer-performance').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performer-performance/create/' + id);
            return false;
        });

        $('.edit-performer-performance').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performer-performance/edit/' + id);
            return false;
        });

        $('.create-performance-set').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performance-set/create/' + id);
            return false;
        });

        $('.edit-performance-set').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performance-set/edit/' + id);
            return false;
        });

        $('.create-performance-set-song').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performance-set-song/create/' + id);
            return false;
        });


        $('.edit-performance-set-song').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performance-set-song/edit/' + id);
            return false;
        });

        $('.create-checksum').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/checksum/create/' + id);
            return false;
        });

        $('.edit-checksum').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/checksum/edit/' + id);
            return false;
        });

        $('.edit-source').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/source/edit/' + id);
            return false;
        });

        $('.edit-performer').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performer/edit/' + id);
            return false;
        });

        $('.edit-band').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/band/edit/' + id);
            return false;
        });

        $('.edit-venue').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/venue/edit/' + id);
            return false;
        });

        $('.edit-song').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/song/edit/' + id);
            return false;
        });

        $('.edit-performance').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performance/edit/' + id);
            return false;
        });

        $('.create-band-alias').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/band-alias/create/' + id);
            return false;
        });

        $('.edit-band-alias').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/band-alias/edit/' + id);
            return false;
        });

        $('.create-link').live('click', function() {
            id = $(this).attr('data-id');
            entityName = $(this).attr('data-entity-name');
            DbEtreeOrg.createModal('/link/create/' + id + '&entityName=' + entityName);
            return false;
        });

        $('.edit-link').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/link/edit/' + id);
            return false;
        });
    },

    createModal: function(page) {
        modal = $('<span class="modal fade"></span>')
            .appendTo('body')
            .load(page, function() {
                $(modal).modal();
            });
    }
}