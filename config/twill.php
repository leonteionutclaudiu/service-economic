<?php

return [
    'block_editor' => [
        'use_twill_blocks' => [],
        'crops' => [
            'highlight' => [
                'desktop' => [
                    [
                        'name' => 'desktop',
                        'ratio' => null,
                    ],
                ],
                'mobile' => [
                    [
                        'name' => 'mobile',
                        'ratio' => 1,
                    ],
                ],
                'nocrop' => [
                    [
                        'name' => 'nocrop',
                        'ratio' => null,
                    ],
                ],
            ],
            '16/9' => ['16/9' => [[
                'name' => '16/9',
                'ratio' => 1.7,
            ], ]],
            '3/1' => ['3/1' => [[
                'name' => '3/1',
                'ratio' => 3,
            ], ]],
            '1' => ['1' => [[
                'name' => '1',
                'ratio' => 1,
            ], ]],
        ],
        'files' => ['file_role', 'file_role1', 'file_role2'],
    ],
];
