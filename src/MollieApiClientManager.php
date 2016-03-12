<?php

namespace PeterIcebear\Mollie;

class MollieApiClientManager
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * The default settings.
     */
    protected $config;

    /**
     * Create a new Mollie instance.
     *
     * @param \Illuminate\Foundation\Application $app
     * @param array                              $config
     */
    public function __construct($app, $config = [])
    {
        $this->app = $app;
        $this->config = $config;
    }

    /**
     * @throws \Mollie_API_Exception
     *
     * @return \Mollie_API_Client
     */
    public function client()
    {
        $mollie = new \Mollie_API_Client();

        if ($this->config['test_mode']) {
            $mollie->setApiKey($this->config['api_keys']['test']);
        } else {
            $mollie->setApiKey($this->config['api_keys']['live']);
        }

        return $mollie;
    }

    /**
     * @return \Mollie_API_Resource_Payments
     */
    public function getPayments()
    {
        return $this->client()->payments;
    }

    /**
     * @return \Mollie_API_Resource_Payments_Refunds
     */
    public function getPaymentRefunds()
    {
        return $this->client()->payments_refunds;
    }

    /**
     * @return \Mollie_API_Resource_Issuers
     */
    public function getIssuers()
    {
        return $this->client()->issuers;
    }

    /**
     * @return \Mollie_API_Resource_Methods
     */
    public function getMethods()
    {
        return $this->client()->methods;
    }
}
