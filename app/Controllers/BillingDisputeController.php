<?php

namespace App\Controllers;

use App\Models\PaymentMethod;
use App\Models\Subscription;
use App\Models\CustomerSubscription;
use App\Models\BillingDispute;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use \Config\Database;
use Exception;


class BillingDisputeController extends BaseController
{

    private $db;
    private $userId;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->userId = auth()->user()->id;
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
            ->where('customer_subscriptions.customer_id', $this->userId)
            ->where('customer_subscriptions.id', (int)$id)
            ->first();

        return view(
            'pages/customer/subscription/billing_dispute.page.php',
            [
                'paymentMethods' => $paymentMethods,
                'subscriptions' => $subscriptions,
                'mySubscription' => $mySubscription ?? []
            ]
        );
    }

    public function submitBillingDispute(int $id): string|RedirectResponse
    {
        helper('form');

        if (!$this->validate([
            'issue' => ['label' => 'issue', 'rules' => 'required|max_length[500]'],
            'additional_info' => ['label' => 'relevant billing information', 'rules' => 'max_length[500]'],
            'support_document' => ['label' => 'support file', 'rules' => 'uploaded[support_document]|max_size[support_document,1024]|mime_in[support_document,image/jpg,image/jpeg,image/png]'],
            'preferred_resolution' => ['label' => 'preferred resolution', 'rules' => 'required|max_length[25]'],
            'terms_and_conditions' => ['label' => 'terms and conditions', 'rules' => 'required'],
        ])) {
            return $this->index($id);
        }

        $billingDisputeData = $this->validator->getValidated();
        $supportDocument = $this->request->getFile('support_document');


        if ($supportDocument->isValid() && !$supportDocument->hasMoved()) {

            $timestamp = date('YmdHis');
            $extension = $supportDocument->getClientExtension();
            $newFileName = $timestamp . '.' . $extension;

            $supportDocument->move(WRITEPATH . 'uploads', $newFileName);
           
            $model = model(BillingDispute::class);

            $this->db->transStart();
            try {

                $model->save([
                    'customer_id' => $this->userId,
                    'subscription_id' => $id,
                    'issue' => $billingDisputeData['issue'],
                    'other_details' => $billingDisputeData['additional_info'],
                    'preferred_resolution' => $billingDisputeData['preferred_resolution'],
                    'support_document' => $newFileName
                ]);



                $this->db->transCommit();
            } catch (Exception $e) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Transaction failed: ' . $e->getMessage());
            }
        } else {
            return redirect()->back()->with('error', 'File upload error: ' . $supportDocument->getErrorString());
        }

        return redirect()->back()->with('success', 'You have successfully requested to cancel the subscription.');
    }
}
