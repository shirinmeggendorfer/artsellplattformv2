const path = require('path');

module.exports = {
  mode: 'development',
  entry: './resources/ts/app.ts', // Der Einstiegspunkt für Ihre Anwendung
  module: {
    rules: [
      {
        test: /\.tsx?$/,
        use: 'ts-loader',
        exclude: /node_modules/,
      },
    ],
  },
  resolve: {
    extensions: ['.tsx', '.ts', '.js'],
  },
  output: {
    filename: 'app.js',
    path: path.resolve(__dirname, 'public/js'),
  },
};
