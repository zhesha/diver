<?php
namespace Diver\PriceLisrBundle\XmlParser;

use Symfony\Component\DomCrawler\Crawler;
use Diver\PriceLisrBundle\Entity\Items;
use Diver\PriceLisrBundle\Entity\Categories;
use Doctrine\ORM\EntityManager;

class XmlParser
{
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function parseFromFile($file)
    {
        if(!file_exists($file))
            throw new \Exception('Unable to find file.');
        $this->parse(file_get_contents($file, true));
    }

    public function parse($str)
    {
        $crawler = new Crawler($str);

        $crawler = $crawler->filterXPath('descendant-or-self::root/node');
        $nodes = array();
        foreach($crawler as $v){
            $nodes[] = new Crawler($v, null);
        }
        unset($crawler);
        unset($str);
        foreach($nodes as &$v){
            $isgroup = $v->extract('isgroup');
            if($isgroup[0] == 1){
                $this->parseCategory($v, null);
            }
            unset($v);
        }
        $this->em->flush();
        return true;
    }

    private function parseCategory(Crawler $node, $parent){
        $cat = new Categories();
        $cat->setName($node->filter('name')->text());
        $cat->setNameRu($node->filter('name_ru')->text());
        $cat->setParent($parent);
        unset($parent);
        $this->em->persist($cat);
        $node = $node->filterXPath('node/node');

        $nodes = array();
        foreach($node as $v){
            $nodes[] = new Crawler($v, null);
        }
        unset($node);
        foreach($nodes as &$v){
            $isgroup = $v->extract('isgroup');
            if($isgroup[0] == 1){
                $this->parseCategory($v, $cat);
            }
            else{
                $this->parseItem($v, $cat);
            }
            unset($v);
        }
    }
    private function parseItem(Crawler $node, $cat){
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