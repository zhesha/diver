<?php
namespace Diver\PriceLisrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Crawler;
use Diver\PriceLisrBundle\Entity\Items;
use Diver\PriceLisrBundle\Entity\Categories;

class XmlController extends Controller
{
    private $em;
    private $emCat;

    public function indexAction()
    {
        $this->em = $this->getDoctrine()->getManager();
        $this->emCat = $this->getDoctrine()->getManager();
        if(!file_exists(__DIR__.'/../../../../web/upload/dylerprice.xml'))
            throw $this->createNotFoundException('Unable to find file.');

        //$crawler = new Crawler(mb_convert_encoding(file_get_contents(__DIR__.'/../../../../web/upload/dylerprice.xml', true), "UTF-8", 'cp-1251'));
        $crawler = new Crawler(file_get_contents(__DIR__.'/../../../../web/upload/dylerprice.xml', true));

        $crawler = $crawler->filterXPath('descendant-or-self::root/node');
        $arr = $crawler->extract('isgroup');

        foreach($arr as $k=>$v){
            if($v == 1){
                $this->parseCategory($crawler->eq($k), null);
            }
            else{
                $this->parseItem($crawler->eq($k), null);
            }
        }
        //$this->emCat->flush();
        $this->em->flush();
        exit;
    }

    private function parseCategory(Crawler $node, $parent){
        $result = array();
        $cat = new Categories();
        $cat->setName($node->filter('name')->text());
        //echo '<br>category: '.$node->filter('name')->text();
        $cat->setNameRu($node->filter('name_ru')->text());
        $cat->setParent($parent);
        $this->emCat->persist($cat);
        $this->emCat->flush();
        $node = $node->filterXPath('node/node');

        $arr = $node->extract('isgroup');
        foreach($arr as $k=>$v){
            if($v == 1)
                $this->parseCategory($node->eq($k), $cat);
            else
                $this->parseItem($node->eq($k), $cat);
        }
        //return $result;
    }
    private function parseItem(Crawler $node, $cat){
        $result = $node->extract('garant', 'ostatok_lviv', 'ostatok_kyyiv', 'ostatok_odesa');
        $item = new Items();
        $item->setName($node->filter('name')->text());
        //echo '<br>item: '.$node->filter('name')->text();
        $item->setNameRu($node->filter('name_ru')->text());
        $item->setCategory($cat);
        $item->getFullname($node->filter('fullname')->text());
        $item->getPartnumber($node->filter('partnumber')->text());
        $item->getManufacturer($node->filter('manufacturer')->text());
        $this->em->persist($item);
        //$this->em->flush();

        return $result;
    }
}