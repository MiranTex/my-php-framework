<?php

namespace db;

require "../bootstrap/bootstrap.php";


class Migration{

    public function start(){
        $a = scandir('./Migration');

        for($i=2;$i<count($a);$i++){

            $class = explode('.',$a[$i])[0];

            $instace = 'db\Migration\\'.$class;

            (new $instace)->up();
        }
    }
}



$migration = new Migration();

$migration->start();