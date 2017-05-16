module.exports = function () {
  'use strict';

  return {
    options: {
      sourceMap: true,
      presets: ['es2016']
    },
    dist: {
      files: {
        '<%= config.html %>/<%= config.destination.js %>/site.js': ['<%= config.source.js %>/site.js']
      }
    }
  }
}