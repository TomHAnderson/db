Menu = {
    settings: {

    },

    init: function() {
        s = this.settings;
        this.bindUIActions();
        this.refresh();
    },

    bindUIActions: function()
    {
    },

    refresh: function()
    {
        $.ajax({
            url: '/index/menu',
            success: function(data) {
                $('#menu').html(data);
            },
            dataType: 'html'
        });
    }
}