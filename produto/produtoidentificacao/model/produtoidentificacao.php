<?php

class produtoidentificacao
{
    private $IdProduto;
    private $Produto;
    private $IdIdentificacao;
    private $Identificacao;

    /**
     * Get the value of IdProduto
     */
    public function getIdProduto()
    {
        return $this->IdProduto;
    }

    /**
     * Set the value of IdProduto
     *
     * @return  self
     */
    public function setIdProduto($IdProduto)
    {
        $this->IdProduto = $IdProduto;

        return $this;
    }

    /** 
     * Get the value of IdIdentificacao
     */
    public function getIdIdentificacao()
    {
        return $this->IdIdentificacao;
    }

    /**
     * Set the value of IdIdentificacao
     *
     * @return  self
     */
    public function setIdIdentificacao($IdIdentificacao)
    {
        $this->IdIdentificacao = $IdIdentificacao;

        return $this;
    }

    /**
     * Get the value of Produto
     */
    public function getProduto()
    {
        return $this->Produto;
    }

    /**
     * Set the value of Produto
     *
     * @return  self
     */
    public function setProduto($Produto)
    {
        $this->Produto = $Produto;

        return $this;
    }

    /**
     * Get the value of Identificacao
     */
    public function getIdentificacao()
    {
        return $this->Identificacao;
    }

    /**
     * Set the value of Identificacao
     *
     * @return  self
     */
    public function setIdentificacao($Identificacao)
    {
        $this->Identificacao = $Identificacao;

        return $this;
    }
}
