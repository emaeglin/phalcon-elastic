<?php

namespace Emaeglin\Phalcon\Elastic;

class Elastic extends \Phalcon\Di\Injectable
{
    /**
     * @return Apm
     */
    private $Apm;
    private $ElasticSearch;
    private $config;

    public function __construct(Config $config)
    {
        $this->config           = $config;
        $this->Apm              = new Apm($this->config);
        $this->ElasticSearch    = new ElasticSearch($this->config);
    }
    /**
     * @return Apm
     */
    public function getApm() {
        return $this->Apm;
    }

    public function getElasticSearch() {
        return $this->ElasticSearch;
    }
}