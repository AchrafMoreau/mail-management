// webpack.config.js
const path = require('path');
const { VueLoaderPlugin } = require('vue-loader');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
  entry: './resources/js/app.js',
  output: {
    filename: 'app.js',
    path: path.resolve(__dirname, 'public/js'),
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
            plugins: ['@babel/plugin-transform-runtime'],
          },
        },
      },
      {
        test: /\.vue$/,
        loader: 'vue-loader',
      },
      {
        test: /\.css$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
        ],
      },
    ],
  },
  resolve: {
    alias: {
      'vue$': 'vue/dist/vue.esm-bundler.js', // Vue 3
    },
    extensions: ['.js', '.vue', '.json'],
  },
  plugins: [
    new VueLoaderPlugin(),
    new MiniCssExtractPlugin({
      filename: 'styles.css',
    }),
  ],
  mode: 'production',
};
