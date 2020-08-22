const { watch, src, dest, series, task } = require('gulp');
const uglify = require('gulp-uglifyjs');
const sass = require('gulp-sass');
const wait = require('gulp-wait');
const replace = require('gulp-replace');
const changed = require('gulp-changed');
const autoprefixer = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const merge = require('merge-stream');
const imagemin = require('gulp-imagemin');
const pngquant = require('imagemin-pngquant');
const jpegtran = require('imagemin-jpegtran');
const config = require('./config.json');

const THEME_SLUG = config.general.themeSlug;
const THEME_FOLDER_NAME = './' + THEME_SLUG;
const THEME_SERVER_FOLDER = config.general.themeServerFolder + THEME_SLUG;

console.log(THEME_SLUG, THEME_SERVER_FOLDER);

function imageminTask(cb) {
    const SOURCE = THEME_FOLDER_NAME + '/assets/images/**/*';
    const DESTINATION = THEME_SERVER_FOLDER + '/assets/images';
    return src(SOURCE)
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant(),jpegtran()]
        }))
        .pipe(dest(DESTINATION));
    cb();
}

function imageOptimiser(cb) {
    const SOURCE = './image-optimiser/in/**/*';
    const DESTINATION = './image-optimiser/out/';
    return src(SOURCE)
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant(),jpegtran()]
        }))
        .pipe(dest(DESTINATION));
    cb();
}

function sassTask(cb) {
    return src(THEME_FOLDER_NAME + '/assets/sass/*.scss')
        .pipe(wait(200))
        .pipe(sourcemaps.init())
            .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
            .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(sourcemaps.write('./'))
        .pipe(dest(THEME_SERVER_FOLDER + '/assets/css'));
    cb();
}

function mainVersionUpdate(cb) {
    var cbString = new Date().getTime();
    return src(THEME_FOLDER_NAME + '/functions.php')
        .pipe(
            replace(/cacheNumber = '\d+/g, function() {
                return "cacheNumber = '" + cbString;
            })
        )
        .pipe(dest(THEME_FOLDER_NAME + '/'));
    cb();
}

function uglifyTask(cb) {
    return src(THEME_FOLDER_NAME + '/assets/js/*.js')
        .pipe(uglify(THEME_SLUG + '.min.js'))
        .pipe(dest(THEME_SERVER_FOLDER + '/assets/js'));
    cb();
}

function rootFiles(cb) {
    const SOURCE = THEME_FOLDER_NAME + '/*.{css,php,png}';
    const DESTINATION = THEME_SERVER_FOLDER;
    return src(SOURCE)
        .pipe(changed(DESTINATION))
        .pipe(dest(DESTINATION));
    cb();
}

var additional_assets = ['php','fonts'];
function additionalAssets(cb) {
    var tasks = additional_assets.map(function(folder){
        const SOURCE = THEME_FOLDER_NAME + '/assets/' + folder + '/**/*';
        const DESTINATION = THEME_SERVER_FOLDER + '/assets/' + folder;
        return src(SOURCE)
            .pipe(changed(DESTINATION))
            .pipe(dest(DESTINATION));
    });
    return merge(tasks);
    cb();
}

exports.default = function() {
    watch(THEME_FOLDER_NAME + '/assets/sass/**/*.scss', series(sassTask, mainVersionUpdate));
    watch(THEME_FOLDER_NAME + '/assets/js/**/*.js', uglifyTask);
    watch(THEME_FOLDER_NAME + '/*.{css,php,png}', rootFiles);
    watch(THEME_FOLDER_NAME + '/assets/images/**/*', imageminTask);
    watch(THEME_FOLDER_NAME + '/assets/php/*', additionalAssets);
};

exports.images = imageminTask;
exports.mainVersionUpdate = mainVersionUpdate;
exports.imageOptimiser = imageOptimiser;
exports.build = series(rootFiles, sassTask, mainVersionUpdate, uglifyTask, imageminTask, additionalAssets);
exports.sass = series(sassTask, mainVersionUpdate);
