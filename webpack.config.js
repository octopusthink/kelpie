const devMode = process.env.NODE_ENV !== 'production';

const path = require('path');
const globImporter = require('node-sass-glob-importer');
const LiveReloadPlugin = require('webpack-livereload-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
// const WebpackRTLPlugin = require('webpack-rtl-plugin');
const WordPressDependencyExtractionWebpackPlugin = require('@wordpress/dependency-extraction-webpack-plugin');

const THEME_NAME = 'kelpie';

const webpackConfig = {
	devtool: devMode ? 'source-map' : 'none',
	entry: {
		'assets/js/editor': `./themes/${THEME_NAME}/js/editor.js`,
		'assets/js/frontend': `./themes/${THEME_NAME}/js/frontend.js`,
		style: `./themes/${THEME_NAME}/sass/style.scss`,
		'assets/css/style-editor': `./themes/${THEME_NAME}/sass/style-editor.scss`,
	},
	output: {
		filename: '[name].js',
		path: path.join(__dirname, 'themes', THEME_NAME),
		chunkFilename: '[name]-[chunkhash].js',
		// publicPath: '',
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
				},
			},
			{
				test: /\.css$/,
				use: [MiniCssExtractPlugin.loader, 'style-loader', 'css-loader'],
			},
			{
				test: /\.scss$/,
				use: [
					// devMode ? 'style-loader' : MiniCssExtractPlugin.loader,
					MiniCssExtractPlugin.loader,
					{
						loader: 'css-loader',
					},
					{
						loader: 'postcss-loader',
					},
					{
						loader: 'sass-loader',
						options: {
							sassOptions: { importer: globImporter() },
						},
					},
				],
			},
		],
	},
	plugins: [
		new WordPressDependencyExtractionWebpackPlugin({ injectPolyfill: false }),
		new MiniCssExtractPlugin({
			filename: '[name].css',
		}),
		// new WebpackRTLPlugin({
		// 	diffOnly: true,
		// 	filename: 'assets/style-rtl.css',
		// 	options: {
		// 		options: {
		// 			autoRename: false,
		// 			autoRenameStrict: false,
		// 			blacklist: {},
		// 			clean: true,
		// 			greedy: false,
		// 			processUrls: false,
		// 			stringMap: [],
		// 		},
		// 		plugins: [],
		// 		map: false,
		// 	},
		// }),
	],
	watch: devMode,
};

if (devMode) {
	webpackConfig.plugins.push(new LiveReloadPlugin({ delay: 20 }));
}

module.exports = webpackConfig;
