<?php

use Modules\Items\Models\Item as ItemModel;

return [
    'item_graph' => [
        'class' => ItemModel::class,  
        'property_path' => 'status',

        'states' => [
            ItemModel::STATUS_PENDING,       
            ItemModel::STATUS_IN_PROGRESS,
            ItemModel::STATUS_COMPLETED,
            ItemModel::STATUS_ARCHIVED,
            ItemModel::STATUS_CANCELED,
        ],

        'transitions' => [
            'start' => [
                'from' => [ItemModel::STATUS_PENDING],
                'to' => ItemModel::STATUS_IN_PROGRESS,
            ],
            'complete' => [
                'from' => [ItemModel::STATUS_IN_PROGRESS],
                'to' => ItemModel::STATUS_COMPLETED,
            ],
            'archive' => [
                'from' => [ItemModel::STATUS_COMPLETED],
                'to' => ItemModel::STATUS_ARCHIVED,
            ],
            'cancel' => [
                'from' => [ItemModel::STATUS_PENDING, ItemModel::STATUS_IN_PROGRESS],
                'to' => ItemModel::STATUS_CANCELED,
            ],
            'restore' => [
                'from' => [ItemModel::STATUS_ARCHIVED, ItemModel::STATUS_CANCELED],
                'to' => ItemModel::STATUS_PENDING,
            ],
        ],
    ],
];
