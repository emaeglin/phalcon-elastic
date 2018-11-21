<?php
namespace Emaeglin\Phalcon\Elastic;

class Config
{
    public $serverHost;
    public $defaultSchema;
    public $apmPort;
    public $elasticSearchPort;
    public $appName;
    public $appVersion;
    public $defaultIndex;
    public $env;

    public $apmHost;
    public $elasticSearchHost;

    public function __construct(
        $serverHost = false,
        $appName = false,
        $appVersion = false,
        $defaultSchema = false,
        $defaultIndex = false,
        $apmPort = false,
        $elasticSearchPort = false,
        $env = false
    )
    {
        $this->serverHost           = $serverHost           ? $serverHost           : '127.0.0.1';
        $this->appName              = $appName              ? $appName              : 'defaultApp';
        $this->appVersion           = $appVersion           ? $appVersion           : '1.0.0';
        $this->defaultSchema        = $defaultSchema        ? $defaultSchema        : 'http';
        $this->defaultIndex         = $defaultIndex         ? $defaultIndex         : 'defaultIndex';
        $this->apmPort              = $apmPort              ? $apmPort              : '8200';
        $this->elasticSearchPort    = $elasticSearchPort    ? $elasticSearchPort    : '9200';
        $this->env                  = $env                  ? $env                  : ['DOCUMENT_ROOT', 'REMOTE_ADDR'];

        $this->apmHost              = $this->defaultSchema . '://' . $this->serverHost . ':' . $this->apmPort;
        $this->elasticSearchHost    = $this->defaultSchema . '://' . $this->serverHost . ':' . $this->elasticSearchPort;
    }
}