// babel.config.js
module.exports = {
    presets: [
      '@babel/preset-env', // Transpile le code ES6+ en code compatible avec les navigateurs plus anciens
      '@babel/preset-react', // Si vous utilisez React, sinon vous pouvez le retirer
    ],
    plugins: [
      '@babel/plugin-transform-runtime', // Réduit la duplication de code et améliore les performances
    ],
  };
  