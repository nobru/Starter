<?php

namespace Starter\UserBundle\Filter;

use Doctrine\ORM\Mapping\ClassMetaData;  
use Doctrine\ORM\Query\Filter\SQLFilter;  


class AccountCheckFilter extends SQLFilter
{
    protected $reader;

    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        $account    = $this->getParameter('account');
        $properties = $targetEntity->getReflectionProperties();
        
        $dql = '';

        if (isset($properties['account'])) {
            $dql = $targetTableAlias . '.account = ' . $account;
        }

        return $dql;
    }
}