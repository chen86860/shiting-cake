// var gulp = require('gulp');
// var browserSync = require('browser-sync').create();

// // 使用默认任务启动Browsersync，监听JS文件
// gulp.task('default', function () {

//   // 从这个项目的根目录启动服务器
//   browserSync.init({
//     server: {
//       baseDir: "./"
//     },
//     notify: false,
//     browser: "chrome"
//   });
//   // 添加 browserSync.reload 到任务队列里
//   // 所有的浏览器重载后任务完成。
//   gulp.watch("HTML/*.html").on('change', browserSync.reload);
// });

// let gulp = require('gulp')
// let bs = require('browser-sync').create()

// gulp.task('default', function () {
//   bs.init({
//     server: {
//       baseDir: './'
//     }
//   })

//   gulp.watch(['HTML/*.html']).on('change', bs.reload)
// })

var gulp = require('gulp')
var bs = require('browser-sync').create()

module.exports = gulp.task('default', () => {
  bs.init({
    server: {
      baseDir: './'
    }
  })

  gulp.watch(['HTML/*.html','Cake/*.html','*.html','HTML/design/*.html']).on('change', bs.reload)
})