<?php

namespace App\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ImageCacheSubscriber implements EventSubscriber {


private $uploader;

private $cache;

    public function __construct(UploaderHelper $uploader, CacheManager  $cache)
    {
        $this->cache = $cache;
        $this->uploader = $uploader;
    }


        public function getSubscribedEvents() {

            return [
                'preRemove',
                'preUpdate'
            ];
        }


    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if(!$entity instanceof Picture){
                return;
 }

 $this->cache->remove($this->uploader->asset($entity, 'imageFile'));

    }

    public function preUpdate(PreUpdateEventArgs $args) {
        $entity = $args->getEntity();
        if(!$entity instanceof Picture){
                return;
 }
       if($entity->getImageFile() instanceof Picture) {

          $this->cache->remove($this->uploader->asset($entity, 'imageFile'));

       }
    }
}