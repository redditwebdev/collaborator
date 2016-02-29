(function() {

  'use strict';

  angular
    .module('project')
    .controller('NewProjectController', NewProjectController);

  NewProjectController.$inject = ['$http'];

  function NewProjectController($http) {
    var vm = this;

    vm.repos = [];

    vm.repoId = '';

    vm.model = {};

    vm.errors = [];

    vm.getRepos = function() {
      $http.get('/api/v1/me/repos')
        .then(function(res) {
          vm.repos = res.data;
        });
    }

    vm.selectRepo = function() {
      var temp = {};
      for (var i = 0; i < vm.repos.length; i++) {
        if (vm.repoId == vm.repos[i].id) {
          temp = vm.repos[i];
          break;
        }
      }

      vm.model = {
        repo_name: temp.name,
        repo_owner: temp.owner.login,
        name: vm.model.name ? vm.model.name : temp.name
      }
    }

    vm.submit = function() {
      vm.model.description = vm.description;

      $http.post('/api/v1/projects/new')
        .then(function(res) {
          if (response.data.status == 'success') {
            window.location.href = '/project/' + response.data.slug;
          } else {
            vm.errors = response.data.errors;
          }
        });
    }
  }

})();
