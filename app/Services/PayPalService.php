<?php
namespace App\Services;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

class PayPalService
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),
                env('PAYPAL_SECRET')
            )
        );

        $this->apiContext->setConfig([
            'mode' => "sandbox",
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
        ]);
    }

    public function createPayment($total, $currency, $description)
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item = new Item();
        $item->setName('Item Name')
            ->setCurrency($currency)
            ->setQuantity(1)
            ->setPrice($total);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($total);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($description);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('stripe_succss'))
            ->setCancelUrl(route('stripe_succss'));

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            // dd($payment);
            $amount = request()->query("price") ?? 30;
            $item_name = request()->query("plan") ??  "Basic Plan";
            $payment = $payment->create($this->apiContext, null, $amount, $item_name);
            return $payment;
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // Handle errors here
            return $ex->getData();
        }
    }

    public function executePayment($paymentId, $payerId)
    {
        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);
            return $result;
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // Handle errors here
            return $ex->getData();
        }
    }
}
