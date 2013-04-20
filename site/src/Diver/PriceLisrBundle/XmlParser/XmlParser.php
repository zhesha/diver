<?php
namespace Diver\PriceLisrBundle\XmlParser;

use Symfony\Component\DomCrawler\Crawler;
use Diver\PriceLisrBundle\Entity\Items;
use Diver\PriceLisrBundle\Entity\Categories;
use Doctrine\ORM\EntityManager;

class XmlParser
{
    private $em;
    private $counter = 0;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function parseFromFile()
    {
        if(!file_exists(__DIR__.'/../../../../web/upload/dylerprice.xml'))
            throw new \Exception('Unable to find file.');
        //$crawler = new Crawler(mb_convert_encoding(file_get_contents(__DIR__.'/../../../../web/upload/dylerprice.xml', true), "UTF-8", 'cp-1251'));
        $this->parse(file_get_contents(__DIR__.'/../../../../web/upload/dylerprice.xml', true));
    }

    public function parse($str)
    {
        $crawler = new Crawler($str);

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
        $this->em->flush();
        return true;
    }

    private function parseCategory(Crawler $node, $parent){
        $cat = new Categories();
        $cat->setName($node->filter('name')->text());
        $cat->setNameRu($node->filter('name_ru')->text());
        $cat->setParent($parent);
        $this->em->persist($cat);
        //$this->em->flush();
        $node = $node->filterXPath('node/node');

        $arr = $node->extract('isgroup');
        foreach($arr as $k=>$v){
            if($v == 1)
                $this->parseCategory($node->eq($k), $cat);
            else
                $this->parseItem($node->eq($k), $cat);
        }
    }
    private function parseItem(Crawler $node, $cat){
        $this->counter++;
        if($this->counter > 1000){
            $this->em->flush();
            $this->counter = 0;
        }
        //$result = $node->extract('garant', 'ostatok_lviv', 'ostatok_kyyiv', 'ostatok_odesa');
        $item = new Items();
        $item->setName($node->filter('name')->text());
        $item->setNameRu($node->filter('name_ru')->text());
        $item->setCategory($cat);
        $item->getFullname($node->filter('fullname')->text());
        $item->getPartnumber($node->filter('partnumber')->text());
        $item->getManufacturer($node->filter('manufacturer')->text());
        $this->em->persist($item);
    }
}