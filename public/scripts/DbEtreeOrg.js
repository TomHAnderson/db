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
    },

    createModal: function(page) {
        modal = $('<span class="modal fade"></span>')
            .appendTo('body')
            .load(page, function() {
                $(modal).modal();
            });
    }
}