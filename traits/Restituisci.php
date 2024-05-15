<?php
trait Restituisci {
    static public $contatoreMateriali = 0; 
    public function restituisci() {
        self::$contatoreMateriali++;
    }
}
