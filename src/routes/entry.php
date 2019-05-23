<?php

return function ($app){

    $auth = require __DIR__ . '/../middlewares/auth.php';

    $app->get('/entry/{id}', function ($request, $response, $args) {
        //Steg 2
        $userID = $args['id'];
        //Anrop till funtionen class User extends Mapper
        //Steg 3
        $entry = new Entry($this->db);
    
        return $response->withJson($entry->getEntryByID($userID));
      })->add($auth);

      $app->get('/entry/first/{X}', function ($request, $response, $args) {
        $num = $args['X'];
        $entry = new Entry($this->db);
        return $response->withJson($entry->getFirstEntry($num));
      });

      $app->get('/entry/last/{X}', function ($request, $response, $args) {
        $num = $args['X'];
        $entry = new Entry($this->db);
        return $response->withJson($entry->getLastEntry($num));
      });

      // /entry/user/{id}/first/{X}

      $app->get('/entry/user/{id}/first/{X}', function ($request, $response, $args) {
        $num = $args['X'];
        $userID = $args['id'];
        $entry = new Entry($this->db);
        return $response->withJson($entry->getEntryByUserFirst($userID,$num));
      });
      $app->get('/entry/user/{id}/last/{X}', function ($request, $response, $args) {
        $num = $args['X'];
        $userID = $args['id'];
        $entry = new Entry($this->db);
        return $response->withJson($entry->getEntryByUserLast($userID,$num));
      });


      $app->post('/api/entry/send', function ($request, $response, $args) {
        $data = $request->getParsedBody();
        $entries = new Entry($this->db);
        $entries->sendNewPost($data);
        return $response->withJson(["sucess" => true]);
    
    });

};