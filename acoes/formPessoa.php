<?php
 
 class FormPessoa {

    private $inputs;

    public function __construct(...$campos){
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
        return `<button type="submit" class="btn btn-primary">Cadastrar</button>`;
    }

    public function __toString() {
        $retorno = '';

        $form = new Form('post', '../index.php');
        $form->addElementForms($this->inputs);
        $form->addElementForms($this->getSubmit());
        return $form;

    }

 }