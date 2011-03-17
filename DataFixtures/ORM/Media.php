<?php

namespace Ylly\MediaManagerBundle\DataFixtures\ORM;

use Ylly\MediaManagerBundle\Enums\MediaType;

use Ylly\MediaManagerBundle\MediaManagerUpload\MediaManagerUpload;

use Ylly\MediaManagerBundle\Entity\Media;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Ylly\CrmBundle\Entity\Company;
use Ylly\CrmBundle\Entity\Person;
use Ylly\CrmBundle\Entity\User;
use Ylly\CrmBundle\Entity\Note;

/**
 * Data Fixtures Class to load Media example from url et public resources
 * @author Jordan Samouh <lifeextension25@gmail.com>
 *
 */
class LoadMediaData implements FixtureInterface
{
    public function load($manager)
    {
    	$media_1 = new Media();
    	$media_1->setTitle('My First Image');
    	$media_1->setDescription('This is my first image...');
    	$media_1->setType(MediaType::IMAGE);
    	$media_1->setCreatedAt(new \DateTime('now'));
    	$media_1->setUpdatedAt(new \DateTime('now'));
    	
    	$media_manager_upload = new MediaManagerUpload($media_1);
    	$media_manager_upload->loadMediaSourceFromRelativeUrl(dirname(__FILE__).'/../../Resources/public/images/smiley.png');
    	$media_1 = $media_manager_upload->getMedia();
    	
    	$manager->persist($media_1);
    	    	
    	$manager->flush();
    }

}
