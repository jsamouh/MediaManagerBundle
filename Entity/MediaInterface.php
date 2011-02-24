<?php

namespace yProx\MediaManagerBundle\Entity;

/**
 * Media Interface to implements medias associations
 * @author Jordan Samouh <lifeextension25@gmail.com>
 *
 */
use Doctrine\Common\Collections\ArrayCollection;

interface MediaInterface
{
	public function getMedias();
    public function setMedias(ArrayCollection $medias);
}