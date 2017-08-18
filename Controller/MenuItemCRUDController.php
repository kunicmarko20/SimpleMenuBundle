<?php

namespace KunicMarko\SimpleMenuBundle\Controller;

use KunicMarko\SimpleMenuBundle\Entity\MenuItem;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MenuItemCRUDController extends CRUDController
{
    public function treeUpAction()
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException('Object not found.');
        }

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(MenuItem::class);

        if ($object->getParent()) {
            $repo->moveUp($object);
        }
        return $this->redirect($this->getRequest()->headers->get('referer'));
    }

    public function treeDownAction()
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException('Object not found.');
        }

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(MenuItem::class);

        if ($object->getParent()) {
            $repo->moveDown($object);
        }
        return $this->redirect($this->getRequest()->headers->get('referer'));
    }
}
