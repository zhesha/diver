<?php
namespace Diver\PriceLisrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Crawler;
use Diver\PriceLisrBundle\Entity\Items;
use Diver\PriceLisrBundle\Entity\Categories;

class XmlController extends Controller
{

    public function indexAction()
    {
        if(!file_exists(__DIR__.'/../../../../web/upload/dylerprice.xml'))
            throw $this->createNotFoundException('Unable to find file.');

        $crawler = new Crawler(mb_convert_encoding(file_get_contents(__DIR__.'/../../../../web/upload/dylerprice.xml', true), "UTF-8", 'cp-1251'));

        $crawler = $crawler->filterXPath('descendant-or-self::root/node');
        $arr = $crawler->extract('isgroup');

        $categories = array();
        $items = array();
        foreach($arr as $k=>$v){
            if($v == 1)
                $categories[] = $this->parseCategory($crawler->eq($k));
            else
                $items[] = $this->parseItem($crawler->eq($k));
        }
        exit;
    }

    private function parseCategory(Crawler $node){
        $result = array();
        $result['name'] = $node->filter('name')->text();
        $result['name_ru'] = $node->filter('name_ru')->text();
        $node = $node->filterXPath('node/node');

        $arr = $node->extract('isgroup');
        foreach($arr as $k=>$v){
            if($v == 1)
                $this->parseCategory($node->eq($k));
            else
                $this->parseItem($node->eq($k));
        }
        return $result;
    }
    private function parseItem(Crawler $node){
        $result = $node->extract('garant', 'ostatok_lviv', 'ostatok_kyyiv', 'ostatok_odesa');
        $result['name'] = $node->filter('name')->text();
        $result['name_ru'] = $node->filter('name_ru')->text();
        $result['fullname'] = $node->filter('fullname')->text();
        $result['partnumber'] = $node->filter('partnumber')->text();
        $result['manufacturer'] = $node->filter('manufacturer')->text();

        return $result;
    }
}