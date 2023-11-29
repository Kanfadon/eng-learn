const path = require('path');

module.exports = {
    mode: 'none',
    entry: {
        index: path.join(__dirname, 'src', 'index.tsx')
    },
    target: 'web',
    mode: 'development',
    resolve: {
        extensions: ['.ts', '.tsx', '.js']
    },
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                use: 'ts-loader',
                exclude: '/node_modules/'
            }
        ],
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, 'dist')
    },
    externals: {
        'react': 'React',
        'react-dom': 'ReactDOM'
    },
    devServer: {
        static: './dist',
        hot: true
    }
}