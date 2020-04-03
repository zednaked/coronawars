<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'access' => 'c,r,u,d',
            'mask-request' => 'c,r,u,d'
        ],
        'deliverer' => [
            'users' => 'r',
            'mask-request' => 'c,r,u'
        ],
        'mask-requester' => [
            'mask-request' => 'c,r,u'
        ],
    ],
    'permission_structure' => [
    /*
        'cru_user' => [
            'profile' => 'c,r,u'
        ],
    */
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
