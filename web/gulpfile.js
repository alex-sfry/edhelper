import gulp from 'gulp';
import plumber from 'gulp-plumber';
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
import autoprefixer from 'autoprefixer';
import sourcemaps from 'gulp-sourcemaps';
import cssnano from 'cssnano';
import postcss from 'gulp-postcss';
import purgecss from 'gulp-purgecss';
import postcssNested from 'postcss-nested';
import webpack from 'webpack-stream';
import wpConfig from './webpack.config.js';
import wpCompiler from 'webpack';
import { deleteAsync } from 'del';

const dest = {
    root: './dist/',
    css: './dist/css/',
    js: './dist/js/',
    cssDev: './src/css/',
};
const src = {
    js: './src/js/main.js',
    scss: './src/scss/style.scss',
    scssBs: './src/bootstrapSCSS/bootstrap.scss',
    purgecss: ['./src/css/bootstrap.css', './src/css/style.css'],
    content: [
        './src/**/*.html',
        './src/**/*.js',
        '../views/**/*.php',
        '../vendor/yiisoft/yii2-bootstrap5/src/Nav.php',
        '../vendor/yiisoft/yii2-bootstrap5/src/NavBar.php',
        '../vendor/yiisoft/yii2-bootstrap5/src/ActiveForm.php',
        '../vendor/yiisoft/yii2-bootstrap5/src/ActiveField.php',
        '../vendor/yiisoft/yii2/helpers/**/*.php',
        '../vendor/yiisoft/yii2/widgets/**/*.php',
        '../vendor/yiisoft/yii2/assets/**/*.js',
        './src/**/*.js'
    ]
}

const sass = gulpSass(dartSass);

export const clean = async () => {
    await deleteAsync(['dist/**']);
}

export const moveJs = () => {
    return gulp.src('./src/js/*.min.js')
        .pipe(gulp.dest(dest.js))
}

export const moveCss = () => {
    return gulp.src('./src/css/*.css', { ignore: './src/css/style.css' })
        .pipe(gulp.dest(dest.css))
}

export const moveFonts = () => {
    return gulp.src('./src/fonts/**', { encoding: false })
        .pipe(gulp.dest(`${dest.root}fonts/`))
}

export const moveImages = () => {
    return gulp.src('./src/images/**', { encoding: false })
        .pipe(gulp.dest(`${dest.root}images/`))
}

export const scssBs = () => {
    return gulp.src(src.scssBs)
        .pipe(plumber())
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(dest.cssDev));
};

export const scss = () => {
    return gulp.src(src.scss)
        .pipe(plumber())
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(dest.cssDev));
};

export const wp = () => {
    return gulp.src(src.js)
        .pipe(plumber())
        .pipe(webpack(wpConfig, wpCompiler))
        .pipe(gulp.dest(dest.js));
};

export const postCss = () => {
    const plugins = [
        autoprefixer(),
        postcssNested(),
        cssnano({ preset: ['default', { discardComments: { removeAll: true } }] }),
    ];
    return gulp.src(src.purgecss)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(postcss(plugins))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(dest.css));
};

export const postCssPurge = () => {
    const plugins = [
        autoprefixer(),
        postcssNested(),
        cssnano({ preset: ['default', { discardComments: { removeAll: true } }] }),
    ];
    return gulp.src(src.purgecss)
        .pipe(plumber())
        .pipe(purgecss({
            content: src.content,
            variables: false,
            safelist: ['tooltip', 'tooltip-arrow', 'bs-tooltip-auto', 'tooltip-inner']
        }))
        .pipe(sourcemaps.init())
        .pipe(postcss(plugins))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(dest.css));
};

export const watch = () => {
    gulp.watch('./src/bootstrapSCSS/*', scssBs);
    gulp.watch('./src/scss/*', scss);
};

export const devBs = gulp.series(gulp.parallel(scss, scssBs), watch);
export const move = gulp.parallel(moveJs, moveCss, moveFonts, moveImages,);
export const build = gulp.series(clean, gulp.parallel(move, wp, postCss));
export const buildPurge = gulp.series(clean, gulp.parallel(move, wp, postCssPurge));

export default devBs;
