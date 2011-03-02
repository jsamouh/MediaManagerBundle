<?php

namespace Ylly\MediaManagerBundle\Entity;
/**
 * Enter description here ...
 * @author Jordan Samouh <lifeextension25@gmail.com>
 *
 */
class MediaManager
{
	
	private $entityMedia = null;
	private $formMedia = null;
	
	public function __construct($entityMedia, $formMedia)
	{
		$this->entityMedia = $entityMedia;
		$this->formMedia   = $formMedia;
		
	}
	
	public function getEntityMedia()
	{
		return $this->entityMedia;
	}
	
	public function getFormMedia()
	{
		return $this->formMedia;
	}
}