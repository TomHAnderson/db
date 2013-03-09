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
        $('a#brand').on('turnOn', function(event) {
            setCookie('editMode', 'on');
            $(this).removeClass('btn-default').addClass('btn-warning');
            $('a.btn-warning, a.btn-danger, a.btn-success, li#menu-audit').show();
        });

        $('a#brand').on('turnOff', function(event) {
            setCookie('editMode', false);
            $(this).removeClass('btn-warning').addClass('btn-default');
            $('a.btn-warning, a.btn-danger, a.btn-success, li#menu-audit').hide();
        });

        $('a#brand').on('click', function(event) {
            if ($(this).hasClass('btn-default')) {
                $(this).trigger('turnOn');
            } else {
                $(this).trigger('turnOff');
            }
            $(this).show();

            return false;
        });

        if (getCookie('editMode') == 'on') {
            $('a#brand').trigger('turnOn');
        } else {
            $('a#brand').trigger('turnOff');
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