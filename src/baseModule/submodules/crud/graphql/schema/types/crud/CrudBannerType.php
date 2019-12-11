<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 06.02.2019
 * Time: 12:15
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\crud;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\Types;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\types\crud\banner\CrudBannerSlideType;

class CrudBannerType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'settings' => new ObjectType(
                        [
                            'name' => 'banner_settings',
                            'fields' => [
                                'fullScreen' => Type::boolean(),
                                'showGradient' => Type::boolean(),
                                'gradientDown' => Type::boolean(),
                                'gradientColor' => Type::string(),
                                'isVideo' => Type::boolean(),
                                'showLeftSticker' => Type::boolean(),
                                'topLeftSticker' => Types::file(),
                            ],
                        ]
                    ),
                    'slides' => [
                        'type' => Type::listOf(CrudBannerSlideType::initType()),
                    ],
                    'fullUrl' => [
                        'type' => Type::string(),
                    ],
                    'video' => [
                        'type' => new ObjectType(
                            [
                                'name' => 'banner_video',
                                'fields' => [
                                    'poster' => Types::file(),
                                    'video_mp4' => Types::file(),
                                    'video_webm' => Types::file(),
                                ],
                            ]
                        ),
                    ],
                ];
            },
        ];


        parent::__construct($config);
    }
}
