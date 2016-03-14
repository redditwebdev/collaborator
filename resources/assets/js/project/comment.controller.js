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

        vm.getComments = function() {
            console.log(vm.project);
            $http.get('/api/v1/project/' + vm.project.repo_owner + '/' + vm.project.repo_name + '/comments')
                .then(function(response) {
                   vm.comments = response.data;
                });
        }
    }

})();
