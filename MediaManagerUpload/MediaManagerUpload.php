<?php
namespace Ylly\MediaManagerBundle\MediaManagerUpload;


/**
 * This class helps you to do local/remote upload and return a Media Object setted correctly
 * @author Jordan Samouh <lifeextension25@gmail.com>
 * version 1.0
 */
use Imagine\Gd\Imagine;
use Imagine\Box;
use Symfony\Component\HttpFoundation\File\File;


class MediaManagerUpload
{
	/**
	 * media Object
	 * @var Media $media
	 */
	private $media = null;
	
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
        
		if (isset($options['crop_width']) && isset($options['crop_height']))
        {
            $imagine                    = new Imagine();
            $image                       = $imagine->open($relative_url);
            $relative_url                = $relative_url.$file->getExtension();
            $image->resize(new Box($options['crop_width'], $options['crop_height']))->save($relative_url);
        }
		
		$media = $this->media;
		$media->setMimeType($file->getMimeType());
		$media->setExtension($file->getExtension());
		$media->setSize(filesize($relative_url));
		$data = file_get_contents($relative_url);
		$media->setSource($data);
		
		// resize the image to have a thumbnail preview
		/** FIX ME DEPENDENCY **/
		$imagine                    = new Imagine();
        $image                       = $imagine->open($relative_url);
        $thumbnail_relative_url = $file->getDirectory().'/mini_'.$file->getName();
        $image->resize(new Box(70, 70))->save($thumbnail_relative_url);
        $data                          = file_get_contents($thumbnail_relative_url);
        $media->setThumbnailSource($data);
        
		$this->media = $media;
	}
	
	public static function createTemporaryFile($media, $method='getSource')
	{
        $file_temp = tempnam('tmp/', 'tmp');
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