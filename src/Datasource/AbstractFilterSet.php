<?php


namespace Lle\CruditBundle\Datasource;


class AbstractFilterSet implements \Lle\CruditBundle\Contracts\FilterSetInterface
{

    public function getFilters(): array
    {
        return [];
    }

    public function getId(): string
    {
        $className = get_class($this);
        return strtolower(str_replace("FilterSet", "", (substr($className, strrpos($className, '\\') + 1))));
    }
}
