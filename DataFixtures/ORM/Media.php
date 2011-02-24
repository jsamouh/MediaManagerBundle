<?php

namespace yProx\MediaManagerBundle\DataFixtures\ORM;

use yProx\MediaManagerBundle\Enums\MediaType;

use yProx\MediaManagerBundle\MediaManagerUpload\MediaManagerUpload;

use yProx\MediaManagerBundle\Entity\Media;

use Doctrine\Common\DataFixtures\FixtureInterface;
use yProx\CrmBundle\Entity\Company;
use yProx\CrmBundle\Entity\Person;
use yProx\CrmBundle\Entity\User;
use yProx\CrmBundle\Entity\Note;

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
    	
    	$media_manager_upload = new MediaManagerUpload($media_1);
    	$media_manager_upload->loadMediaSourceFromRelativeUrl(dirname(__FILE__).'/../../Resources/public/images/smiley.png');
    	$media_1 = $media_manager_upload->getMedia();
    	
    	$manager->persist($media_1);
    	
    	/*$media_manager_upload = new MediaManagerUpload();
    	$media_manager_upload->loadMediaSourceFromRemoteUrl('http://www.google.fr/images/nav_logo36.png');
    	
    	$media_2 = $media_manager_upload->getMedia();
    	$media_2->setType(MediaType::IMAGE);
    	$media_2->setTitle('My Second Image');
    	$media_2->setDescription('this is my second image loaded from web');
    	
    	$manager->persist($media_2);*/
    	
    	$manager->flush();
    }

}
