angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $ionicModal, $timeout, $state, $http,$window) {
$scope.webServiceUrl="http://10.93.170.52:81/staj/proje/";
$scope.user=null;

  $scope.loginData = {};
    $scope.loginData.username="";
      $scope.loginData.password="";


  // Create the login modal that we will use later
  $ionicModal.fromTemplateUrl('templates/login.html', {
    scope: $scope
  }).then(function(modal) {
    $scope.modal = modal;
  });

  $scope.openModal=function(item) {
    if(item =='login'){
      $state.go('app.playlist');
      $scope.modal.show();
    };

  }

  // Triggered in the login modal to close it
  $scope.closeModal = function(item) {
    if (item=='login') {
       $scope.modal.hide();

    }else if (item=='login2kayit') {
      $timeout(function(){
        $scope.closeModal('login');
        $state.go('app.kayitol');
      },200)
  };
}



$scope.doLogin = function() {
    $http.get($scope.webServiceUrl+"giris.php?ad="+$scope.loginData.username+"&sifre="+$scope.loginData.password)
    .then(function (response) {
      if (typeof response.data.errorMessage !=='undefined') {
        alert(response.data.errorMessage);
      }
      else {
        $scope.user=response.data.data[0];
        $scope.closeModal('login');

      }
    });

    };
    $scope.logout=function() {
      $scope.user=null;

     $window.location.href('#/app/anasayfa')
    }
    $scope.geri=function(){

  $state.go ('#/app/search');

    }
})

.controller('PlaylistsCtrl', function($scope) {

 console.log($scope.playlists);

;})
.controller('PlaylistCtrl', function($scope, $stateParams, ) {
})

.controller('DuyuruEkleCtrl', function($scope, $stateParams, ) {

})

.controller('duyuruCtrl', function($scope,$http) {


  $http.get('http://10.93.170.52:81/staj/proje/duyuru.php')
      .success(function(data, status, headers,config){
        console.log('data success');
          $scope.duyuru=data;

      })
      .error(function(data, status, headers,config){
        console.log('data error');
      })




})
.controller('LoginCtrl', function($scope, $stateParams, ) {

})


.controller('FaturaCtrl', function($scope, $http) {
  $http.get('http://10.93.170.52:81/staj/proje/fatura.php')
  .success(function(data, status, headers,config){
    console.log(data);
    console.log('data success');
      $scope.fatura=data;
  // // for browser console
  // for UI
  })
  .error(function(data, status, headers,config){
    console.log('data error');
  })

//there was an error fetching from the server

})


.controller('FaturaEkleCtrl', function($scope, $http,$state) {
  $scope.ftr={};
  $scope.ftr.bilgi="";
  $scope.ftr.faturadonem="";
  $scope.ftr.faturatutar="";
  $scope.ftr.faturasontarih="";


  $scope.faturaeklee=function(){
    var postData=[];
    postData.push(encodeURIComponent("bilgi")+"="+ encodeURIComponent($scope.ftr.bilgi));
    postData.push(encodeURIComponent("faturadonem")+"="+ encodeURIComponent($scope.ftr.faturadonem));
  postData.push(encodeURIComponent("faturatutar")+"="+ encodeURIComponent($scope.ftr.faturatutar));
    postData.push(encodeURIComponent("faturasontarih")+"="+ encodeURIComponent($scope.ftr.faturasontarih));
  var data=postData.join("&");
    //postdata satırlarının aralarına  ve işareti koyarak data olarak hepsini seçtik

    $http({
      method: 'POST',
      url:$scope.webServiceUrl+'faturaekle.php',
      data:data,
      headers:{'Content-Type':'application/x-www-form-urlencoded'}
    }).success(function(data) {
      if (data !="") {
        alert (data);
      }else {
        $scope.f=$scope.ftr;
        $state.go("app.playlists");
        $ionicHistory.clearHistory();//kayıt yaptıktan sonra textlerı boşalt
      }
    }).error(function (data) {
      alert (data);
    })

  }
})

.controller('HesapCtrl',  function($scope,$http) {
  $http.get('http://10.93.170.52:81/staj/proje/gelir.php')
      .success(function(data, status, headers,config){
        console.log('data success');
          $scope.gelir=data;

      })
      .error(function(data, status, headers,config){
        console.log('data error');
      })

      $http.get('http://10.93.170.52:81/staj/proje/gider.php')
          .success(function(data, status, headers,config){
            console.log('data success');
              $scope.gider=data;

          })
          .error(function(data, status, headers,config){
            console.log('data error');
          })
})

