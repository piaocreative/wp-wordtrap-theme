'use strict'

const path = require('path');
const { babel } = require('@rollup/plugin-babel');
const { nodeResolve } = require('@rollup/plugin-node-resolve');
const replace = require('@rollup/plugin-replace');
const pkg = require('../../package.json');

import commonjs from '@rollup/plugin-commonjs';
import multi from '@rollup/plugin-multi-entry';

const year = new Date().getFullYear();
const pluginFilename = '';

export default {
  input: [
    path.resolve(__dirname, '../js/bootstrap.js'), 
    path.resolve(__dirname, '../js/tiny-slider.js'), 
    path.resolve(__dirname, '../js/skip-link-focus-fix.js'),
    
    path.resolve(__dirname, '../js/theme.js')
  ],
  output: {
    banner: `/*!
      * Wordtrap${pluginFilename ? ` ${pluginFilename}` : ''} v${pkg.version} (${pkg.homepage})
      * Copyright 2022-${year} ${pkg.author}
      * Licensed under GPL (http://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
    */`,
    file: path.resolve(__dirname, `../../js/theme.js`),
    format: 'umd',
    name: 'wordtrap',
    globals: {
      jquery: 'jQuery',
    }
  },
  external: ['jQuery'],
  plugins: [
    babel({
      // Only transpile our source code
      exclude: 'node_modules/**',
      // Include the helpers in the bundle, at most one copy of each
      babelHelpers: 'bundled'
    }),
    replace({
        'process.env.NODE_ENV': '"production"',
        preventAssignment: true
    }),
    nodeResolve(),
    commonjs(),
    multi()
  ]
}