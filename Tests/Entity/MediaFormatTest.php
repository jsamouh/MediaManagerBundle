<?php
/**
 * Media Format Test For Media Format Entity Unit Test
 * @author Jordan Samouh <lifeextension25@gmail.com>
 * version 1.0
 */
use Ylly\MediaManagerBundle\Enums\MediaType;
use Ylly\MediaManagerBundle\MediaManagerUpload\MediaManagerUpload;
use Ylly\MediaManagerBundle\Entity\MediaFormat;

class MediaFormatTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * setup object to do unit test
	 */
	public function setup()
	{
		$mediaFormatSmall = new MediaFormat();
		$mediaFormatSmall->setLabel('small');
		$mediaFormatSmall->setWidth(100);
		$mediaFormatSmall->setHeight(100);
		
        $mediaFormatLarge = new MediaFormat();
        $mediaFormatLarge->setLabel('large');
        $mediaFormatLarge->setWidth(800);
        $mediaFormatLarge->setHeight(800);
		
		$this->mediaFormatLarge = $mediaFormatLarge;
		$this->mediaFormatSmall = $mediaFormatSmall;
	}
	
	/**
	 * test Media Format Object function to see if everything is fine...
	 */
	public function testMedia()
	{
		$this->assertEquals('small', $this->mediaFormatSmall->getLabel());
		$this->assertEquals(100, $this->mediaFormatSmall->getWidth());
		$this->assertEquals(100, $this->mediaFormatSmall->getHeight());

        $this->assertEquals('large', $this->mediaFormatLarge->getLabel());
        $this->assertEquals(800, $this->mediaFormatLarge->getWidth());
        $this->assertEquals(800, $this->mediaFormatLarge->getHeight());
	}
}