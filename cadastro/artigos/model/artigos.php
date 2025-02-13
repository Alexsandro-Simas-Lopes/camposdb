<?php

class artigos
{
    private $Id;
    private $Titulo;
    private $Resumo;
    private $Conteudo;
    private $Status;
    private $Enviado_em;
    private $Atualizado_em;

    public function getId() {
        return $this->Id;
    }
    public function setId($Id) {
        $this->Id = $Id;

        return $this;
    }

    public function getTitulo() {
        return $this->Titulo;
    }
    public function setTitulo($Titulo) {
        $this->Titulo = $Titulo;

        return $this;
    }

    public function getResumo() {
        return $this->Resumo;
    }
    public function setResumo($Resumo) {
        $this->Resumo = $Resumo;

        return $this;
    }

    public function getConteudo() {
        return $this->Conteudo;
    }
    public function setConteudo($Conteudo) {
        $this->Conteudo = $Conteudo;

        return $this;
    }

    public function getStatus() {
        return $this->Status;
    }
    public function setStatus($Status) {
        $this->Status = $Status;

        return $this;
    }

    public function getEnviado_em() {
        return $this->Enviado_em;
    }
    public function setEnviado_em($Enviado_em) {
        $this->Enviado_em = $Enviado_em;

        return $this;
    }

    public function getAtualizado_em() {
        return $this->Atualizado_em;
    }
    public function setAtualizado_em($Atualizado_em) {
        $this->Atualizado_em = $Atualizado_em;

        return $this;
    }

    
    public function getCreated_atFormated()
    {
        $data = $this->Enviado_em;
        $data1 = DateTime::createFromFormat("Y-m-d H:i:s", $data);
        if (date_get_last_errors()) {
            $erro = date_get_last_errors()['errors'];
            $new_data = '';
        } else {
            $new_data = $data1->format("d/m/Y");
        }

        return $new_data;
    }
    function getArrayClasse()
    {
        $val = (array) $this;
        return $val;
    }

    public function getUpdated_at(){
        return $this->Atualizado_em;
    }
    public function setUpdated_at($Atualizado_em){
        $this->Atualizado_em = $Atualizado_em;

        return $this;
    }
    public function getUpdated_atFormated()
    {
        $data = $this->Atualizado_em;
        $data1 = DateTime::createFromFormat("Y-m-d H:i:s", $data);
        if (date_get_last_errors()) {
            $erro = date_get_last_errors()['errors'];
            $new_data = '';
        } else {
            $new_data = $data1->format("d/m/Y");
        }

        return $new_data;
    }

    public function getStatusIndicator()
    {
        $status_indicator = '<span class="label label-primary">Ativo</span>';
        if (!empty($this->DataExclusao)) {
            $status_indicator = '<span class="label label-danger">Inativo</span>';
        }
        return $status_indicator;
    }

    
}

