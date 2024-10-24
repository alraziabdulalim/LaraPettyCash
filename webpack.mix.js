let mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css"
);

mix.browserSync({
    proxy: "193.168.0.5:9000",
    host: "193.168.0.5",
    port: 9000,
    open: false,
    notify: false,
    watchOptions: {
        ignored: /node_modules/,
        // poll: 1000, //1000=1seconds
        poll: false,
    },
    // files: [],   // Prevent BrowserSync from watching files
});
