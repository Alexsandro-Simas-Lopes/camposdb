<?php

class produtos
{
    private $Id;
    private $Marca;
    private $Name;
    private $Img;
    private $Categoria;
    private $Sub_Categoria;
    private $Price;
    private $Medida;
    private $Created_at;
    private $Updated_at;

    public function getId(){
        return $this->Id;
    }
    public function setId($Id){
        $this->Id = $Id;

        return $this;
    }

    public function getMarca(){
        return $this->Marca;
    }
    public function setMarca($Marca){
        $this->Marca = $Marca;

        return $this;
    }

    public function getName(){
        return $this->Name;
    }
    public function setName($Name){
        $this->Name = $Name;

        return $this;
    }

    public function getImg(){
        return $this->Img;
    }
    public function setImg($Img){
        $this->Img = $Img;

        return $this;
    }

    public function getCategoria(){
        return $this->Categoria;
    }
    public function setCategoria($Categoria){
        $this->Categoria = $Categoria;

        return $this;
    }

    public function getSub_Categoria(){
        return $this->Sub_Categoria;
    }
    public function setSub_Categoria($Sub_Categoria){
        $this->Sub_Categoria = $Sub_Categoria;

        return $this;
    }

    public function getPrice(){
        return $this->Price;
    }
    public function setPrice($Price){
        $this->Price = $Price;

        return $this;
    }

    public function getMedida(){
        return $this->Medida;
    }
    public function setMedida($Medida){
        $this->Medida = $Medida;

        return $this;
    }

    public function getCreated_at(){
        return $this->Created_at;
    }
    public function setCreated_at($Created_at){
        $this->Created_at = $Created_at;

        return $this;
    }
    public function getCreated_atFormated()
    {
        $data = $this->Created_at;
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
        return $this->Updated_at;
    }
    public function setUpdated_at($Updated_at){
        $this->Updated_at = $Updated_at;

        return $this;
    }
    public function getUpdated_atFormated()
    {
        $data = $this->Updated_at;
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

