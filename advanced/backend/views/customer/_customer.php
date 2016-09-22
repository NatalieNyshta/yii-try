<?php
echo \yii\widgets\DetailView::widget(
    [
        'model' => $model,
        'attributes' => [
            ['attribute' => 'name'],
            ['attribute' => 'birth_date', 'value' => $model->birthDate->format('Y-m-d')],
            'notes:text',
            ['attribute' => 'phones.0.number', 'label' => 'Phone Number']
        ]
    ]);