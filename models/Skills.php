<?php
namespace app\models;

use app\core\ORM;

class Skills extends ORM {
    public function __construct() {
        parent::__construct('skills');
    }
}
?>