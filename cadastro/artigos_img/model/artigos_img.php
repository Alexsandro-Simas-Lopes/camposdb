<?php

class artigo_images
{
    private $Id;
    private $Artigo_id;
    private $Caminho;
    private $Descricao;
    private $Enviado_em;
    
    public function getId() {
        return $this->Id;
    }
    public function setId($Id) {
        $this->Id = $Id;

        return $this;
    }
    
    public function getArtigo_id() {
        return $this->Artigo_id;
    }
    public function setArtigo_id($Artigo_id) {
        $this->Artigo_id = $Artigo_id;

        return $this;
    }

    public function getCaminho() {
        return $this->Caminho;
    }
    public function setCaminho($Caminho) {
        $this->Caminho = $Caminho;

        return $this;
    }

    public function getDescricao() {
        return $this->Descricao;
    }
    public function setDescricao($Descricao) {
        $this->Descricao = $Descricao;

        return $this;
    }

    public function getEnviado_em() {
        return $this->Enviado_em;
    }
    public function setEnviado_em($Enviado_em) {
        $this->Enviado_em = $Enviado_em;

        return $this;
    }
}