<?php
namespace app\models;

use app\core\ORM;

class Messages extends ORM {
    public function __construct() {
        parent::__construct('messages');
    }
}
?>