.controller('ÖdemelerCtrl', function($scope,$http) {


})
.controller('SikayetekleCtrl', function($scope, $http,$state) {
  $scope.skyt={};
  $scope.skyt.kisi="";
$scope.skyt.konu="";
  $scope.sikayett=function(){
    var postData=[];
    postData.push(encodeURIComponent("kisi")+"="+ encodeURIComponent($scope.skyt.kisi));//karakter dizisini, UTF-8 formatında şifreler.
  postData.push(encodeURIComponent("konu")+"="+ encodeURIComponent($scope.skyt.konu));

    var data=postData.join("&");
    //postdata satırlarının aralarına  ve işareti koyarak data olarak hepsini seçtik

    $http({
      method: 'POST',
      url:$scope.webServiceUrl+'sikayetet.php',
      data:data,
      headers:{'Content-Type':'application/x-www-form-urlencoded'}
    }).success(function(data) {
      if (data !="") {
        alert (data);
      }else {
        $scope.s=$scope.skyt;
        $state.go("app.search");
        $ionicHistory.clearHistory();//kayıt yaptıktan sonra textlerı boşalt
      }
    }).error(function (data) {
      alert (data);
    });

  };
})



.controller('SikayetCtrl', function($scope,$http) {
  $http.get('http://10.93.170.52:81/staj/proje/sikayet.php')
  .success(function(data, status, headers,config){
    console.log(data);
    console.log('data success');
      $scope.sikayet=data;
  // // for browser console
  // for UI
  })
  .error(function(data, status, headers,config){
    console.log('data error');
  })
})
.controller('Menu2Ctrl', function($scope, $stateParams, ) {

})

.controller('KayitCtrl', function($scope, $http,$state) {
  $scope.kayit={};
  $scope.kayit.ad="";
  $scope.kayit.soyad="";
//  $scope.kayit.kullaniciAdi="";
  $scope.kayit.sifre="";
  $scope.kayit.sifret="";
  $scope.kayit.adres="";
  $scope.kayit.telefon="";

  $scope.kayitol=function(){
    var postData=[];
    postData.push(encodeURIComponent("ad")+"="+ encodeURIComponent($scope.kayit.ad));
    postData.push(encodeURIComponent("soyad")+"="+ encodeURIComponent($scope.kayit.soyad));
//  postData.push(encodeURIComponent("kullaniciAdi")+"="+ encodeURIComponent($scope.kayit.kullaniciAdi));
    postData.push(encodeURIComponent("sifre")+"="+ encodeURIComponent($scope.kayit.sifre));
    postData.push(encodeURIComponent("sifret")+"="+ encodeURIComponent($scope.kayit.sifret));
    postData.push(encodeURIComponent("adres")+"="+ encodeURIComponent($scope.kayit.adres));
    postData.push(encodeURIComponent("telefon")+"="+ encodeURIComponent($scope.kayit.telefon));
    var data=postData.join("&");
    //postdata satırlarının aralarına  ve işareti koyarak data olarak hepsini seçtik

    $http({
      method: 'POST',
      url:$scope.webServiceUrl+'insert.php',
      data:data,
      headers:{'Content-Type':'application/x-www-form-urlencoded'}
    }).success(function(data) {
      if (data !="") {
        alert (data);
      }else {
        $scope.user=$scope.kayit;
        $state.go("app.playlists");
        $ionicHistory.clearHistory();//kayıt yaptıktan sonra textlerı boşalt
      }
    }).error(function (data) {
      alert (data);
    });

  };
})
.controller('DuyuruEkle2Ctrl', function($scope, $http,$state) {
  $scope.kyt={};
  $scope.kyt.bilgi="";

  $scope.kydt=function(){
    var postData=[];
    postData.push(encodeURIComponent("bilgi")+"="+ encodeURIComponent($scope.kyt.bilgi));


    var data=postData.join("&");
    //postdata satırlarının aralarına  ve işareti koyarak data olarak hepsini seçtik

    $http({
      method: 'POST',
      url:$scope.webServiceUrl+'duyuruekle.php',
      data:data,
      headers:{'Content-Type':'application/x-www-form-urlencoded'}
    }).success(function(data) {
      if (data !="") {
        alert (data);
      }else {
        $scope.k=$scope.kyt;
        $state.go("app.search");
        $ionicHistory.clearHistory();//kayıt yaptıktan sonra textlerı boşalt
      }
    }).error(function (data) {
      alert (data);
    });

  };
});
