<?php
class Menu {

  private $container;
  private $dados;

  public function __construct($pContainer, $pDados) {
    $this->container = $pContainer;
    $this->dados     = $pDados;
  }

  public function __toString() {
    $menuConteudo = new Ul("list-group");
    foreach ($this->dados as $valor) {
        $link = new Link("localhost:3000/".$valor[2], $valor[1], null, null);
        $menuConteudo->addElement(new Li("list-group-item", $link));        
    }
    $this->container->addElement($menuConteudo);
    return "{$this->container}";
  }
}