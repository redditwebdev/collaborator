(function() {

  'use strict';

  angular
    .module('project', ['hc.marked'])

      .config(['markedProvider', function (markedProvider) {
        markedProvider.setOptions({
          gfm: true,
          sanitize: true
        });
      }]);;

})();
