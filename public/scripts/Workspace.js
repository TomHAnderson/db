Workspace = {
    settings: {

    },

    init: function() {
        s = this.settings;
        this.bindUIActions();
    },

    bindUIActions: function() {
        $('.workspace-revision-edit-comment').live('click', function() {
            id = $(this).attr('data-id');
            Workspace.createModal('/workspace/revision/comment/edit/' + id);
            return false;
        });

        $('.workspace-revision-submit-for-approval').live('click', function() {
            id = $(this).attr('data-id');
            Workspace.createModal('/workspace/revision/approve/submit/' + id);
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