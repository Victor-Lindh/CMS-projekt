<?php
return function ($app) {
  // Register auth middleware
  $auth = require __DIR__ . '/../middlewares/auth.php';
  $user = require __DIR__ . '/../routes/user.php';

  // Add a login route
 
  

  
  
  $app->post('/api/login', function ($request, $response, $args) {
    $data = $request->getParsedBody();
    $user = new User($this->db);
    return $response->withJson($user->getUserName());
    
    if(password_verify($_POST['password'], $data['password'])){
      $_SESSION['username'] = $user['username'];  
    //   return $response->withJson($data);             
      $_SESSION['loggedIn'] = true;
  //     $_SESSION['username'] = $data['username']; 
      
  // } else {
  //   return $response->withStatus(401);
   
  }
  });
  
  // Add a ping route
  $app->get('/api/ping', function ($request, $response, $args) {
    return $response->withJson(['loggedIn' => true]);
  })->add($auth);

  };