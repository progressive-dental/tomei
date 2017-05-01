module.exports = function () {
  "use strict";

  return {
    options: {
      beautify: false,
      mangle: false,
      compress: {
        sequences: true,
        dead_code: true,
        conditionals: true,
        booleans: true,
        unused: true,
        if_return: true,
        join_vars: true,
        drop_console: true
      }
    },
    min: {
      files: {
        '<%= config.destination.js %>/site.min.js': [
          '<%= config.destination.js %>/vendor.js', 
          // '<%= config.destination.js %>/jquery.event.move.js', 
          '<%= config.destination.js %>/jquery.twentytwenty.js', 
          '<%= config.destination.js %>/jquery.countTo.js', 
          '<%= config.destination.js %>/jquery.magnific-popup.js',
          '<%= config.destination.js %>/jquery.matchHeight.min.js',
          '<%= config.destination.js %>/jquery.accordion.min.js',
          '<%= config.destination.js %>/jquery.appear.js',
          '<%= config.destination.js %>/owl.carousel.min.js',
          '<%= config.destination.js %>/plyr.min.js',
          '<%= config.destination.js %>/test.js',
          '<%= config.destination.js %>/vhparallax.js',
          '<%= config.destination.js %>/custom.js',
          '<%= config.destination.js %>/jquery.form.min.js',
          '<%= config.destination.js %>/contact-form-7.js'
        ]
      }
    }
  };
};