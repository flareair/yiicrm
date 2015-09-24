<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\customer\Customer;
use app\models\customer\Phone;
use app\models\customer\CustomerRecord;
use app\models\customer\PhoneRecord;
use yii\data\ArrayDataProvider;

class CustomersController extends Controller
{
    public function actionIndex()
    {
        $records = $this->findRecordsByQuery();
        return $this->render('index', compact('records'));
    }

    public function actionAdd()
    {
        $customer = new CustomerRecord;
        $phone = new PhoneRecord;

        if ($this->load($customer, $phone, $_POST))
        {
            // var_dump($phone->number);
            $this->store($this->makeCustomer($customer, $phone));
            return $this->redirect('/customers');
        }
        return $this->render('add', compact('customer', 'phone'));
    }

    private function findRecordsByQuery()
    {
        $number = \Yii::$app->request->get('phone_number');

        if (empty($number)) {
            $records = $this->getAllRecords();
        } else {
            $records = $this->getRecordsByPhoneNumber($number);
        }

        $dataProvider = $this->wrapIntoDataProvider($records);

        return $dataProvider;
    }

    private function getRecordsByPhoneNumber($number)
    {
        $phone_record = PhoneRecord::findOne(['number' => $number]);

        if (!$phone_record) {
            return [];
        }

        $customer_record = CustomerRecord::findOne($phone_record->customer_id);
        if (!$customer_record) {
            return [];
        }

        return [$this->makeCustomer($customer_record, $phone_record)];

    }

    private function getAllRecords() {
        $records = CustomerRecord::find()->all();
        foreach ($records as $customerRecord) {
            $phoneRecord = PhoneRecord::findOne(['customer_id' => $customerRecord->id]);
            $result[] = $this->makeCustomer($customerRecord, $phoneRecord);
        }
        return $result;
    }

    private function load(
        CustomerRecord $customer,
        PhoneRecord $phone,
        array $post
    ){
        $isAllRight =  $customer->load($post) && $phone->load($post) &&
        $customer->validate() && $phone->validate(['number']);
        return $isAllRight;
    }

    private function store(Customer $customer)
    {
        echo "<br>";
        $customerRecord = new CustomerRecord();
        $customerRecord->name = $customer->name;
        $customerRecord->birth_date = $customer->getBirthDate();
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
        $customer = new Customer($name);
        $customer->setBirthDate($customerRecord->birth_date);
        $customer->notes = $customerRecord->notes;
        $customer->phones[] = new Phone($phoneRecord->number);
        return $customer;
    }

    private function wrapIntoDataProvider($data)
    {
        return new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => false
        ]);
    }
}
