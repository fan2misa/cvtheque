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
        watch: {
            styles: {
                files: [
                    'assets/scss/main.scss',
                    'assets/scss/**/*.scss'
                ],
                tasks: ['sass'],
                options: {
                    nospawn: true
                }
            }
        }
    });

    grunt.registerTask('default', ['sass']);
    grunt.registerTask('dev', ['sass', 'watch']);
};
