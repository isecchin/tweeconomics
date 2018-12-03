var Inputs = $.extend(Inputs || {}, {

    selectors: {
        select2           : 'select.select2',
        neighborhoodSelect: 'select.company-picker'
    },

    classes: {
    },

    init: function() {
        this.initializeSelect2();

        this.registerEvents();
    },

    registerEvents: function() {
        this.registerChangeNeighborhood();
    },

    initializeSelect2: function() {
        $(this.selectors.select2).each(function() {
            $(this).select2({
                placeholder: $(this).attr('placeholder')
            });
        })
    },

    registerChangeNeighborhood: function() {
        $(this.selectors.neighborhoodSelect).on('select2:select', function() {
            window.location.href = $(this).val();
        });
    }
});

