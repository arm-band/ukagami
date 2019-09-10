/**
 * gulp task
 *
 * @author    アルム＝バンド
 * @copyright Copyright (c) アルム＝バンド
 */
/* require
*************************************** */
const _         = require('./gulp/plugin')

/* requireDri Execution
*************************************** */
_.requireDir('./tasks', { recurse: true })

_.gulp.task('build', _.gulp.parallel('scss', 'js', 'imagemin'))

//gulpのデフォルトタスクで諸々を動かす
_.gulp.task('default', _.gulp.series('build'))