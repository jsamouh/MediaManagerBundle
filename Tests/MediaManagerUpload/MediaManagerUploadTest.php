<?php
namespace yProx\MediaManagerBundle\Tests\MediaManagerUpload;

/**
 * MediaManagerUpload Test For MediaManagerUpload Lib Unit Test
 * @author Jordan Samouh <lifeextension25@gmail.com>
 * version 1.0
 */
use yProx\MediaManagerBundle\Enums\MediaType;
use yProx\MediaManagerBundle\MediaManagerUpload\MediaManagerUpload;
use yProx\MediaManagerBundle\Entity\Media;
use yProx\CmsBundle\Test\DoctrineTest;
use Doctrine\DBAL\Types\Type;

class MediaManagerUploadTest extends DoctrineTest
{
	
    public function getClassNames()
    {
        return array(
            'yProx\MediaManagerBundle\Entity\Media'
        );
    }	
	
    /**
     * setup object to do unit test
     */
    public function setup()
    {
        $media = new Media();
        
        $media->setTitle('My First Image');
        $media->setDescription('This is my first Image...');
        $media->setType(MediaType::IMAGE);
        
        $media_manager_upload = new MediaManagerUpload($media);
        $media_manager_upload->loadMediaSourceFromRelativeUrl(dirname(__FILE__).'/../../Resources/public/images/smiley.png');
        
        $media         = $media_manager_upload->getMedia();
        $this->media = $media;
    }
    
    /**
     * test Media Object function to see if everything is fine...
     */
    public function testMediaManagerUpload()
    {
        $this->assertEquals('My First Image', $this->media->getTitle());
        $this->assertEquals(MediaType::IMAGE, $this->media->getType());
        $this->assertEquals('image/png', $this->media->getMimeType());
        $this->assertEquals('.png', $this->media->getExtension());
        
        // check data source not empty
        $this->assertTrue(strlen($this->media->getSource()) > 0);
    }
}
