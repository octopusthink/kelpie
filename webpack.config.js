const devMode = process.env.NODE_ENV !== 'production';

const path = require('path');
const globImporter = require('node-sass-glob-importer');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const WebpackRTLPlugin = require('webpack-rtl-plugin');

const THEME_NAME = 'kelpie';

module.exports = [
	{
		devtool: devMode ? 'source-map' : 'cheap-eval-source-map',
		entry: {
			// './src/js/index.js',
			style: `./themes/${THEME_NAME}/assets/scss/style.scss`,
		},
		output: {
			filename: '[name].css',
			path: path.join(__dirname, 'themes', THEME_NAME),
			chunkFilename: '[name]-[chunkhash].css',
			// publicPath: '',
		},
		module: {
			rules: [
				// {
				// 	test: /\.js$/,
				// 	exclude: /node_modules/,
				// 	use: {
				// 		loader: 'babel-loader'
				// 	}
				// },
				{
					test: /\.css$/,
					use: ['style-loader', 'css-loader'],
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
			new MiniCssExtractPlugin(),
			new WebpackRTLPlugin({
				diffOnly: true,
				filename: 'style-rtl.css',
				options: {
					options: {
						autoRename: false,
						autoRenameStrict: false,
						blacklist: {},
						clean: true,
						greedy: false,
						processUrls: false,
						stringMap: [],
					},
					plugins: [],
					map: false,
				},
			}),
		],
		watch: devMode,
	},
];
