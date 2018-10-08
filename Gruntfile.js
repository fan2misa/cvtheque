module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        sass: {
            development: {
                files: {
                    "public/css/main.css": "assets/scss/main.scss"
                }
            }
        },
        concat: {
            jquery: {
                src: ['node_modules/jquery/dist/jquery.js'],
                dest: 'public/js/jquery.js'
            },
            bootstrap: {
                src: ['node_modules/bootstrap/dist/js/bootstrap.js'],
                dest: 'public/js/bootstrap.js'
            },
            dist: {
                src: [
                    'assets/js/app.js',
                    'assets/js/*.js'
                ],
                dest: 'public/js/main.js'
            }
        },
        uglify: {
            build: {
                src: 'public/js/main.js',
                dest: 'public/js/main.js'
            }
        },
        watch: {
            styles: {
                files: [
                    'assets/scss/main.scss',
                    'assets/scss/**/*.scss'
                ],
                tasks: ['sass'],
                options: {
                    livereload: true,
                    nospawn: true
                }
            }
        }
    });

    grunt.registerTask('default', ['sass', 'concat', 'uglify']);
    grunt.registerTask('watch', ['default', 'watch']);
};
