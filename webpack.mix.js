const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/style.scss', 'public/css/style.css');





    $('.repl').blur(function(e) {
        $(`.${id}.${fieldName}`).replaceWith('<td class="'+id+ ' ' + fieldName +  ' ' + path + '">'+path+'</td>');
      });


      let val = $(this).val();
      var formData = new FormData();
     let files = $(':file').prop('files');
  // Пройти в цикле по всем файлам
  for (var i = 0; i < files.length; i++) {
      // С помощью метода append() добавляем файлы в объект FormData
      formData.append('file_' + i, files[i]);
  }
