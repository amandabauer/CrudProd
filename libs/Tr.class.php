<?php

class Tr{
    private $aListElementTr = array();

    public function addElementTr(...$sAtributo) {
        $this->aListElementTr = array_merge($this->aListElementTr, $sAtributo);
    }
    public function __toString(){
        $sTr = "<tr>\n";
        foreach ($this->aListElementTr as $sItemListElement) {
            $sTr .= $sItemListElement;
        }
        $sTr .= "</tr>\n";
        return $sTr;
    }

}