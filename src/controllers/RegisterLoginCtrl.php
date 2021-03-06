<?php
namespace App\controllers;

use App\Delegates\RegisterDelegate;
use App\Delegates\LoginDelegate;
use App\Delegates\AllUsersDelegate;

class RegisterLoginCtrl extends BaseController
{


  //Registration Controllers
  public function registerSubmit($request, $response, $args) {

      $registerDelegate = new RegisterDelegate();
      $datas = $request->getParsedBody();
      // $this->c->logger->info("Data " . " " . json_encode($datas) );
      // die();
      $registerResponse = $registerDelegate->registerUser($datas);
      return $response->withJson($registerResponse);

  }

  public function registerHome( $request,  $response,  $args) {
    $this->c->view->render($response,'register.twig');
  }



  //Login Controllers
  public function loginHome( $request,  $response,  $args) {
    $this->c->view->render($response,'login.twig');
  }

  public function loginSubmit ( $request,  $response,  $args) {
    $loginDelegate = new LoginDelegate();
    $datas = $request->getParsedBody();
    $loginResponse = $loginDelegate->loginUser($datas);
    // echo $_SESSION['user_id'];
    return $resposne->$loginResponse;
  }


  //Show All User Details
  public function showAllUserDetailsCtrl ( $request,  $response, $args) {
    $allUsersDelegate = new AllUsersDelegate();
    $results = $allUsersDelegate->showAllUserDetails(); //returns an array
    $this->c->logger->info(" from the appache 2 " );
    return $response->withJson($results);
  }

  public function editUserDetails( $request, $response, $args )
  {
    $userEditDelegate = new UserEditDelegate();
    $datas = $request->getParsedBody();
    $userEditDelegate->editUserDetails($datas, $args);

    return ;
  }


}
 ?>
