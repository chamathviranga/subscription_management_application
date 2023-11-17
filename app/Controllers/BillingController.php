<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaymentMethod;
use App\Models\Subscription;
use App\Models\CustomerSubscription;
use App\Models\Billing;
use CodeIgniter\HTTP\RedirectResponse;
use \Config\Database;
use Exception;

class BillingController extends BaseController
{

    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function index(int $id): string
    {
        helper('form');

        $paymentMethodsModel = new PaymentMethod();
        $paymentMethods = $paymentMethodsModel->findAll();

        $subscriptionModel = new Subscription();
        $subscriptions = $subscriptionModel->findAll();

        $CustomerSubscriptionModel = new CustomerSubscription();

        $mySubscription = $CustomerSubscriptionModel
            ->select([
                'customer_subscriptions.*',
                'subscriptions.name as subscription_name',
                'subscriptions.price as subscription_price',
                'subscriptions.duration as subscription_duration',
                'payment_methods.method as payment_method_name',
                'date(billing.valid_from) as valid_from',
                'date(billing.valid_to) as valid_to',
            ])
            ->join('subscriptions', 'subscriptions.id = customer_subscriptions.subscription_id')
            ->join('payment_methods', 'payment_methods.id = customer_subscriptions.payment_method')
            ->join('billing', 'billing.subscription_id = customer_subscriptions.id AND billing.status = "valid"', 'left')
            ->where('customer_subscriptions.customer_id', auth()->user()->id)
            ->where('customer_subscriptions.id', (int)$id)
            ->first();

        return view(
            'pages/customer/subscription/renewal.page.php',
            [
                'paymentMethods' => $paymentMethods,
                'subscriptions' => $subscriptions,
                'mySubscription' => $mySubscription ?? []
            ]
        );
    }

    public function submitRenew(int $id): string|RedirectResponse
    {


        helper('form');

        if (!$this->validate([
            'renew_for' => ['label' => 'renew for', 'rules' => 'required|numeric'],
            'subscription_id' => ['label' => 'subscription', 'rules' => 'required|numeric'],
            'payment_method' => ['label' => 'payment method', 'rules' => 'required|numeric'],
            'terms_and_conditions' => ['label' => 'terms and conditions', 'rules' => 'required'],
        ])) {
            return $this->index($id);
        }

        $renewalData = $this->validator->getValidated();

        $billing = model(Billing::class);
        $subscription = model(CustomerSubscription::class);

        
        $this->db->transStart();
        try {
            
            // Get current subscription duraion
            $currentSubscription = (new Subscription())
            ->select(['price'])
            ->find($renewalData['subscription_id']);
    
            // Get last valid payment expire date
            $currentPayment = $billing
                            ->select('valid_to')
                            ->where('customer_id', auth()->user()->id)
                            ->where('subscription_id', $id)
                            ->where('status', 'valid')
                            ->orderBy('created_at', 'desc')
                            ->first();
            
            $validTo = date('Y-m-d', strtotime('+' .  $renewalData['renew_for'] . ' months', strtotime($currentPayment['valid_to'])));

            // Disable old payments
            $billing
                ->set([
                    'status' => 'renewed'
                ])
                ->where('customer_id', auth()->user()->id)
                ->where('subscription_id', $id)
                ->where('status', 'valid')
                ->update();
           
            // Insert new payment
            $billing->save([
                'customer_id' => auth()->user()->id,
                'subscription_id' => $id,
                'valid_from' => date('Y-m-d'),
                'valid_to' => $validTo,
                'price' => $currentSubscription['price'],
                'status' => 'valid',
            ]);

            // Update payment method
            $subscription->update($id,[
                'payment_method' => $renewalData['payment_method']
            ]);

            $this->db->transCommit();
        } catch (Exception $e) {
            die($e);
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Transaction failed: ' . $e->getMessage());
        }



        return redirect()->back()->with('success', 'You have successfully renewed your subscription.');
    }
}
