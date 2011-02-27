<?php

namespace Ylly\MediaManagerBundle\Form\Admin;

use Symfony\Component\Form\FileField;

use Symfony\Component\Form\HiddenField;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\TextareaField;
use Ylly\CmsBundle\Form\Field\RichTextareaField;
use Symfony\Component\Form\FieldGroup;
use Symfony\Component\Form\CollectionField;

use Ylly\CmsBundle\Inheritance\Form\InheritanceForm;

use Doctrine\ORM\EntityManager;

/**
 * Media Form For Uploading Media
 * @author Jordan Samouh <lifeextension25@gmail.com>
 *
 */
class MediaForm extends Form
{
    public function configure()
    {
        $this->add(new TextField('title'));
        $this->add(new TextareaField('description'));
        $this->add(new FileField('source', array('secret' => true)));
    }
}


