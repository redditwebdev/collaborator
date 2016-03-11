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

      vm.model.repo_name = temp.name;
      vm.model.repo_owner = temp.owner.login;
      vm.model.name = vm.model.name ? vm.model.name : temp.name;
    }

    vm.submit = function() {
      $http.post('/api/v1/projects/new', vm.model)
        .then(function(response) {
          if (response.data.status == 'success') {
            window.location.href = '/project/' + vm.model.repo_owner + '/' + vm.model.repo_name;
          } else {
            vm.errors = response.data.errors;
          }
        });
    }
  }

  jQuery('#s2_tags').select2({
    tags: true,
    maximumSelectionLength: 3,
    tokenSeparators: [',', ' ']
  });

})();
