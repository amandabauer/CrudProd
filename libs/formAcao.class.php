<?php

 class FormAcao {

    private $inputs;
    private $texto;
    private $action;

    public function __construct($texto, ...$campos){
        $this->texto = $texto;
        $this->setInputs(...$campos);
    }

    public function setInputs(...$campos){
        $inputs = '';
        foreach($campos as $campo){
            $input = new Input('form-control', [
                                'type'        => 'text', 
                                'placeholder' => "Digite o $campo",
                                'id'          => $campo,
                                'name'        => $campo]);
            $inputs .= $input;
        }
        $this->inputs = $inputs;
    }

    public function getSubmit(){
        return '<button type="submit" class="btn btn-primary" name="cadastrar">Cadastrar</button>';
    }

    public function __toString() {
        $div = new Div('col-sm-2');
        $text = new Texto($this->texto);
        $form = new Form('post', $this->action);
        $form->addElementForms($this->inputs);
        $form->addElementForms($this->getSubmit());
        $div->addElement($text);
        $div->addElement($form);
        return "{$div}";

    }

 }