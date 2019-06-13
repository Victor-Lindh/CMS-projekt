<?php

return function ($app) {
  // Register auth middleware
  $auth = require __DIR__ . '/../middlewares/auth.php';
  
  
  // Add a logout route
  
  $app->get('/api/logout', function ($request, $response, $args) {
    // session_start();
    session_destroy();
    return $response->withJson(['logout' => 'ok']);
    
  });
  


  // Add a login route
  
  $app->post('/api/login', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $userData = $_SESSION;
    
    if (isset($data['username']) && isset($data['password'])) {
      $user = new User($this->db);
      $userData = $user->getUserName($data['username']);
      if ($userData) {
        if(password_verify($data['password'], $userData['password'])){
          $_SESSION['username'] = $userData['username'];
          $_SESSION['userId'] = $userData['userID'];
          $_SESSION['loggedIn'] = true;
          
          return $response->withJson("SUCCESS!");
        }
      }

    }

    return $response->withStatus(401);
    
    }); // Här slutar api-login


   
    
    // Add a ping route
    $app->get('/api/ping', function ($request, $response, $args) {
      return $response->withJson(['loggedIn' => true]);
    })->add($auth);
    
  };