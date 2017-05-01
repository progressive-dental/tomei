module.exports = function () {
  "use strict";

  return {
    php: {
      expand: true,
      cwd: '<%= config.source.templates %>',
      src: '**',
      dest: "<%= config.destination.templates %>"
    }
  }
}