<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:03
 */

namespace Obvu\Modules\Api\Admin\submodules\content\models\post;

use Obvu\Modules\Api\Admin\submodules\content\models\postCategory\PostCategoryModel;
use Zvinger\BaseClasses\app\helpers\fakeData\DataFakerGenerator;
use Zvinger\BaseClasses\app\helpers\fakeData\FakeFilledInterface;

/**
 * Class PostModel
 * @package Obvu\Modules\Api\Admin\submodules\content\models\post
 * @SWG\Definition()
 */
class AdminPostModel implements FakeFilledInterface
{
    /**
     * @var int
     * @SWG\Property()
     */
    public $id;

    /**
     * @var string
     * @SWG\Property()
     */
    public $slug;

    /**
     * @var string
     * @SWG\Property()
     */
    public $text;

    /**
     * @var string
     * @SWG\Property()
     */
    public $title;

    /**
     * @var PostCategoryModel
     * @SWG\Property()
     */
    public $category;

    public function fillFakeData()
    {
        $faker = DataFakerGenerator::go();
        $this->id = $faker->randomDigitNotNull;
        $this->slug = $faker->text(5);
        $this->text = $faker->text(40);
    }
}