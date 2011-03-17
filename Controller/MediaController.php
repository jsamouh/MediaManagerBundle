<?php

namespace Ylly\MediaManagerBundle\Controller;



use Imagine\Image\Box;

use Imagine\Image\Point;

use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpFoundation\Response;

use Ylly\MediaManagerBundle\MediaManagerUpload\MediaManagerUpload;

use Zend\GData\App\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MediaController extends Controller
{
    /**
     * action to get the Media thumbnail according to format
     */
    public function viewformatAction()
    {
        $media    = $this->get('media_manager.manager')->findOneById($this->get('request')->get('media_id'));
        $format   = $this->get('doctrine.orm.entity_manager')->getRepository('Ylly\MediaManagerBundle\Entity\MediaFormat')->findOneByLabel($this->get('request')->get('format'));
        if (!$media)
        {
            throw new HttpException('The media does not exist anymore');
        }
        if (!$format)
        {
        	throw new HttpException('The format : '.$this->get('request')->get('format').' does not exist anymore');
        }
        return $this->createResponseMedia($media, file_get_contents(MediaManagerUpload::getSourceMediaFormat($format, $media)));
    }
	
    /**
     * action to get the Media thumbnail
     */
    public function viewAction()
    {
        $media    = $this->get('media_manager.manager')->findOneById($this->get('request')->get('media_id'));
        if (!$media)
        {
            throw new HttpException('The media does not exist anymore');
        }
        return $this->createResponseMedia($media, $media->getThumbnailSource());
    }
    
    /**
     * Action to get the Media Original Format
     */
    public function viewOriginalAction()
    {
    	$media    = $this->get('media_manager.manager')->findOneById($this->get('request')->get('media_id'));
        if (!$media)
        {
            throw new HttpException('The media does not exist anymore');
        }
        return $this->createResponseMedia($media, $media->getSource());
    }
    
    /**
     * Action to crop the Image Media
     */
    public function cropAction()
    {
    	$width           = $this->get('request')->get('w');
    	$height          = $this->get('request')->get('h');
    	$x                 = $this->get('request')->get('x');
    	$y                 = $this->get('request')->get('y');
    	$media_id      = $this->get('request')->get('media_id');
        $em               = $this->get('doctrine.orm.entity_manager');
        $media    = $this->get('media_manager.manager')->findOneById($media_id);
    	
        $imagine                    = new \Imagine\Gd\Imagine();
        $file_temp                  = MediaManagerUpload::createTemporaryFile($media);
        $image                       = $imagine->open(MediaManagerUpload::createTemporaryFile($media));
        $image->crop(new Point($x, $y), new Box($width, $height))->save($file_temp.$media->getExtension());

        $media_manager_upload = new MediaManagerUpload($media);
        $media_manager_upload->setFormats($em->getRepository('\Ylly\MediaManagerBundle\Entity\MediaFormat')->findAll());
        $media_manager_upload->loadMediaSourceFromRelativeUrl($file_temp.$media->getExtension());
        $media = $media_manager_upload->getMedia();
        $em->persist($media);
        $em->flush();
      
        return new RedirectResponse($this->get('media_manager.manager')->generateUrl('media_manager_edit_media', array('media_id'  => $media->getId())));
    }
    
    
    /**
     * create Response media HTTP Header cache setted
     */
    protected function createResponseMedia($media, $source)
    {        
        $date = clone $media->getUpdatedAt();
        $date->setTimezone(new \DateTimeZone('UTC'));

        $headers = array(   'Content-Type'      =>  $media->getMimeType(),
                                            'Content-Length'    =>  strlen($source));
        
        return new Response($source, 200, $headers);
    }
    
}
