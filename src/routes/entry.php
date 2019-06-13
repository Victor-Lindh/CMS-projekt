<?php

return function ($app){

    $auth = require __DIR__ . '/../middlewares/auth.php';

    $app->delete('/entry/{id}', function ($request, $response, $args) {
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
      
      $app->get('/api/entry/frontposts', function ($request, $response, $args) {
        $entries = new Entry($this->db);
        return $response->withJson($entries->getLatestPosts());

    });
      $app->get('/api/entry/frontposts/loggedIn', function ($request, $response, $args) {
        $entries = new Entry($this->db);
        return $response->withJson($entries->getLatestPostsLoggedIn());

    });
      $app->get('/api/entry/userposts', function ($request, $response, $args) {
        $entries = new Entry($this->db);
        $userID = $_SESSION['userId'];
        return $response->withJson($entries->getLatestUserPosts($userID));
    });

    // Delete

      $app->delete('/api/userposts/remove/{id}', function ($request, $response, $args) {
        $entryID = $args['id'];
        $entries = new Entry($this->db);
        return $response->withJson($entries->removePost($entryID));
        
      }) ->add($auth);

    

      $app->post('/api/entry/update/{id}', function ($request, $response, $args) {
        $data = $request->getParsedBody();
        $editID = $args['id'];
        $title = $data['title'];
        $content = $data['content'];

        $entries = new Entry($this->db);

        return $response->withJson($entries->updatePost($title, $content, $editID));
      }) ->add($auth);

      
      
    };