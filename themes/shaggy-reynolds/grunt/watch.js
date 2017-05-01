module.exports = function () {
  "use strict";

  return {
    options: {
			'livereload': true,
    },
		sass: {
			files: ['<%= config.source.sass %>/**/*.scss', '<%= config.source.sass %>/**.scss'],
			tasks: ['sass:all', 'cssmin', 'notify:watch']
		},
    // watch html files, only used for live reload
    html: {
      files: ['<%= config.source.template %>/pages/*','<%= config.source.template %>/layouts/*', '<%= config.source.template %>/partials/**/*','<%= config.source.template %>/data/*'],
      tasks: [ 'assemble', 'notify:watch' ]
    },
    php: {
      files: ['<%= config.source.templates %>/**/**.php'],
      tasks: [ 'copy', 'notify:watch' ]
    },
    typescript: {
      files: ['<%= config.source.typescript %>/**/*.ts'],
      tasks: ['newer:typescript:base', 'notify:watch']
    }
  };
};
