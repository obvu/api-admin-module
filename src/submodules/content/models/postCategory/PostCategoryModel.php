<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:03
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\postCategory;

use Zvinger\BaseClasses\app\helpers\fakeData\DataFakerGenerator;
use Zvinger\BaseClasses\app\helpers\fakeData\FakeFilledInterface;

/**
 * Class PostModel
 * @package Obvu\Modules\Api\AdminSubmodules\Content\models\postCategory
 * @SWG\Definition()
 */
class PostCategoryModel implements FakeFilledInterface
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
    public $title;

    /**
     * @var string
     * @SWG\Property()
     */
    public $slug;

    /**
     * @var string
     * @SWG\Property()
     */
    public $description;

    /**
     * @var int
     * @SWG\Property()
     */
    public $postCount;

    public function fillFakeData()
    {
        $faker = DataFakerGenerator::go();
        $this->id = $faker->randomDigitNotNull;
        $this->slug = $faker->text(5);
        $this->title = $faker->text(5);
        $this->description = $faker->text(40);
        $this->postCount = $faker->randomDigitNotNull;
    }
}