<?php

class produtoplataformaparametro
{
    private $IdProduto;
    private $IdPlataforma;
    private $Plataforma;
    private $IdParametro;
    private $Parametro;
    private $ValorParametro;

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
     * Get the value of IdPlataforma
     */
    public function getIdPlataforma()
    {
        return $this->IdPlataforma;
    }

    /**
     * Set the value of IdPlataforma
     *
     * @return  self
     */
    public function setIdPlataforma($IdPlataforma)
    {
        $this->IdPlataforma = $IdPlataforma;

        return $this;
    }

    /**
     * Get the value of IdParametro
     */
    public function getIdParametro()
    {
        return $this->IdParametro;
    }

    /**
     * Set the value of IdParametro
     *
     * @return  self
     */
    public function setIdParametro($IdParametro)
    {
        $this->IdParametro = $IdParametro;

        return $this;
    }

    /**
     * Get the value of ValorParametro
     */
    public function getValorParametro()
    {
        return $this->ValorParametro;
    }

    /**
     * Set the value of ValorParametro
     *
     * @return  self
     */
    public function setValorParametro($ValorParametro)
    {
        $this->ValorParametro = $ValorParametro;

        return $this;
    }

    /**
     * Get the value of Parametro
     */
    public function getParametro()
    {
        return $this->Parametro;
    }

    /**
     * Set the value of Parametro
     *
     * @return  self
     */
    public function setParametro($Parametro)
    {
        $this->Parametro = $Parametro;

        return $this;
    }

    /**
     * Get the value of Plataforma
     */
    public function getPlataforma()
    {
        return $this->Plataforma;
    }

    /**
     * Set the value of Plataforma
     *
     * @return  self
     */
    public function setPlataforma($Plataforma)
    {
        $this->Plataforma = $Plataforma;

        return $this;
    }
}
