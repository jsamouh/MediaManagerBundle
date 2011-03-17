<?php

namespace Ylly\MediaManagerBundle\Entity;

/**
 * Media Format Entity Definition
 * @author Jordan Samouh <lifeextension25@gmail.com>
 * @orm:Entity
 * @orm:Table(name="media_format") 
 */
class MediaFormat
{
	/**
	 * unique identifier
	 * @orm:Id
	 * @orm:Column(type="integer")
	 * @orm:GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;
	
	/**
	 * format label
	 * @orm:Column(name="label", type="string", length=255)
	 */
	protected $label;
	
	/**
	 * format width
	 * @orm:Column(name="width", type="integer")
	 */
	protected $width;
	
	/**
	 * format height
	 * @orm:Column(name="height", type="integer")
	 */
	protected $height;
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setLabel($label)
	{
		$this->label = $label;
	}
	
	public function getLabel()
	{
		return $this->label;
	}
	
	public function setWidth($width)
	{
		$this->width = $width;
	}
	
	public function getWidth()
	{
		return $this->width;
	}
	
    public function setHeight($height)
    {
        $this->height = $height;
    }
    
    public function getHeight()
    {
        return $this->height;
    }	
	    
}