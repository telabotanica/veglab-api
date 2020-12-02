<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Controller\AbstractBulkAction;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Custom endpoint action on Photo resources for bulk actions (JSON-PATCH). 
 * Currently, 'add', 'remove', 'replace' and 'copy' (clone) atomic operations 
 * are allowed. 
 *
 * @package App\Controller
 */
class PhotoBulkAction extends AbstractBulkAction {

    protected $doctrine;
    
    /**
     * @param ManagerRegistry $doctrine The injected 
     *        <code>ManagerRegistry</code> service
     */
    public function __construct(
        ManagerRegistry $doctrine) {
        $this->doctrine = $doctrine;
    }

    /**
     * @inheritdoc
     */
    protected function initForm($entity) {
        $this->form = $this->formFactory->create(Photo::class, $entity);
    }

    /**
     * @inheritdoc
     */
    protected function initRepo() {
        $this->repo = $this->doctrine->getRepository('App\Entity\Photo');
    }
  
}


