<?php


namespace Obvu\Modules\Api\Admin\submodules\siteInfo\components\getter;


abstract class BaseSiteInfoDataGetter
{
    abstract protected function currentGetForPage($page, $data = null);

    abstract protected function currentGetBlockInfo($blockName, $data = null);

    abstract protected function currentGetCommonInfo($data = null);

    public function getForPage($page, $data = null)
    {
        return $this->currentGetForPage($page, $data);
    }

    public function getBlockInfo($blockName, $data = null)
    {
        return $this->currentGetForPage($blockName, $data);
    }

    public function getCommonInfo($data = null)
    {
        return $this->currentGetCommonInfo($data);
    }
}