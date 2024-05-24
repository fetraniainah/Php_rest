<?php
namespace app\models;

use app\core\ORM;

class User extends ORM {
    public function __construct() {
        parent::__construct('users');
    }
}
?>