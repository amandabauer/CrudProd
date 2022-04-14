<?php

class Table {

    private $aListElement = array();

    public function addElements(...$sAtributo) {
        $this->aListElement = array_merge($this->aListElement, $sAtributo);
    }

   public function __toString(){
       $sTable = " <table class=\"table table-striped\">\n";
       foreach ($this->aListElement as $sItemListElement){
           $sTable .= $sItemListElement;
       }
       $sTable .="</table>\n";
       return $sTable;
   }

}
