<?php

namespace Ylly\MediaManagerBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;

use Ylly\CmsBundle\Entity\Site;

use Ylly\Extension\TeamBundle\Entity\Worker;

use Symfony\Bundle\FrameworkBundle\Templating\Helper\AssetsHelper;

use Ylly\MediaManagerBundle\Enums\MediaType;

use Ylly\MediaManagerBundle\MediaManagerUpload\MediaManagerUpload;

use Symfony\Bundle\ZendBundle\Logger\Logger;

use Ylly\MediaManagerBundle\Entity\Media;

use Ylly\MediaManagerBundle\Form\Admin\MediaForm;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Admin Controller to manager Media Library
 * @author Jordan Samouh <lifeextension25@gmail.com>
 *
 */
class AdminController extends Controller
{
    /**
     * Index Action Homepage
     */
    public function indexAction()
    {
    	/** Filters session initialisation**/
    	if ($this->get('request')->get('field_name', null))
    	{
    	   $this->get('request')->getSession()->set('media_manager_filters_field_name',   $this->get('request')->get('field_name'));	
           $this->get('request')->getSession()->set('media_manager_filters_crop_width',   $this->get('request')->get('crop_width'));
           $this->get('request')->getSession()->set('media_manager_filters_crop_height',  $this->get('request')->get('crop_height'));
    	}
    	
    	$medias        = $this->get('media_manager.manager')->findAllMedias();
    	$medias        = $this->get('media_manager.manager')->findAllMedias();
    	$association  = $this->get('request')->get('association', false);
        return $this->render('MediaManagerBundle:Admin:index.html.twig', array('medias' => $medias, 'association' => true));
    }

    /**
     * Add Action Media Upload
     */
    public function addAction()
    {
    	$form       = MediaForm::create($this->get('form.context'), 'media');

    	return $this->render('MediaManagerBundle:Admin:form.html.twig', array('form' => $form, 'media' => new Media()));
    }
    
    /**
     * Add Action Media Upload
     */
    public function editAction()
    {
        $form        = MediaForm::create($this->get('form.context'), 'media');
        $media       = $this->get('media_manager.manager')->findOneById($this->get('request')->get('media_id'));
        
        $form->bind($this->get('request'), $media);
        
        return $this->render('MediaManagerBundle:Admin:form.html.twig', array('form' => $form, 'media' => $media));
    }
    
    
    /**
     * Add Action Media Upload
     */
    public function saveAction()
    {
        $form        = MediaForm::create($this->get('form.context'), 'media');
        $media       = ($this->get('request')->get('media_id', null)) ? $this->get('media_manager.manager')->findOneById($this->get('request')->get('media_id')) : $this->get('media_manager.manager')->createMedia();
               
        if (!$media->getId()) $media->setCreatedAt(new \DateTime('now'));
        $media->setUpdatedAt(new \DateTime('now'));
        $media->setType(MediaType::IMAGE);
        
        $form->bind($this->get('request'), $media);

        if ('POST' == $this->get('request')->getMethod()) 
        {
            if ($form->isValid())
            {
            	$this->processAddingMediaFile($media);
                $this->get('session')->setFlash('message-notice', 'Your media has been created');
                return new RedirectResponse($this->get('media_manager.manager')->generateUrl('media_manager_homepage', array()));
            }
        }
        
        return $this->render('MediaManagerBundle:Admin:form.html.twig', array('form' => $form));
    }
    
    /**
     * Batch actions for Admin view : delete action for the moment
     */
    public function batchAction()
    {
    	$actions  = $this->get('request')->get('actions');
    	$em       =  $this->get('doctrine.orm.entity_manager');
    	
    	if ($this->get('request')->get('action_name') == '_delete')
    	{
	        foreach($actions as $value)
	        {
	            $media = $this->get('media_manager.manager')->findOneById($value);
	            $em->remove($media);
	        }
	        $em->flush();
          }
         return new RedirectResponse($this->get('media_manager.manager')->generateUrl('media_manager_homepage', array()));
    }
    
    public function listAction()
    {
    	$medias           = $this->get('request')->get('medias', array());
    	$field_name       = $this->get('request')->getSession()->get('media_manager_filters_field_name', $this->get('request')->get('field_name'));
    	$result           = array();
    	
        if (is_array($medias))
        {
	        foreach($medias as $id)
	        {
	           $media = $this->get('media_manager.manager')->findOneById($id);
	           $result[] = $media;  
	        }
        }
        
    	return $this->render('MediaManagerBundle:Admin:list.html.twig', array('medias' => $result, 'field_name' => $field_name));
    }
    
    
    /**
     * This function gets the post value (relative url) and create media objects
     * FIX ME : MUST BE REFACTOR cause fucking uploadify session uploads.... and document root cheating....
     */
    protected function processAddingMediaFile($media)
    {
    	$images       = $this->get('request')->get('images', array());
    	$em             = $this->get('doctrine.orm.entity_manager');
        $crop_width  = $this->get('request')->getSession()->get('media_manager_filters_crop_width',   null);
        $crop_height = $this->get('request')->getSession()->get('media_manager_filters_crop_height',  null);
    	foreach ($images as $key => $url)
    	{
            $new_media                   =  ($media->getId()) ? $media : clone $media;
            $media_manager_upload = new MediaManagerUpload($new_media);
            $media_manager_upload->loadMediaSourceFromRelativeUrl($_SERVER["DOCUMENT_ROOT"].$url, array('crop_width' => $crop_width, 'crop_height' => $crop_height));
            $new_media                   = $media_manager_upload->getMedia();

    		$em->persist($new_media);
    	}
    	$em->flush();
    }
    
    
    
}
