//path difinition
module.exports = {
    assets: {
        jquery     : './node_modules/jquery/dist',
        easing     : './node_modules/jquery.easing',
        bootstrap  : './node_modules/bootstrap-honoka/dist/js',
        bowser     : './node_modules/bowser',
        lightbox   : './node_modules/lightbox2/dist',
        slick      : './node_modules/slick-carousel/slick'
    },
    src: {
        ejs        : './viewsrc/ejs',
        scss       : './viewsrc/scss',
        assets     : '/assets',
        js         : './viewsrc/js',
        img        : './viewsrc/img',
        favicon    : './viewsrc/favicon'
    },
    config: {
        dir        : './bin/config',
        config     : '/config.yml',
        commonvar  : '/commonvar.yml',
        plugins    : '/plugins.yml',
        ftpconfig  : '/ftpconfig.yml',
        hachizetsu : '/subterranean/hachizetsu.yml',
        ftp        : '/subterranean/ftp.yml'
    },
    contents: {
        dir        : './viewsrc/contents'
    },
    plugins: {
        ejs        : './viewsrc/ejs/_plugins',
        scss       : './viewsrc/scss/_plugins',
        js         : './viewsrc/js/_plugins'
    },
    dist: {
        html       : './public',
        news       : './public/news',
        articles   : './public/news/articles',
        css        : './public/css',
        js         : './public/js',
        img        : './public/img'
    },
    admin: {
        dir        : './bin/daishi',
        scss       : '/src/scss',
        js         : '/src/js',
        views      : '/views',
        css        : '/dist/public/css',
        distjs     : '/dist/public/js'
    }
}