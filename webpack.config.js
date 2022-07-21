const path = require('path');
const isProduction = process.env.NODE_ENV === 'production';

const stylesHandler = 'style-loader';

const config  = {
  entry: './src/App/templates/js/technobureau.js',
  output: {
    path: path.resolve(__dirname, './public/js'),
    filename: 'technobureau.js',
    clean: true,
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/i,
        loader: 'babel-loader',
      },
      // {
      //   test: /\.scss$/i,
      //   include: path.resolve(__dirname, 'src/App/templates/sass/'),
      //   use: [stylesHandler, 'css-loader', 'postcss-loader'],
      // },
      {
        test: /\.(eot|svg|ttf|woff|woff2|png|jpg|gif)$/i,
        type: 'asset',
      },
    ],
  },
};

module.exports = () => {
  if (isProduction) {
    config.mode = 'production';
  } else {
    config.mode = 'development';
  }
  return config;
};