<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2.10.2014
 * Time: 11:27
 */

namespace Webron\CoreBundle\Classes;


class WebronGraph {

    private $title;
    private $labels;
    private $values;
    private $type;
    private $datasets;

    public function __construct($type, $title=''){
        $this->type = $type;
        $this->title[0] = $title;
        $this->values[0] = '';
        $this->datasets = 0;
    }

    public function setTitle($title,$dataset=0){
        $this->title[$dataset] = $title;
    }

    public function add($label, $value, $dataset=0){
        if(!empty($label)) $this->labels[] = $label;
        $this->values[$dataset][] = $value;
    }

    public function addDataset($title=''){
        $this->datasets++;
        $this->values[$this->datasets] = array();
        $this->title[$this->datasets] = $title;
    }

    public function printToArray(){
        $fun = 'printToArray' . ucfirst($this->type);
        return $this->$fun();
    }

    private function printToArrayLine(){
        $pom = array();
        $pom['labels'] = $this->labels;
        $values = $this->values;
        if(!empty($values)){
            for($i=0; $i<=$this->datasets; $i++){
                $pom['datasets'][$i]['label'] = $this->title[$i];
                $pom['datasets'][$i]['data'] = $this->values[$i];
            }
        }
        $retval[$this->type] = $pom;
        return $retval;
    }

    private function printToArrayDoughnut(){
        $retval[$this->type] = array();
        if(!empty($this->values[0])){
            foreach($this->values[0] as $key=>$value){
                if(!empty($this->labels[$key]))  $retval[$this->type][] = array('label'=>$this->labels[$key], 'value'=>$value, 'id'=>$this->labels[$key]);
            }
        }
        return $retval;
    }

    public function addMonthsLineGraph($arr, $values){
        reset($arr);
        $yearStart =  key($arr);
        if(empty($yearStart)) return $arr;
        reset($arr[$yearStart]);
        $monthStart = key($arr[$yearStart]);
        end($arr);
        $yearEnd =  key($arr);
        for($year=$yearStart; $year<=$yearEnd; $year++){
            if(empty($arr[$year])) $arr[$year] = array();
            end($arr[$year]);
            if($year==$yearEnd){
                $monthEnd = key($arr[$year]);
                $monthStart = 1;
            } else {
                $monthEnd = 12;
            }
            for($month=$monthStart; $month<=$monthEnd; $month++){
                foreach($values as $key=>$value){
                    if(empty($arr[$year][$month][$value])) $arr[$year][$month][$value] = 0;
                }
            }
        }

        if(!empty($arr)){
            foreach($arr as $key=>$value){
                ksort($arr[$key]);
            }
        }
        ksort($arr);
        return $arr;
    }

    public function sliceMaxMonths($arr,$max){
        if(count($arr)==1) return $arr;
        reset($arr);
        $minYear = key($arr);
        end($arr);
        $maxYear = key($arr);
        $months = count($arr[$maxYear]);
        $monthsToErase = $months;
        for($j=$maxYear-1; $j>=$minYear; $j--){
            if($j!=$maxYear-1) $monthsToErase = 12;
            for($i=1; $i<=$monthsToErase; $i++){
                if(!empty($arr[$j][$i])){
                    unset($arr[$j][$i]);
                }
            }
        }
        return $arr;
    }

} 