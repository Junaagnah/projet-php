<?php

class User {
    private int $id;
    public string $email;
    private string $password;
    public string $username;
    public string $profilePicturePath;
    public string $userRole;

    public function __construct(array $user)
    {
        // Parsing the data to the object
        if (!empty($user['id']))
            $this->id = $user['id'];

        if (!empty($user['email']))
            $this->email = $user['email'];

        if (!empty($user['password']))
            $this->password = $user['password'];

        if (!empty($user['username']))
            $this->username = $user['username'];

        if (!empty($user['profilePicturePath']))
            $this->profilePicturePath = $user['profilePicturePath'];

        if (!empty($user['userRole']))
            $this->userRole = $user['userRole'];
    }
}
