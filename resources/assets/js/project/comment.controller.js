(function() {

    'use strict';

    angular
        .module('project')
        .controller('CommentController', CommentController);

    CommentController.$inject = ['$http'];

    function CommentController($http) {
        var vm = this;

        vm.project = {};

        vm.comments = [];

        vm.newComment = "";

        vm.errors = [];

        vm.getComments = function() {
            $http.get('/api/v1/project/' + vm.project.repo_owner + '/' + vm.project.repo_name + '/comments')
                .then(function(response) {
                   vm.comments = response.data;
                });
        }

        vm.submitComment = function() {
            $http.post('/api/v1/project/' + vm.project.repo_owner + '/' + vm.project.repo_name + '/new-comment', {body: vm.newComment})
                .then(function(response) {
                   if (response.data.status == 'error') {
                       vm.errors = response.data.errors;
                   } else {
                       vm.newComment = "";
                       vm.errors = [];
                       vm.getComments();
                   }
                });
        }
    }

})();
