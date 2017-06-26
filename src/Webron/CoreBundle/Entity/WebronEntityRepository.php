<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 23.10.2014
 * Time: 21:35
 */

namespace Webron\CoreBundle\Entity;


use Doctrine\ORM\EntityRepository;
use Webron\CoreBundle\Classes\Admin\Section;

class WebronEntityRepository extends EntityRepository{

    protected $type;
    protected $id;

    protected function prepareProfileData(){
        $retval['id'] = $this->id;
        $retval['type'] = $this->type;
        return $retval;
    }

    protected function prepareSection(){
        $section = new Section();
        return $section;
    }

    protected function getSectionObject(){
        return new Section();
    }

    public function getObjectById($id){
        return $this->findOneBy(array('id'=>$id));
    }

    protected function getRepo($name, $special=0)
    {
        if (empty($special)) {
            $repo = $this->_em->getRepository('GoodjobAppBundle:' . ucfirst($name));
        } else {
            $repo = $this->_em->getRepository($special . ':' . ucfirst($name));
        }
        return $repo;
    }

    public function getQBSelect(array $what, array $from, array $where, array $parameters=array(), array $orderBy=array(), $limit=null, array $groupBy=array(), $offset=null) {
        //vytvorenie queryBuildera
        $qb = $this->_em->createQueryBuilder();

        //co sa ma vybrat
        $qb->select($what);

        //odkial sa to ma vybrat
        $from[0] = ucfirst($from[0]);
        if (strpos($from[0], ':') === false) $from[0] = 'EpsCoreBundle:'.$from[0];
        if (empty($from[2])) $from[2] = null;
        $qb->from($from[0], $from[1], $from[2]);

        //podmienky ktore musia platit
        $iter = 0;
        foreach ($where as $wr) {
            if (empty($iter)) $qb->where($wr);
            else $qb->andWhere($wr);
            $iter++;
        }
        if (!empty($parameters)) $qb->setParameters($parameters);

        //podla coho sa to ma zoradit
        $iter = 0;
        foreach ($orderBy as $ob=>$st) {
            if (empty($iter)) $qb->orderBy($ob, $st);
            else $qb->addOrderBy($ob, $st);
            $iter++;
        }

        //maximalny pocet vysledkov
        if (!empty($limit)) $qb->setMaxResults($limit);

        //podla coho sa to ma zoskupit
        $iter = 0;
        foreach ($groupBy as $gb) {
            if (empty($iter)) $qb->groupBy($gb);
            else $qb->addGroupBy($gb);
            $iter++;
        }

        //offset od ktoreho sa vysledky vratia
        if (!empty($offset)) $qb->setFirstResult($offset);

        //vysledky
        return $qb->getQuery()->getResult();
    }

    public function getQBSelectOne(array $what, array $from, array $where, array $parameters=array(), array $orderBy=array(), array $groupBy=array(), $offset=null) {
        $resultArray = $this->getQBSelect($what, $from, $where, $parameters, $orderBy, 1, $groupBy, $offset);
        if (!empty($resultArray[0])) return $resultArray[0];
        return null;
    }
}
