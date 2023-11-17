<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaymentMethod;
use App\Models\CustomerSubscription;
use App\Models\Subscription;
use App\Models\CustomerRequest;
use App\Models\Feedback;
use CodeIgniter\HTTP\RedirectResponse;
use \Config\Database;
use Exception;

class CustomerSubscriptionsController extends BaseController
{

    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function index(): string
    {
        $CustomerSubscriptionModel = new CustomerSubscription();
        $mySubscriptions = $CustomerSubscriptionModel
            ->select(['customer_subscriptions.*', 'subscriptions.name as subscription_name', 'payment_methods.method as payment_method_name'])
            ->join('subscriptions', 'subscriptions.id = customer_subscriptions.subscription_id')
            ->join('payment_methods', 'payment_methods.id = customer_subscriptions.payment_method')
            ->where('customer_id', auth()->user()->id)
            ->findAll();

        return view('pages/customer/subscription/list.page.php', ['mySubscriptions' => $mySubscriptions]);
    }

    public function create(): string
    {
        helper('form');

        $paymentMethodsModel = new PaymentMethod();
        $paymentMethods = $paymentMethodsModel->findAll();

        $subscriptionModel = new Subscription();
        $subscriptions = $subscriptionModel->findAll();

        return view('pages/customer/subscription/register.page.php', ['paymentMethods' => $paymentMethods, 'subscriptions' => $subscriptions]);
    }

    public function submit(): string|RedirectResponse
    {
        helper('form');

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validate([
            'name' => ['label' => 'name', 'rules' => 'required|max_length[50]|min_length[3]'],
            'email'  => ['label' => 'email', 'rules' => 'required|max_length[100]|valid_email'],
            'phone'  => ['label' => 'phone', 'rules' => 'required|numeric|max_length[10]'],
            'billing_street'  => ['label' => 'billing street', 'rules' => 'required|max_length[100]'],
            'billing_city'  => ['label' => 'billing city', 'rules' => 'required|max_length[100]'],
            'billing_state'  => ['label' => 'billing state', 'rules' => 'required|max_length[100]'],
            'billing_postal_code'  => ['label' => 'billing postal code', 'rules' => 'required|max_length[10]'],
            'billing_country'  => ['label' => 'billing country', 'rules' => 'required|max_length[50]'],
            'subscription' => ['label' => 'subscription', 'rules' => 'required|numeric'],
            'payment_method' => ['label' => 'payment method', 'rules' => 'required|numeric'],
            'terms_and_conditions' => ['label' => 'terms and conditions', 'rules' => 'required']
        ])) {
            // The validation fails, so returns the form.
            return $this->create();
        }

        // Gets the validated data.
        $subscriptionData = $this->validator->getValidated();

        $model = model(CustomerSubscription::class);

        $model->save([
            'name' => $subscriptionData['name'],
            'email' => $subscriptionData['email'],
            'phone' => $subscriptionData['phone'],
            'billing_street' => $subscriptionData['billing_street'],
            'billing_city' => $subscriptionData['billing_city'],
            'billing_state' => $subscriptionData['billing_state'],
            'billing_postal_code' => $subscriptionData['billing_postal_code'],
            'billing_country' => $subscriptionData['billing_country'],
            'subscription_id' => $subscriptionData['subscription'],
            'payment_method' => $subscriptionData['payment_method'],
            'customer_id' => auth()->user()->id
        ]);

