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
        $('a#brand.btn').on('click', function(event) {
            if ($(this).hasClass('btn-default')) {
                setCookie('editMode', 'on');
                $(this).removeClass('btn-default').addClass('btn-warning');
                $('a.btn-warning, a.btn-danger, a.btn-success').show();
            } else {
                setCookie('editMode', false);
                $(this).removeClass('btn-warning').addClass('btn-default');
                $('a.btn-warning, a.btn-danger, a.btn-success').hide();
            }
            $(this).show();

            return false;
        });

        if (getCookie('editMode') == 'on') {
            $('a#brand.btn').trigger('click');
        } else {
            $('a.btn-warning, a.btn-danger, a.btn-success').hide();
        }

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