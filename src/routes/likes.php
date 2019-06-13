<?php
    return function ($app) {

        $auth = require __DIR__ . '/../middlewares/auth.php';

        $app->get('/api/like', function($request, $response ,$args) {
            $likes = new Likes($this->db);
            return $response->withJson($likes->getLikedEntry());
        })->add($auth);

        $app->post('/api/like/{id}', function($request, $response, $args){
          $userID =  $_SESSION['userID'] ;
          $entryID =  $args['id'];
          $newLike = new Likes($this->db);
          return $response->withJson($newLike->addLike($userID,  $entryID));
        })->add($auth);

    };
