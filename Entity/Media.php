<?php

namespace Ylly\MediaManagerBundle\Entity;

/**
 * Media Entity Definition
 * @author Jordan Samouh <lifeextension25@gmail.com>
 * @orm:Entity
 * @orm:Table(name="media") 
 */
use Doctrine\Common\Collections\ArrayCollection;

class Media
{
	/**
	 * unique identifier
	 * @orm:Id
	 * @orm:Column(type="integer")
	 * @orm:GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;
	
	/**
	 * title of media
	 * @orm:Column(name="name", type="string", length=255)
	 */
	protected $title;
	
	/**
	 * description of media
	 * @orm:Column(name="description", type="string", length=1000)
	 */
	protected $description;
	
	/**
	 * source must be data content / absolute url --> original Source
	 * @orm:Column(name="source", type="longblob")
	 */
	protected $source;
	
    /**
     * source must be data content / absolute url --> thumbnail Source
     * @orm:Column(name="thumbnailSource", type="longblob")
     */
    protected $thumbnailSource;
	
	
	/**
	 * type to define type of media 
	 * @orm:Column(name="type", type="string", value="image")
	 */
	protected $type;
	
	/**
	 * mime_tpe of media
	 * @orm:Column(name="mime_type", type="string", length=255)
	 */
	protected $mime_type;
	
    /**
     * extension of media
     * @orm:Column(name="extension", type="string", length=255)
     */
    protected $extension;
    
    /**
     * size of media
     * @orm:Column(name="size", type="integer")
     */
    protected $size;    
    
    /**
     * @gedmo:Timestampable(on="create")
     * @orm:Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @gedmo:Timestampable(on="update")
     * @orm:Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;
           
	public function __construct()
	{
	}
	
	
    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set source
     *
     * @param longblob $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * Get Thumbnail source
     *
     * @return longblob $source
     */
    public function getThumbnailSource()
    {
        return $this->thumbnailSource;
    }
    
    /**
     * Set Thumbnail source
     *
     * @param longblob $source
     */
    public function setThumbnailSource($thumbnailSource)
    {
        $this->thumbnailSource = $thumbnailSource;
    }

    /**
     * Get source
     *
     * @return longblob $source
     */
    public function getSource()
    {
        return $this->source;
    }
    
    
    

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set mime_type
     *
     * @param string $mimeType
     */
    public function setMimeType($mimeType)
    {
        $this->mime_type = $mimeType;
    }

    /**
     * Get mime_type
     *
     * @return string $mimeType
     */
    public function getMimeType()
    {
        return $this->mime_type;
    }

    /**
     * Set extension
     *
     * @param string $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    /**
     * Get extension
     *
     * @return string $extension
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set size
     *
     * @param integer $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * Get size
     *
     * @return integer $size
     */
    public function getSize()
    {
        return $this->size;
    }
    
    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
}