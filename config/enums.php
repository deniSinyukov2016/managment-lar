<?php

return [
    'ideas'    => [
        'statuses' => [
            'NOT_WATCHED' => 'not watched',
            'WATCHED'     => 'watched',
            'IN_PROGRESS' => 'in progress',
            'DONE'        => 'done',
            'CANCELED'    => 'canceled'
        ]
    ],
    'projects' => [
        'statuses' => [
            'ACTIVE'         => 'Active',
            'PAUSE'          => 'Pause',
            'WAIT_FEEDBACK'  => 'Wait feedback',
            'DONE'           => 'Done',
            'CLOSE'          => 'Close',
            'NEED_ESTIMATES' => 'Need estimates',
            'IN_QUEUE'       => 'In queue'
        ],
        'priorities' => [
            'VERY_HIGH' => 'Very High',
            'HIGH'      => 'High',
            'MIDDLE'    => 'Middle',
            'LOW'       => 'Low'
        ],
        'types' => [
            'FIXED' => 'Fixed',
            'ONGOING' => 'Ongoing'
        ]
    ]
];
