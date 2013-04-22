<?php
namespace Diver\PriceLisrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class XmlController extends Controller
{

    public function indexAction()
    {
        return $this->render('DiverPriceLisrBundle:Default:index.html.twig');
    }
    public function parseAction()
    {
        $request = $this->getRequest();

        $uploadedFile = $request->files->get('upfile');
        if (null === $uploadedFile)
            return new \Exception('bad file');

        $dir = __DIR__.'/../../../../web/uploads';
        $file = $uploadedFile->getClientOriginalName();

        $uploadedFile->move(
            $dir,
            $file
        );

        $xmlParser = $this->get('xml_parser');
        $xmlParser->parseFromFile($dir.'/'.$file);

        return $this->redirect($this->generateUrl('categories'));
    }
}