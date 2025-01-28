<?php

class produto
{
    private $Id;
    private $Descricao;
    private $DataCadastro;
    private $DataExclusao;

    /**
     * Get the value of Id
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Set the value of Id
     *
     * @return  self
     */
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }

    /**
     * Get the value of Descricao
     */
    public function getDescricao()
    {
        return $this->Descricao;
    }

    /**
     * Set the value of Descricao
     *
     * @return  self
     */
    public function setDescricao($Descricao)
    {
        $this->Descricao = $Descricao;

        return $this;
    }

    /**
     * Get the value of DataCadastro
     */
    public function getDataCadastro()
    {
        return $this->DataCadastro;
    }

    /**
     * Set the value of DataCadastro
     *
     * @return  self
     */
    public function setDataCadastro($DataCadastro)
    {
        $this->DataCadastro = $DataCadastro;

        return $this;
    }
    public function getDataCadastroFormatada()
    {
        $data = $this->DataCadastro;
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

    /**
     * Get the value of DataExclusao
     */ 
    public function getDataExclusao()
    {
        return $this->DataExclusao;
    }

    /**
     * Set the value of DataExclusao
     *
     * @return  self
     */ 
    public function setDataExclusao($DataExclusao)
    {
        $this->DataExclusao = $DataExclusao;

        return $this;
    }
    public function getDataExclusaoFormatada()
    {
        $data = $this->DataExclusao;
        $data1 = DateTime::createFromFormat("Y-m-d H:i:s", $data);
        if (date_get_last_errors()) {
            $erro = date_get_last_errors()['errors'];
            $new_data = '';
        } else {
            $new_data = $data1->format("d/m/Y");
        }

        return $new_data;
    }

    public function getStatus()
    {
        $status = "ativo";
        if (!empty($this->DataExclusao)) {
            $status = "inativo";
        }
        return $status;
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
