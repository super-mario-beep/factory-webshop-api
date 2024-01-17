<?php

namespace App\Services;

use App\Models\CustomerInformation;

class CustomerInformationService
{
    public function saveCustomerInformation($order, $contactData)
    {
        if (!empty($contactData)) {
            $customerInformation = new CustomerInformation([
                'order_id' => $order->getKey(),
                'customer_name' => $contactData['name'],
                'email' => $contactData['email'],
                'phone_number' => $contactData['phone_number'],
                'address' => $contactData['address'],
                'city' => $contactData['city'],
                'country' => $contactData['country'],
            ]);

            $customerInformation->save();
        }
    }
}