var Dashboard = $.extend(Dashboard || {}, {

    selectors: {
        chart        : '#chart-div',
        chartLoading : '.chart-loading',
        totals       : '.totals',
        initialDate  : '.data-since-value',
        totalPositive: '#total-positive',
        totalNeutral : '#total-neutral',
        totalNegative: '#total-negative',
        navLink      : '.nav-link',
        graphDaily   : '.graph-daily',
        graphWeekly  : '.graph-weekly',
        graphMonthly : '.graph-monthly',
        graphYearly  : '.graph-yearly',
        pushMenu     : '.push-menu',
        csrfToken    : 'meta[name="csrf-token"]',
        companyInput : 'input[name="company"]'
    },

    data: [],

    templates: {
        chartLoading: '<i class="fas fa-spinner fa-spin fa-5x chart-loading"></i>'
    },

    init: function() {
        this.loadTotals();
        this.loadInitialDate();
        this.loadGoogleCharts();
        this.loadData();

        this.registerEvents();
    },

    registerEvents: function() {
        this.registerClickDaily();
        this.registerClickWeekly();
        this.registerClickMonthly();
        this.registerClickYearly();

        this.registerWindowResize();
    },

    loadTotals: function() {
        var self = this;

        $.ajax({
            type: 'POST',
            data: {
                companyId: $(self.selectors.companyInput).val(),
                _token   : $(self.selectors.csrfToken).attr('content')
            },
            url: '/ajax/get_total_tweets',
            success: function(response) {
                $(self.selectors.totalPositive).html(
                    response.data.positive
                );
                $(self.selectors.totalNeutral).html(
                    response.data.neutral
                );
                $(self.selectors.totalNegative).html(
                    response.data.negative
                );
            }
        });
    },

    loadInitialDate: function() {
        var self = this;

        $.ajax({
            type: 'POST',
            data: {
                _token : $(self.selectors.csrfToken).attr('content')
            },
            url: '/ajax/get_initial_date',
            success: function(response) {
                $(self.selectors.initialDate).html(
                    response.data.date
                );
            }
        });
    },

    loadData: function() {
        this.renderDailyData();
    },

    renderDailyData: function() {
        this.renderData('/ajax/get_daily_data');
    },

    renderWeeklyData: function() {
        this.renderData('/ajax/get_weekly_data');
    },

    renderMonthlyData: function() {
        this.renderData('/ajax/get_monthly_data');
    },

    renderYearlyData: function() {
        this.renderData('/ajax/get_yearly_data');
    },

    renderData: function(url) {
        var self = this;

        $.ajax({
            type: 'POST',
            data: {
                companyId: $(self.selectors.companyInput).val(),
                _token   : $(self.selectors.csrfToken).attr('content')
            },
            url: url,
            success: function(response) {
                self.data = response.data;
                self.loadTweetsChart();
            }
        });
    },

    loadGoogleCharts: function() {
        google.charts.load(
            'current',
            {packages: ['line']}
        );
    },

    loadTweetsChart: function() {
        google.charts.setOnLoadCallback(Dashboard.drawTweetsChart);
    },

    drawTweetsChart: function() {
        var data = new google.visualization.DataTable();

        data.addColumn('datetime', Lang.get('dashboard.time'));
        data.addColumn('number',   Lang.get('sentiment.negative'));
        data.addColumn('number',   Lang.get('sentiment.neutral'));
        data.addColumn('number',   Lang.get('sentiment.positive'));

        $.each(Dashboard.data, function(key, row) {
            data.addRow([
                new Date(row.date),
                row.negative,
                row.neutral,
                row.positive
            ]);
        });

        var options = {
            colors: ['#dc3545', '#17a2b8', '#28a745']
        };

        var chart = new google.charts.Line(document.getElementById('chart-div'));
        chart.draw(data, options);
    },

    displayData: function() {
        var self = this;

        setTimeout(function() {
            $(self.selectors.totalLoading).hide("slow");
            setTimeout(function() {
                self.loadTotals();
                $(self.selectors.totals).show("slow");
            }, 200);
        }, 500);

        setTimeout(function() {
            setTimeout(function() {
                self.loadTweetsChart();
            }, 200);
        }, 500);
    },

    registerClickDaily: function() {
        var self = this;

        $(self.selectors.graphDaily).on('click', function(event) {
            event.preventDefault();

            $(self.selectors.navLink).removeClass('active');
            $(this).addClass('active');
            $(self.selectors.chart).html(self.templates.chartLoading);

            self.renderDailyData();
        });
    },

    registerClickWeekly: function() {
        var self = this;

        $(self.selectors.graphWeekly).on('click', function(event) {
            event.preventDefault();

            $(self.selectors.navLink).removeClass('active');
            $(this).addClass('active');
            $(self.selectors.chart).html(self.templates.chartLoading);

            self.renderWeeklyData();
        });
    },

    registerClickMonthly: function() {
        var self = this;

        $(self.selectors.graphMonthly).on('click', function(event) {
            event.preventDefault();

            $(self.selectors.navLink).removeClass('active');
            $(this).addClass('active');
            $(self.selectors.chart).html(self.templates.chartLoading);

            self.renderMonthlyData();
        });
    },

    registerClickYearly: function() {
        var self = this;

        $(self.selectors.graphYearly).on('click', function(event) {
            event.preventDefault();

            $(self.selectors.navLink).removeClass('active');
            $(this).addClass('active');
            $(self.selectors.chart).html(self.templates.chartLoading);

            self.renderYearlyData();
        });
    },

    // https://stackoverflow.com/questions/8950761/google-chart-redraw-scale-on-window-resize
    registerWindowResize: function() {
        var self = this;

        $(window).resize(function() {
            if (this.resizeTO) {
                clearTimeout(this.resizeTO);
            }

            this.resizeTO = setTimeout(function() {
                $(this).trigger('resizeEnd');
            }, 500);
        });

        $(window).on('resizeEnd', function() {
            self.loadTweetsChart();
        });

        $(self.selectors.pushMenu).on('click', function() {
            setTimeout(function() {
                self.loadTweetsChart();
            }, 250);
        });
    }
});

$(document).ready(function() {
    if (Tweeconomics.utils.locationContains('/dashboard')) {
        Dashboard.init();
    }
});
