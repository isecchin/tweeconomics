var Tweeconomics = $.extend(Tweeconomics || {}, {

    selectors: {
        csrfToken   : 'meta[name="csrf-token"]',
        tooltip     : '.has-tooltip'
    },

    classes: {
    },

    init: function() {
        Inputs.init();
        this.setup();
    },

    setup: function() {
        this.setupCSRF();
        this.setupTooltips();

        this.registerEvents();
    },

    setupCSRF: function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $(this.selectors.csrfToken).attr('content')
            }
        });
    },

    setupTooltips: function() {
        $(this.selectors.tooltip).tooltip({
            trigger : 'hover'
        });
    },

    registerEvents: function() {
    }
});
