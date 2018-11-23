
/**
 * First we will load all of this project's JavaScript dependencies.
 * It is a great starting point when building robust,
 * powerful web applications using Laravel.
 */

require('./bootstrap');
require('admin-lte');
require('select2');
require('stocks.js');
window.moment = require('moment');      // For some reason, the Moment.js needs to be loaded differently

var Tweeconomics = Tweeconomics || {};
