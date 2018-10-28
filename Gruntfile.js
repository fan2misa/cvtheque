'use strict';

module.exports = function (grunt) {

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');

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
                src: ['node_modules/bootstrap/dist/js/bootstrap.bundle.js'],
                dest: 'public/js/bootstrap.js'
            },
            handlebars: {
                src: ['node_modules/handlebars/dist/handlebars.js'],
                dest: 'public/js/handlebars.js'
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
        copy: {
            fontAwesome: {
                files: [
                    {
                        expand: true,
                        cwd: 'node_modules/font-awesome/fonts/',
                        src: ['**/*'],
                        dest: 'public/fonts/'
                    }
                ]
            }
        },
        watch: {
            styles: {
                files: [
                    'assets/scss/main.scss',
                    'assets/scss/**/*.scss',
                    'assets/js/**/*.js'
                ],
                tasks: ['copy', 'sass', 'concat', 'uglify'],
                options: {
                    nospawn: true
                }
            }
        }
    });

    grunt.registerTask('default', ['copy', 'sass', 'concat', 'uglify']);
    grunt.registerTask('dev', ['default', 'watch']);
};
