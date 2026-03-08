<?php

namespace Modules\BasicPayment\app\Library\SslCommerz;

interface SslCommerzInterface
{
    /**
     * @param array $data
     */
    public function makePayment(array $data);

    /**
     * @param $requestData
     * @param $trxID
     * @param $amount
     * @param $currency
     */
    public function orderValidate($requestData, $trxID, $amount, $currency);

    /**
     * @param $data
     */
    public function setParams($data);

    /**
     * @param array $data
     */
    public function setRequiredInfo(array $data);

    /**
     * @param array $data
     */
    public function setCustomerInfo(array $data);

    /**
     * @param array $data
     */
    public function setShipmentInfo(array $data);

    /**
     * @param array $data
     */
    public function setProductInfo(array $data);

    /**
     * @param array $data
     */
    public function setAdditionalInfo(array $data);

    /**
     * @param $data
     * @param array $header
     * @param $setLocalhost
     */
    public function callToApi($data, $header = [], $setLocalhost = false);
}
