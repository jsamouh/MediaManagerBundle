<?php
namespace Ylly\MediaManagerBundle\MediaManagerUpload;

/**
 * This class helps you to do local/remote upload and return a Media Object setted correctly
 * @author Jordan Samouh <lifeextension25@gmail.com>
 * version 1.0
 */
use Ylly\MediaManagerBundle\Entity\Media;

use Ylly\MediaManagerBundle\Entity\MediaFormat;

use Ylly\MediaManagerBundle\Entity\MediaHasFormat;
use Doctrine\Common\Collections\ArrayCollection;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Symfony\Component\HttpFoundation\File\File;


class MediaManagerUpload
{
	/**
	 * media Object
	 * @var Media $media
	 */
	private $media     = null;
	
	/**
	 * ArrayCollection of MediaFormat Object
	 * @var ArrayCollection $formats
	 */
	private $formats   = null;
	
	/**
	 * Constructor Class
	 * @param Media $media
	 */
	public function __construct($media = null, $model = null)
	{
		if (!$media) $media = new $model();
		$this->media = $media;
	}
	
	/**
	 * loadMediaSourceFromRemoteUrl : get a file remote Url and set build correctly Media Object
	 * @param string $remote_url
	 */
	public function loadMediaSourceFromRemoteUrl($remote_url, $options = array())
	{
		$file_temp = tempnam('tmp/', 'tmp');
        $handle     = fopen($file_temp, "w");
        fwrite($handle, file_get_contents($remote_url));
        fclose($handle);
        $this->loadMediaSourceFromRelativeUrl($file_temp, $options);
	}
	
    /**
     * loadMediaSourceFromRemoteUrl : get a local uploaded file and set build correctly Media Object
     * @param string $relative_url
     */
	public function loadMediaSourceFromRelativeUrl($relative_url, $options = array())
	{
		$file     = new File($relative_url);

		if (isset($options['cropWidth']) && isset($options['cropHeight']))
		{
            $imagine                    = new Imagine();
            $image                       = $imagine->open($file->getPath());
            $box                             = new Box($options['cropWidth'], $options['cropHeight']);
            $image->resize($box)->save($relative_url);
		}
		
		$media = $this->media;
		$media->setMimeType($file->getMimeType());
		$media->setExtension($file->getExtension());
		$media->setSize(filesize($relative_url));
		$media->setSource(file_get_contents($relative_url));
		
		$this->generateAlternativeSource($file);
		$this->media = $media;
	}
	
	
	public function generateAlternativeSource(File $file)
	{
        $imagine                    = new Imagine();
        $image                       = $imagine->open($file->getPath());
        $box                             = new Box(70, 70);
        $temporaryLocation = tempnam('/tmp', 'generation').$file->getExtension();
        
		$image->resize($box)->save($temporaryLocation);
		$this->media->setThumbnailSource(file_get_contents($temporaryLocation));
	}
	
	public static function getSourceMediaFormat(MediaFormat $format, Media $media)
	{
		$file                             = self::createTemporaryFile($media);
        $imagine                    = new Imagine();
        $image                       = $imagine->open($file);
        $box                             = new Box($format->getWidth(), $format->getHeight());
        $temporaryLocation = tempnam('/tmp', 'generation').$media->getExtension();
        
        $image->resize($box)->save($temporaryLocation);
        return $temporaryLocation;
	}
	
	public static function createTemporaryFile($media, $method='getSource')
	{
        $file_temp = tempnam('tmp/', 'generation');
        $handle     = fopen($file_temp, "w");
        fwrite($handle, $media->getSource());
        fclose($handle);
        return $file_temp;
	}
	
	/**
	 * Gets Media object
	 * @return Media
	 */
	public function getMedia()
	{
		return $this->media;
	}
}