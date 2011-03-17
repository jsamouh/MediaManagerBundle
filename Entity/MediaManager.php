<?php

namespace Ylly\MediaManagerBundle\Entity;
/**
 * MediaManagerClass deals Media Object and useful for DIC
 * @author Jordan Samouh <lifeextension25@gmail.com>
 *
 */
class MediaManager
{
	private $class;
	private $kernel;
	private $container;
	/**
	 * Constructor
	 * @param string $class
	 */
	public function __construct($class, $kernel)
	{
        $this->class         = $class;
        $this->kernel        = $kernel;
        $this->container                    = $kernel->getContainer();
	}
	
	/**
	 * Create a new Media
	 */
	public function createMedia()
	{
		$class = $this->class;
		return new $class();
	}
	
	public function getClass()
	{
		return $this->class;
	}
	
	/** //FIX ME!! : Not the right place.... hack to manage the override
	 * Generate url using router service. Define here to override the redirection in controller
	 * @param string $route
	 * @param array $parameters
	 * @param boolean $absolute
	 */
	public function generateUrl($route, $parameters, $absolute = false)
	{
		return $this->container->get('router')->generate($route, $parameters, $absolute);
	}
	
	/**
	 * Function to get All Medias
	 */
	public function findAllMedias()
	{
		return $this->container->get('doctrine.orm.entity_manager')->getRepository($this->class)->findAll(); 
	}
	
	/**
	 * Function to get one Media By Id
	 * @param integer $id
	 */
	public function findOneById($id)
	{
		return $this->container->get('doctrine.orm.entity_manager')->getRepository($this->class)->findOneById($id);
	}
	
	/**
	 * Function to get One Media By title
	 * @param string $title
	 */
	public function findOneByTitle($title)
	{
		return $this->container->get('doctrine.orm.entity_manager')->getRepository($this->class)->findOneByTitle($title);
	}
	
	
}