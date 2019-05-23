<?php

return function ($app) {
    // Register auth middleware
    $auth = require __DIR__ . '/../middlewares/auth.php';

$app->get('/api/entry', function ($request, $response, $args) {
    $entries = new Entries($this->db);
    $allEntries = $entries->getPosts();
    return $response->withJson($allEntries);

});

$app->post('/api/entry', function ($request, $response, $args) {
    $entries = new Entries($this->db);
    $sendEntry = $entries->sendPost();
    return $response->withJson($sendEntry);
});


};