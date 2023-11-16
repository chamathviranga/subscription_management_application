<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaymentMethod;
use App\Models\CustomerSubscription;

class CustomerSubscriptionsController extends BaseController
{
    public function index(): string
    {
        return view('pages/customer/subscription/list.page.php');
    }

    public function create(): string
    {
        helper('form');

        $paymentMethodsModel = new PaymentMethod();
        $paymentMethods = $paymentMethodsModel->findAll();

        return view('pages/customer/subscription/register.page.php', ['paymentMethods' => $paymentMethods]);
    }

    public function submit()
    {
        helper('form');

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validate([
            'name' => ['label'=> 'name', 'rules' => 'required|max_length[50]|min_length[3]'],
            'email'  => ['label'=> 'email', 'rules' => 'required|max_length[100]|valid_email'],
            'phone'  => ['label'=> 'phone', 'rules' => 'required|numeric|max_length[10]'],
            'billing_street'  => ['label'=> 'billing street', 'rules' => 'required|max_length[100]'],
            'billing_city'  => ['label'=> 'billing city', 'rules' => 'required|max_length[100]'],
            'billing_state'  => ['label'=> 'billing state', 'rules' => 'required|max_length[100]'],
            'billing_postal_code'  => ['label'=> 'billing postal code', 'rules' => 'required|max_length[10]'],
            'billing_country'  => ['label'=> 'billing country', 'rules' => 'required|max_length[50]'],
            'payment_method' => ['label'=> 'payment method', 'rules' => 'required|numeric'],
            'terms_and_conditions' => ['label' => 'terms and conditions', 'rules' => 'required|is_checkbox']
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
            'payment_method' => $subscriptionData['payment_method'],
        ]);

        return redirect()->back()->with('success', 'You successfully made a subscription.');
    }
}
