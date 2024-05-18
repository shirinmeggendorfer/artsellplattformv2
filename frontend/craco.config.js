// craco.config.js
module.exports = {
    webpack: {
      configure: (webpackConfig, { env, paths }) => {
        webpackConfig.module.rules.push({
          test: /\.m?js$/,
          enforce: 'pre',
          use: ['source-map-loader'],
        });
        webpackConfig.ignoreWarnings = [/Failed to parse source map/];
        return webpackConfig;
      },
    },
  };
  