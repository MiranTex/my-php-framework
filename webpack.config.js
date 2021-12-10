const { VueLoaderPlugin } = require('vue-loader');
const path = require('path');

module.exports = {
    mode: "development",

    entry: './src/index.js',
    output:{
        filename:'build.js',
        path: path.resolve(__dirname+"/public",'js')
    },
    module: {
        rules: [
        // ... other rules
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.css$/,
                use: [
                  'vue-style-loader',
                  'css-loader'
                ]
            },
            {
                test: /\.scss$/,
                use: [
                  'vue-style-loader',
                  'css-loader',
                  'sass-loader'
                ]
              }
        ]
    },
    plugins: [
        // make sure to include the plugin!
        new VueLoaderPlugin()
    ],

    
    resolve: {
        alias: {
            vue: 'vue/dist/vue.js'
        },
    },

    watch:true
}
