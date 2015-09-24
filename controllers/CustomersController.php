<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\customer\Customer;
use app\models\customer\Phone;
use app\models\customer\CustomerRecord;
use app\models\customer\PhoneRecord;

class CustomersController extends Controller
{
    public function actionIndex()
    {
        // $records = $this->findRecordsByQuery();
        // return $this->render('index', compact('records'));
        return 'action!';
    }

    public function actionAdd()
    {
        $customer = new CustomerRecord;
        $phone = new PhoneRecord;

        if ($this->load($customer, $phone, $_POST))
        {
            $this->store($this->makeCustomer($customer, $phone));
            return $this->redirect('/customers');
        }
        return $this->render('add', compact('customer', 'phone'));
    }

    private function findRecordsByQuery()
    {
        $number = Yii::$app->request->get('phone_number');
        $records = $this->getRecordsByPhoneNumber($number);
        $dataProvider = $this->wrapIntoDataProvider($records);

        return $dataProvider;
    }

    private function load(
        CustomerRecord $customer,
        PhoneRecord $phone,
        array $post
    ){
        return $customer->load($post) && $phone->load($post) &&
        $customer->validate() && $phone->validate(['number']);
    }

    private function store(Customer $customer)
    {
        $customerRecord = new CustomerRecord();
        $customerRecord->name = $customer->name;
        $customerRecord->birth_date = $customer->birthDate->format('Y-m-d');
        $customerRecord->notes = $customer->notes;
        $customerRecord->save();

        foreach ($customer->phones as $phone) {
            $phoneRecord = new PhoneRecord();
            $phoneRecord->number = $phone->number;
            $phoneRecord->customer_id = $customerRecord->id;
            $phoneRecord->save();
        }
    }

    private function makeCustomer(
        CustomerRecord $customerRecord,
        PhoneRecord $phoneRecord
    ) {
        $name = $customerRecord->name;
        $birthDate = new \DateTime($customerRecord->birth_date);

        $customer = new Customer($name, $birthDate);
        $customer->notes = $customerRecord->notes;

        // need to be changed for multiple numbers
        $customer->phones[] = new Phone($phoneRecord->number);
        return $customer;
    }
}
