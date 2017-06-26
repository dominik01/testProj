<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 19.11.2014
 * Time: 9:12
 */

namespace Webron\TreeBundle\Classes;


class WebronTree {

    private $nodes;
    private $counter=0;
    private $tree;
    private $parent=0;

    public function getNodes($tree){
        $this->nodes = array();
        $this->traverseNodes($tree);
        return $this->nodes;
    }

    private function traverseNodes($tree){
        $this->counter++;
        $pom = $tree;
        $this->nodes[] = $pom;
        if(!empty($tree['children'])){
            foreach($tree['children'] as $key=>$value){
                $this->traverseNodes($value);
            }
        } else {
            return 0;
        }
    }

    public function updateIds($nodes, $tree){
        $this->nodes = array();
        $this->counter = 0;
        $this->tree = $tree;
        $this->updateNodes($nodes, $tree);
        $tree = $this->buildTree($this->nodes,0);
        return $tree;
    }

    private function updateNodes($nodes, $tree, $parent=0){
        $tree['id'] = $nodes[$this->counter]['id'];
        $this->counter++;
        $tree['parent'] = $parent;
        $this->nodes[] = $tree;
        if(!empty($tree['children'])){
            foreach($tree['children'] as $key=>$value){
                $this->updateNodes($nodes, $value, $tree['id']);
            }
        } else {
            return 0;
        }
    }

    public function buildTree(array $elements, $parentId = 0) {

        $branch = array();
        foreach ($elements as $element) {
            if(empty($element['parent'])) $element['parent'] = 0;
            if ($element['parent'] === $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

} 