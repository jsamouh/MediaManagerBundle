<?php

namespace Ylly\MediaManagerBundle\DataFixtures\ORM;

use Ylly\MediaManagerBundle\Enums\MediaType;

use Ylly\MediaManagerBundle\MediaManagerUpload\MediaManagerUpload;

use Ylly\MediaManagerBundle\Entity\MediaFormat;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Ylly\CrmBundle\Entity\Company;
use Ylly\CrmBundle\Entity\Person;
use Ylly\CrmBundle\Entity\User;
use Ylly\CrmBundle\Entity\Note;

/**
 * Data Fixtures Class to load Media Format example from url et public resources
 * @author Jordan Samouh <lifeextension25@gmail.com>
 *
 */
class LoadMediaFormatData implements FixtureInterface
{
    public function load($manager)
    {
    	$mediaFormat1 = new MediaFormat();
    	$mediaFormat2 = new MediaFormat();
    	$mediaFormat3 = new MediaFormat();
    	$mediaFormat4 = new MediaFormat();
    	$mediaFormat5 = new MediaFormat();
    	
    	$mediaFormat1->setLabel('small');
    	$mediaFormat1->setWidth(80);
    	$mediaFormat1->setHeight(80);

        $mediaFormat2->setLabel('medium');
        $mediaFormat2->setWidth(200);
        $mediaFormat2->setHeight(200);
    	
        $mediaFormat3->setLabel('large');
        $mediaFormat3->setWidth(500);
        $mediaFormat3->setHeight(500);
        
        $mediaFormat4->setLabel('huge');
        $mediaFormat4->setWidth(800);
        $mediaFormat4->setHeight(800);
        
        $mediaFormat5->setLabel('article-medium');
        $mediaFormat5->setWidth(350);
        $mediaFormat5->setHeight(290);
        
        
            	
    	$manager->persist($mediaFormat1);
    	$manager->persist($mediaFormat2);
    	$manager->persist($mediaFormat3);
    	$manager->persist($mediaFormat4);
    	$manager->persist($mediaFormat5);
    	
    	
    	$manager->flush();
    }

}
