<?php
trait Presta {
    static public $contatoreMateriali = 0;
    public function presta() {
        self::$contatoreMateriali--;
    }
}
