<?php

echo \yii\widgets\DetailView::widget(
    [
    'model' => $model,
    'attributes' => [
        ['attribute' => 'name'],
        [
            'attribute' => 'birth_date',
            'value' => $model->getBirthDate()
        ],
        'notes:text',
        ['label' => 'Phone Number', 'attribute' =>
        'phones.0.number']
    ]
]);