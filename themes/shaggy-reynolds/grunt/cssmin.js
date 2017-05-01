module.exports = function () {
	"use strict";

	return {
		options: {
			shorthandCompacting: false,
			roundingPrevision: 1,
			sourceMap: true,
			keepSpecialComments: 0,
			//mode: 'brotoli'
		},
		target: {
			files: {
				'<%= config.destination.css %>/site.min.css': ['<%= config.destination.css %>/owl.carousel.css', '<%= config.destination.css %>/magnific-popup.css', '<%= config.destination.css %>/plyr.min.css', '<%= config.destination.css %>/site.css']
			}
		}
	}
}
