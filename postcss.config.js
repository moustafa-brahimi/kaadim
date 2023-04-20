module.exports = {

    plugins: [
        require('postcss-import'),
        require('postcss-nested'),
        require('postcss-for'),
        require('postcss-conditionals'),
        require('postcss-easings'),
        require('postcss-random'),
        require('postcss-preset-env'),
        require('postcss-inline-svg'),
        require('autoprefixer'),
        require('cssnano'),
        require('postcss-color-mod-function'),
    ]

}