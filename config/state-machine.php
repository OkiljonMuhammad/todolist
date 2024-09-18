<?php

return [
    'item_graph' => [
        'class' => Modules\Items\Models\Item::class, 
        'property_path' => 'status',  

        'states' => [
            'new',         
            'in_progress', 
            'completed',   
            'archived',    
            'canceled',    
        ],

        'transitions' => [
            'start' => [
                'from' => ['new'],
                'to' => 'in_progress',
            ],
            'complete' => [
                'from' => ['in_progress'],
                'to' => 'completed',
            ],
            'archive' => [
                'from' => ['completed'],
                'to' => 'archived',
            ],
            'cancel' => [
                'from' => ['new', 'in_progress'],
                'to' => 'canceled',
            ],
            'restore' => [
                'from' => ['archived', 'canceled'],
                'to' => 'new',
            ],
        ],
    ],
];
