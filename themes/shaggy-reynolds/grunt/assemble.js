// Assembles your email content with HTML layout
module.exports = {
  options: {
    layoutdir: '<%= config.source.template %>/layouts',
    partials: ['<%= config.source.template %>/partials/**/*.hbs'],
    data: ['<%= config.source.template %>/data/*.{json,yml}'],
    flatten: true
  },
  pages: {
    src: ['<%= config.source.template %>/pages/*.hbs'],
    dest: '<%= config.html %>/'
  }
};