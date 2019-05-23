<?php

return function ($app) {
  // Register auth middleware
  $auth = require __DIR__ . '/../middlewares/auth.php';
  
  
  // Add a logout route
  
  $app->get('/api/logout', function ($request, $response, $args) {
    session_start();
    session_destroy();
    return $response->withJson(['success' => 'ok']);  
    
  });
  


  // Add a login route
  
  $app->post('/api/login', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $_SESSION = $userData;
    
    if (isset($data['username']) && isset($data['password'])) {
      $user = new User($this->db);
      $userData = $user->getUserName($data['username']);
      
      if ($userData) {
        if ($data['password'] == $userData['password']) {
          $_SESSION['loggedIn'] = true;
          $_SESSION['userId'] = $userData['userID'];
          return $response->withJson($userData['userID']);   
        }
      }
      var_dump($_SESSION['username']);
    }

    return $response->withStatus(401);
    
    });


   
    
    // Add a ping route
    $app->get('/api/ping', function ($request, $response, $args) {
      return $response->withJson(['loggedIn' => true]);
    })->add($auth);
    
  };