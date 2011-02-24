<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace yProx\MediaManagerBundle\Doctrine\ValueTransformer;

use Symfony\Component\Form\Configurable;
use Symfony\Component\Form\ValueTransformer\TransformationFailedException;
use Symfony\Component\Form\ValueTransformer\ValueTransformerInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Transforms a Collection into a Choice field used for Multiple Select fields or checkbox groups.
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 */
class CollectionToChoiceTransformer extends Configurable implements ValueTransformerInterface
{
    protected function configure()
    {
        $this->addRequiredOption('em');
        $this->addRequiredOption('className');

        parent::configure();
    }

    /**
     * @param array $ids
     * @param Collection $collection
     */
    public function reverseTransform($ids)
    {
        if (!$ids) {
            $ids = array(); 
        } // arghh

        $collection = new ArrayCollection;

        if (count($ids) == 0) {
            // don't check for collection count, a straight clear doesnt initialize the collection
            return $collection;
        }

        $em = $this->getOption('em');
        $metadata = $em->getClassMetadata($this->getOption('className'));
        $reflField = $metadata->getReflectionProperty($metadata->identifier[0]);

        // @todo: This can be greatly optimized into a single SELECT .. WHERE id IN () query.
        foreach ($ids AS $id) {
            $entity = $em->find($this->getOption('className'), $id);
            if (!$entity) {
                throw  new TransformationFailedException("Selected entity of type '" . $this->getOption('className') . "' by id '" . $id . "' which is not present in the database.");
            }
            $collection->add($entity);
        }

        return $collection;
    }

    /**
     * @param Collection $value
     */
    public function transform($value)
    {
        if (null === $value) {
            return array();
        }

        $metadata = $this->getOption('em')->getClassMetadata($this->getOption('className'));
        $reflField = $metadata->getReflectionProperty($metadata->identifier[0]);

        $ids = array();
        foreach ($value AS $object) {
            $ids[] = (string) $reflField->getValue($object);
        }

        return $ids;
    }
}

