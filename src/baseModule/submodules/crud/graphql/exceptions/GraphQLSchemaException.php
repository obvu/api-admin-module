<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 07.03.2019
 * Time: 16:29
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\graphql\exceptions;


use Throwable;

class GraphQLSchemaException extends \Exception
{
    public $errors;

    public function __construct($errors = [])
    {
        $message = 'GQL Query Error: '.json_encode($errors);
        $this->errors = $errors;
        parent::__construct($message);
    }


}
