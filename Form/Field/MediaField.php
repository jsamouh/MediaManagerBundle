<?php

namespace yProx\MediaManagerBundle\Form\Field;

use Symfony\Component\Form\Field;

/**
 * Define Media Field
 * @author Jordan Samouh <lifeextension25@gmail.com>
 * @version 1.0
 */
class MediaField extends Field
{
    public function __construct($key, array $options = array())
    {
        $this->addOption('crop_width',  isset($options['crop_width']) ? $options['crop_width'] : null);
        $this->addOption('crop_height', isset($options['crop_height']) ? $options['crop_height'] : null);
        parent::__construct($key, $options);
    }
}
