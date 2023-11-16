<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Subscription;
use CodeIgniter\HTTP\RedirectResponse;

class SubscriptionsController extends BaseController
{
    // Load subscription list
    public function index(): string
    {
        $subscriptionModel = new Subscription();
        $subscriptions = $subscriptionModel->findAll();

        return view('pages/admin/subscription/subscription_list.page.php', ['subscriptions' => $subscriptions]);
    }

    // Load create new subscription view
    public function create(): string
    {
        helper('form');
        return view('pages/admin/subscription/subscription_create.page.php');
    }

    // Submit new subscription
    public function submit(): string|RedirectResponse
    {
        helper('form');

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validate([
            'name' => 'required|max_length[100]|min_length[3]',
            'description'  => 'required|max_length[255]|min_length[3]',
            'price'  => 'required|numeric',
            'duration'  => 'required|numeric',
        ])) {
            // The validation fails, so returns the form.
            return $this->create();
        }

        // Gets the validated data.
        $subscription = $this->validator->getValidated();

        $model = model(Subscription::class);

        $model->save([
            'name' => $subscription['name'],
            'description'  => $subscription['description'],
            'price'  => $subscription['price'],
            'duration'  => $subscription['duration'],
        ]);

        return redirect()->back()->with('success', "New subscription addedd successfully.");
    }
}
