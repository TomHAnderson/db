DbEtreeOrg = {
    settings: {

    },

    init: function() {
        s = this.settings;
        this.bindUIActions();
    },

    bindUIActions: function() {
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
            DbEtreeOrg.createModal('/lineup/create?id=' + id);
            return false;
        });

        $('.create-performer-alias').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performer-alias/create?id=' + id);
            return false;
        });

        $('.add-performer-to-lineup').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performer-lineup/create?id=' + id);
            return false;
        });

        $('.edit-performer-lineup').live('click', function() {
            id = $(this).attr('data-id');
            DbEtreeOrg.createModal('/performer-lineup/edit?id=' + id);
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