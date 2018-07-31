<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 07.02.18
 * Time: 16:58
 */

namespace Obvu\Modules\Api\Admin\responses\file;

/**
 * @SWG\Definition()
 */
class UploadFileResponse
{
    /**
     * @var int
     * @SWG\Property()
     * Идентификатор файла
     */
    public $fileId;

    /**
     * @var string
     * @SWG\Property()
     * URL опубликованного файла
     */
    public $fullUrl;
}
