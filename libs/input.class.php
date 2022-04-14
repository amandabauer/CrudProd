<?php
class Input {
    private $class;
    private $attributes;

    public function __construct($class = '', $attributes = []) {
        $this->class      = $class;
        $this->attributes = $attributes;
    }

    public function __toString() {
        $input = '<input class="'.$this->class.'" ';

        foreach ($this->attributes as $attribute => $val) {
            $input .= $attribute . '="' . $val . '" ';
        }

        $input .= ">";

        return $input;
    }
}