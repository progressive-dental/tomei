module.exports = function () {
	"use strict";

	return {
		all: {
			dest: {
				js: '<%= config.html %>/<%= config.destination.js %>/vendor.js',
				css: '<%= config.html %>/<%= config.destination.css %>/vendor.css'
			},
			mainFiles: {
				'twentytwenty': ['js/jquery.twentytwenty.js','css/twentytwenty.css'],
			},
			include: [
				'jquery',
        'webfontloader',
        'slick-carousel',
        'magnific-popup',
        'jQuery.mmenu',
        'jquery.easy-pie-chart',
        'jquery-countTo',
        'waypoints',
        'twentytwenty',
        'jquery.event.move',
        'matchHeight'
			],
			includeDev: true
		}
	}
}
