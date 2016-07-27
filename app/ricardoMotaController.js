// Iniciando controller ricardoMotaController com or parametros utilizados em todo seu contexto
app.controller("ricardoMotaController", ['$scope', '$http', '$location', '$window', function($scope, $http, $location, $window) {
    $scope.sortType     = 'contato.contato_id'; // set the default sort type
    $scope.sortReverse  = false;  // set the default sort order

    //Requisição inicial dos contatos
    $http({
        url: "controller/MainController.php",
        method: "GET",
        params: {get_contatos: "get_contatos"}
    }).success(function(data, status, headers, config) {
        $scope.valid = true;
        $scope.response = data;
        console.log(data);
    }).error(function(data, status, headers, config) {
        $scope.valid = false;
    });

    //Requisição de contato único com suas respectivas informações
    $scope.getContact = function(id_contato){
        $http({
            url: "controller/MainController.php",
            method: "GET",
            params: {id_contato: id_contato}
        }).success(function(data, status, headers, config) {
            $scope.valid = true;
            $scope.contato_unico = data;
            console.log(data);
        }).error(function(data, status, headers, config) {
            $scope.valid = false;
        });
    }

    //Adicionar telefones na inserção de novo contato
    $scope.telefones = [{id:1}];
    $scope.addTelefone = function(){
        var tmp =  $scope.telefones[0];
        $scope.telefones.push(tmp) 
    }
    $scope.removeTelefone = function(x) {
        $scope.telefones.splice(x, 1);
    }

    //Adicionar email na inserção de novo contato
    $scope.emails = [{id:1}];
    $scope.addEmail = function(){
        var tmp =  $scope.emails[0];
        $scope.emails.push(tmp) 
    }
    $scope.removeEmail = function(x) {
        $scope.emails.splice(x, 1);
    }


}]);

//Mascara dos telefones
app.filter('tel', function () {
    return function (tel) {
        if (!tel) { return ''; }
        var value = tel.toString().trim().replace(/^\+/, '');
        if (value.match(/[^0-9]/)) {
            return tel;
        }
        var number;
        switch (value.length) {
            case 9:
                number = value.slice(0, 5) + '-' + value.slice(5);
                console.log(number);
                break;
            case 8:
                number = value.slice(0, 4) + '-' + value.slice(4);
                break;
            default:
                return tel;
        }
        return number;
    };
});

//Tirar dados repetidos da listagem única de contato
app.filter('unique', function() {
   return function(collection, keyname) {
      var output = [], 
          keys = [];
      angular.forEach(collection, function(item) {
          var key = item[keyname];
          if(keys.indexOf(key) === -1) {
              keys.push(key);
              output.push(item);
          }
      });
      return output;
   };
});

