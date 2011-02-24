<?php

namespace yProx\MediaManagerBundle\Behavior\Fileable\Mapping\Driver;


/**
 * This is an annotation mapping driver for Fileable
 * behavioral extension. Used for extraction of extended
 * metadata from Annotations specificaly for Fileable
 * extension.
 * 
 * @author Jordan Samouh <lifeextension25@gmail.com>
 * @version 1.0
 */
use Doctrine\DBAL\Driver;

use Doctrine\ORM\Mapping\MappingException;

use Doctrine\Common\Annotations\AnnotationReader;

class Annotation implements Driver
{
    /**
     * Annotation to identity translation entity to be used for filable storage
     */
    const ANNOTATION_ENTITY_CLASS = 'Gedmo\Translatable\Mapping\FileableEntity';
    
    
    /**
     * {@inheritDoc}
     */
    public function validateFullMetadata(ClassMetadataInfo $meta, array $config)
    {

    }
    
    /**
     * {@inheritDoc}
     */
    public function readExtendedMetadata(ClassMetadataInfo $meta, array &$config) {
        require_once __DIR__ . '/../Annotations.php';
        $reader = new AnnotationReader();
        $reader->setAnnotationNamespaceAlias('yProx\MediaManagerBundle\Behavior\Fileable\Mapping\\', 'fileable');
        
        $class = $meta->getReflectionClass();
        
        // class annotations
        $classAnnotations = $reader->getClassAnnotations($class);
        if (isset($classAnnotations[self::ANNOTATION_ENTITY_CLASS]))
        {
            $config['fileableClass'] = '\yProx\MediaManagerBundle\Behavior\Fileable\Entity\ObjectHasMedia';
        }
    }
    
}