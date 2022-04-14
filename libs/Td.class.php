<?php

class Td {
    
    private $text;

    public function __construct($pText) {
        $this->text = $pText;
    }
    
    public function __toString() {
        return "<td>{$this->text}</td>\n";
    }

}