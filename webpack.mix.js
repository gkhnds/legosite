let mix = require('laravel-mix');

    mix.styles(

    [
        'resources/lego/css/lego.css',
        'resources/css/bootstrap.css','resources/css/font-awesome-all.css',
        'resources/css/flaticon.css',
        'resources/css/owl.css',
        'resources/css/jquery.fancybox.min.css',
        'resources/css/animate.css',
        'resources/css/nice-select.css',
        'resources/css/rtl.css',
        'resources/css/color.css',
        'resources/css/style.css',
        'resources/css/responsive.css',
        'resources/css/swiper.css'
    ], 'public/css/app.min.css').version();

    mix.scripts([
        'resources/lego/js/jquery12_4.js',
        'resources/lego/js/sweetalert2.js',
        'resources/js/popper.js',
        'resources/js/bootstrap.js',
        'resources/js/swiper.js',
        'resources/js/lazyload.js',
        'resources/js/jquery.nice-select.js',
        'resources/js/jquery-ui.js',
        'resources/js/jquery.bootstrap-touchspin.js',
        'resources/js/owl.js',
        'resources/js/wow.js',
        'resources/js/validation.js',
        'resources/js/jquery.fancybox.js',
        'resources/js/appear.js',
        'resources/js/scrollbar.js',
        'resources/js/master.js',
        'resources/js/isotope.js',
        'resources/js/script.js',
        'resources/lego/js/lego.js',
    ], 'public/js/app.min.js').version();



