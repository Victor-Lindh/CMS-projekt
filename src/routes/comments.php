<?php
return function ($app){

$auth = require __DIR__ . '/../middlewares/auth.php';

$app->get('/api/comments', function ($request, $response, $args) {
  $user = new Comments($this->db);
  return $response->withJson($user->getAllComments());
// })->add($auth);
});

$app->post('/api/comments/send', function ($request, $response, $args) {
  $data = $request->getParsedBody();
  $comment = new Comments($this->db);
  $comment->sendComment($data);
  $userID = $_SESSION['userId'];
  return $response->withJson(["success" => true]);

});



};