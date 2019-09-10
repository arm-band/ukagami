module.exports = {
    gulp:  require('gulp'),
    watch: require('gulp-watch'),
    plumber: require('gulp-plumber'),
    notify: require('gulp-notify'),
    requireDir: require('require-dir'),
    yaml: require('yaml'),
    sass:  require('gulp-sass'),
    autoprefixer: require('gulp-autoprefixer'),
    imagemin: require('gulp-imagemin'),
    uglify: require('gulp-uglify-es').default,
    concat: require('gulp-concat'),
    rename: require('gulp-rename'),
    fs: require('fs')
}