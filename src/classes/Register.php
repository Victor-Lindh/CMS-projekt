<?php

class Register extends Mapper 
{   
    public function registerNewUser($allPostVars)
    {
            $username = $allPostVars['username-reg'];
            $password = $allPostVars['password-reg'];
            // $header = $request->getHeaders();
            // return $response->withJson($header);
            $errArray = array();
            // username has at least 3 char
            if(strlen($username) < 3) {
                array_push($errArray, "Username has to be at least 3 characters long");
            }
            // username has to be unique
            $query = $this->db->prepare("SELECT * FROM users WHERE username = :username");
            $query->execute([":username" => $username]);
            $query->fetchAll();
            $num = $query->rowCount();
            // echo $num;
            if($num > 0) {
                array_push($errArray, 'Username has existed. Please choose another one!');
            }
            // to validate pw
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
                // return $response->withJson('invalid password');
                array_push($errArray, 'Invalid password. Make sure it has both uppercase and lowercase letters as well as numbers and has at least 8 digits.');
            }
            // print out all error msg
            if (sizeOf($errArray) == 0) {
                // to push new data into db
                // return $response->withJson($username . " " . $password);
                $query = $this->db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $query->execute([
                    ":username" => $username,
                    ":password" => password_hash($password, PASSWORD_BCRYPT)
                ]);
                // // user logged in directly after being created in db
                // $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
                // $stmt->execute([":username" => $username]);
                // $user = $stmt->fetch(PDO::FETCH_ASSOC);
                // $_SESSION['userID'] = $user['userID'];
                // $_SESSION['username'] = $user['username'];
                // $_SESSION['loggedIn'] = true;
            }

            return $errArray;

            
    }
}
