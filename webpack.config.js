const BundleAnalyzerPlugin = require( 'webpack-bundle-analyzer' ).BundleAnalyzerPlugin;
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const NODE_ENV = process.env.NODE_ENV || 'development';
const ANALYZER = 'true' === process.env.NODE_ANALYZER ? true : false;
const glob = require( 'glob' );
const path = require( 'path' );

module.exports = [
	{

		// ANIMATION
		...defaultConfig,
		stats: 'minimal',
		mode: NODE_ENV,
		entry: {
			index: './src/animation/index.js',
			frontend: './src/animation/frontend.js',
		},
		output: {
			path: path.resolve( __dirname, './inc/blocks/supports/animation/build' )
		},
		plugins: [
			...defaultConfig.plugins,
			new BundleAnalyzerPlugin({
				analyzerMode: 'disabled',
				generateStatsFile: ANALYZER
			})
		]
	},	
];