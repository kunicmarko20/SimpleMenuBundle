<?php

namespace KunicMarko\SimpleMenuBundle\Controller;

use KunicMarko\SimpleMenuBundle\Entity\MenuItem;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MenuItemCRUDController extends CRUDController
{
    /**
     * Pre set parent page when creating new page
     * @param Request $request
     * @param mixed $object
     * @return void
     */
    protected function preCreate(Request $request, $object)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $menuItemRepository = $entityManager->getRepository(MenuItem::class);
        $parent = $menuItemRepository->findOneById($request->query->get('childId'));
        $object->setParent($parent);
    }

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