        return redirect()->back()->with('success', 'You successfully made a subscription.');
    }

    public function edit(int $id): string
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
                'payment_methods.method as payment_method_name'
            ])
            ->join('subscriptions', 'subscriptions.id = customer_subscriptions.subscription_id')
            ->join('payment_methods', 'payment_methods.id = customer_subscriptions.payment_method')
            ->where('customer_id', auth()->user()->id)
            ->where('customer_subscriptions.id', (int)$id)
            ->first();

        return view(
            'pages/customer/subscription/edit.page.php',
            [
                'paymentMethods' => $paymentMethods,
                'subscriptions' => $subscriptions,
                'mySubscription' => $mySubscription ?? []
            ]
        );
    }

    public function update(int $id): string|RedirectResponse
    {
        helper('form');

        if (!$this->validate([
            'name' => ['label' => 'name', 'rules' => 'required|max_length[50]|min_length[3]'],
            'email'  => ['label' => 'email', 'rules' => 'required|max_length[100]|valid_email'],
            'phone'  => ['label' => 'phone', 'rules' => 'required|numeric|max_length[10]'],
            'billing_street'  => ['label' => 'billing street', 'rules' => 'required|max_length[100]'],
            'billing_city'  => ['label' => 'billing city', 'rules' => 'required|max_length[100]'],
            'billing_state'  => ['label' => 'billing state', 'rules' => 'required|max_length[100]'],
            'billing_postal_code'  => ['label' => 'billing postal code', 'rules' => 'required|max_length[10]'],
            'billing_country'  => ['label' => 'billing country', 'rules' => 'required|max_length[50]'],
            'subscription' => ['label' => 'subscription downgrade', 'rules' => 'required|numeric'],
            'subscription_downgrade' => ['label' => 'subscription downgrade', 'rules' => 'permit_empty|numeric'],
            'subscription_upgrade' => ['label' => 'subscription upgrade', 'rules' => 'permit_empty|numeric'],
            'payment_method' => ['label' => 'payment method', 'rules' => 'required|numeric'],
            'terms_and_conditions' => ['label' => 'terms and conditions', 'rules' => 'required'],
            'additional_comments' => ['label' => 'additional comments', 'rules' => 'max_length[255]'],
        ])) {
            return $this->edit($id);
        }

        $subscriptionData = $this->validator->getValidated();

        $model = model(CustomerRequest::class);

        $newPackage = $subscriptionData['subscription_upgrade'] ? $subscriptionData['subscription_upgrade'] : $subscriptionData['subscription_downgrade'];

        $model->save([
            'customer_id' => auth()->user()->id,
            'type' => 'subscription_modification',
            'payload' => json_encode([
                'subscription_details' => [
                    'subscription_id' => $subscriptionData['subscription'],
                    'payment_method' => $subscriptionData['payment_method'],
                    'subscription_id' => empty($newPackage) ? $subscriptionData['subscription'] : $newPackage,
                    'additional_comments' => $subscriptionData['additional_comments']
                ],
                'billing_details' => [
                    'billing_street' => $subscriptionData['billing_street'],
                    'billing_city' => $subscriptionData['billing_city'],
                    'billing_state' => $subscriptionData['billing_state'],
                    'billing_postal_code' => $subscriptionData['billing_postal_code'],
                    'billing_country' => $subscriptionData['billing_country'],
                ],
                'personal_details' => [
                    'name' => $subscriptionData['name'],
                    'email' => $subscriptionData['email'],
                    'phone' => $subscriptionData['phone'],
                ]
            ])
        ]);

        return redirect()->back()->with('success', 'You have successfully requested an update to the subscription.');
    }

    public function cancel(int $id): string
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
                'payment_methods.method as payment_method_name'
            ])
            ->join('subscriptions', 'subscriptions.id = customer_subscriptions.subscription_id')
            ->join('payment_methods', 'payment_methods.id = customer_subscriptions.payment_method')
            ->where('customer_id', auth()->user()->id)
            ->where('customer_subscriptions.id', (int)$id)
            ->first();

        return view(
            'pages/customer/subscription/cancel.page.php',
            [
                'paymentMethods' => $paymentMethods,
                'subscriptions' => $subscriptions,
                'mySubscription' => $mySubscription ?? []
            ]
        );
    }

    public function submitCancelRequest(int $id)
    {
        helper('form');

        if (!$this->validate([
            'terms_and_conditions' => ['label' => 'terms and conditions', 'rules' => 'required'],
            'email_notification' => ['email notification' => 'terms and conditions', 'rules' => 'permit_empty'],
            'reason' => ['label' => 'reason', 'rules' => 'required|max_length[255]'],
            'feedback' => ['label' => 'feedback', 'rules' => 'required|max_length[255]'],
        ])) {
            return $this->cancel($id);
        }

        $cancellationData = $this->validator->getValidated();

        $model = model(CustomerRequest::class);
        $feedback = model(Feedback::class);
        $subscription = model(CustomerSubscription::class);

        $this->db->transStart();
        try {
            $model->save([
                'customer_id' => auth()->user()->id,
                'type' => 'subscription_cancellation',
                'payload' => json_encode([
                    'email' => $cancellationData['email_notification'] ? 1 : 0,
                    'reason' => $cancellationData['reason'],
                    'feedback' => $cancellationData['feedback']
                ])
            ]);

            $feedback->save([
                'customer_id' => auth()->user()->id,
                'feedback' => $cancellationData['feedback']
            ]);

            $subscription->update($id, [
                'status' => 'cancelled'
            ]);

            $this->db->transCommit();
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return redirect()->back()->with('error', 'Transaction failed: ' . $e->getMessage());
        }



        return redirect()->back()->with('success', 'You have successfully requested to cancel the subscription.');
    }


    public function suspend(int $id): string
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
                'payment_methods.method as payment_method_name'
            ])
            ->join('subscriptions', 'subscriptions.id = customer_subscriptions.subscription_id')
            ->join('payment_methods', 'payment_methods.id = customer_subscriptions.payment_method')
            ->where('customer_id', auth()->user()->id)
            ->where('customer_subscriptions.id', (int)$id)
            ->first();

        return view(
            'pages/customer/subscription/suspend.page.php',
            [
                'paymentMethods' => $paymentMethods,
                'subscriptions' => $subscriptions,
                'mySubscription' => $mySubscription ?? []
            ]
        );
    }

    public function submitSuspendRequest(int $id): string|RedirectResponse
    {
        helper('form');

        if (!$this->validate([
            'terms_and_conditions' => ['label' => 'terms and conditions', 'rules' => 'required'],
            'reason' => ['label' => 'reason', 'rules' => 'required|max_length[255]'],
            'additional_comment' => ['label' => 'additional comment', 'rules' => 'max_length[255]'],
            'from' => ['label' => 'start date', 'rules' => 'required|valid_date'],
            'to'   => ['label' => 'end date', 'rules' => 'required|valid_date'],
        ])) {
            return $this->suspend($id);
        }

        $cancellationData = $this->validator->getValidated();

        $model = model(CustomerRequest::class);
        $subscription = model(CustomerSubscription::class);

        $this->db->transStart();
        try {
            $model->save([
                'customer_id' => auth()->user()->id,
                'type' => 'subscription_suspend',
                'payload' => json_encode([
                    'reason' => $cancellationData['reason'],
                    'additional_comment' => $cancellationData['additional_comment'],
                    'from' => $cancellationData['from'],
                    'to' => $cancellationData['to']
                ])
            ]);


            $subscription->update($id, [
                'status' => 'suspended'
            ]);

            $this->db->transCommit();
        } catch (Exception $e) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Transaction failed: ' . $e->getMessage());
        }



        return redirect()->back()->with('success', 'You have successfully requested to cancel the subscription.');
    }

    
}
