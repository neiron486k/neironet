<?php

namespace App\Doctrine\Filter;

use App\Traits\PublishedTrait;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

/**
 * Class PublishedFilter
 * @package App\Doctrine\Filter
 */
class PublishedFilter extends SQLFilter
{

    /**
     * Gets the SQL query part to add to a query.
     *
     * @param ClassMetaData $targetEntity
     * @param string $targetTableAlias
     *
     * @return string The constraint SQL if there is available, empty string otherwise.
     */
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        $traits = $targetEntity->getReflectionClass()->getTraitNames();

        if (!in_array(PublishedTrait::class, $traits)) {
            return '';
        }

        return sprintf('%s.is_published = true', $targetTableAlias);
    }
}