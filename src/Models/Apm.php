<?php
namespace Emaeglin\Phalcon\Elastic;

use \PhilKra\Agent as ApmAgent;
use PhilKra\Serializers\Transactions;
use PhilKra\Stores\TransactionsStore;

class Apm
{
    /** @var Config */
    private $config;
    private $agent = null;
    private $transaction = null;
    private $transactionName = '';
    private $transactionId = '';

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getTransactionId() {
        return $this->transactionId;
    }

    public function startTransaction($transactionName)
    {
        $this->agent = new ApmAgent([
            'appName'       => $this->config->appName,
            'appVersion'    => $this->config->appVersion,
            'serverUrl'     => $this->config->apmHost,
            'env'           => $this->config->env
        ]);
        $this->transactionName = $transactionName;
        $this->transactionId = md5($transactionName . microtime());
        try {
            $this->transaction = $this->agent->startTransaction($this->transactionName);
        } catch (\Exception $e) {
            $this->catchException($e);
        }
    }

    public function finishTransaction($type = 'success', $data = []) {
        $this->transaction->setCustomContext($data);
        $result = ($type == 'success') ? 200 : 500;

        try {
            $this->agent->stopTransaction($this->transactionName,
                [
                    'result'    => $result,
                    'type'     =>$type
                ]
            );
            $this->agent->send();
        } catch(\Exception $e) {
            $this->catchException($e);
        }

    }

    private function catchException(\Exception $e) {
        //TODO: Exception catch
    }
}