const path = require( "path" );

module.exports = {

  mode: "development",
  entry: "./assets/src/js/index.js",
  output: {

    path: path.resolve( __dirname, "./assets/dist/js" ),
    filename: "bundle.js",

  },

  module: {
    
    // configuration regarding modules
    rules: [
            
      {
   
        test: /\.js?$/,
        exclude: /node_modules/,
        use: {
            
          loader: 'babel-loader',
          options: {

            presets: ['@babel/preset-env']
          
          }
                
        }   
              
      },

    ],

  },


};