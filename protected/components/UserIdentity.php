<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
    private $_id;
    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $users = array(
            // username => password
            'demo' => 'demo',
            'admin' => 'admin',
        );
        if (!isset($users[$this->username]))
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($users[$this->username] !== $this->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else
            $this->errorCode = self::ERROR_NONE;
        return!$this->errorCode;
    }

    public function authenticateOpenID($name = null) {
        $user = Users::model()->findByAttributes(array('email' => $this->username));
        if ($user) {
            $this->_id = $user->user_id;
            $this->setState('name', $user->name);
            $this->setState('email', $user->email);
            $this->errorCode = self::ERROR_NONE;
        } else {
            $user = new Users();
            $user->attributes = array(
                'email' => $this->username,
                'name' => $name,
                'create_date' => @date('Y-m-d'),
                'api_key' => md5('phpfour@gmail.com' . time()),
            );
            if ($user->save()) {
                $this->_id = $user->user_id;
                $this->setState('name', $user->name);
                $this->setState('email', $user->email);
                $this->errorCode = self::ERROR_NONE;
            } else {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            }
        }
        return $this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

}