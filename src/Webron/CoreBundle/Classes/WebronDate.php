<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2.10.2014
 * Time: 11:27
 */

namespace Webron\CoreBundle\Classes;


class WebronDate {

    public function createFromDotFormat($string) {
        $pom = explode('.', $string);

        $date['d'] = (int)$pom[0];
        $date['m'] = (int)$pom[1];
        $date['y'] = (int)$pom[2];

        $d = new \DateTime();
        $d->setDate($date['y'], $date['m'], $date['d']);

        return $d;
    }

    public function createFromDatetime($string) {

        $string = substr($string, 0, 10);

        $pom = explode('-', $string);
        $date = false;
        if(count($pom) == 3) {
            $date = new \DateTime();
            $date->setDate((int)$pom[0], (int)$pom[1], (int)$pom[2]);
        }

        return $date;
    }

    public function changeFormat($date, $from, $to){
        $sign = substr($from,1,1);
        $signT = substr($to,1,1);
        $expDate = explode($sign, $date);
        $exp = explode($sign, $from);
        $expT = explode($signT, $to);
        foreach($expT as $key=>$value){
            $expTo[$value] = $value;
        }
        foreach($exp as $key=>$value){
            $expFrom[$value] = $expDate[$key];
        }
        $res ='';
        foreach($expTo as $key=>$value){
            $res .= $expFrom[$key];
            $res .= $signT;
        }
        $res = substr($res,0,-1);
        return $res;
    }

    private function getLibDays($lang, $full=0){
        if($lang=='sk') {
            if($full){
                return array(1=>'Pondelok', 2=>'Utorok', 3=>'Streda', 4=>'Štvrtok', 5=>'Piatok', 6=>'Sobota', 0=>'Nedeľa', 7=>'Nedeľa');
            } else {
                return array(1=>'Pon', 2=>'Uto', 3=>'Str', 4=>'Štv', 5=>'Pia', 6=>'Sob', 0=>'Ned', 7=>'Ned');
            }
        }
        if($lang=='cz') {
            if($full){
                return array(1=>'Pondělí', 2=>'Úterý', 3=>'Středa', 4=>'Čtvrtek', 5=>'Pátek', 6=>'Sobota', 0=>'Neděle', 7=>'Neděle');
            } else {
                return array(1=>'Pon', 2=>'Úte', 3=>'Stř', 4=>'Čtv', 5=>'Pát', 6=>'Sob', 0=>'Ned', 7=>'Ned');
            }
        }
        if($full){
            return array(1=>'Pondelok', 2=>'Utorok', 3=>'Streda', 4=>'Štvrtok', 5=>'Piatok', 6=>'Sobota', 0=>'Nedeľa', 7=>'Nedeľa');
        } else {
            return array(1=>'Pon', 2=>'Uto', 3=>'Str', 4=>'Stv', 5=>'Pia', 6=>'Sob', 0=>'Ned', 7=>'Ned');
        }
    }

    private function getLibMonths($lang){
        if($lang=='sk') return array(1=>'Jan', 2=>'Feb', 3=>'Mar', 4=>'Apr', 5=>'Maj', 6=>'Jun', 7=>'Jul', 8=>'Aug', 9=>'Sep', 10=>'Okt', 11=>'Nov', 12=>'Dec');
        if($lang=='cz') return array(1=>'Led', 2=>'Úno', 3=>'Bře', 4=>'Dub', 5=>'Kvě', 6=>'Črv', 7=>'Črc', 8=>'Srp', 9=>'Zář', 10=>'Říj', 11=>'Lis', 12=>'Pro');
        return array(1=>'Jan', 2=>'Feb', 3=>'Mar', 4=>'Apr', 5=>'Maj', 6=>'Jun', 7=>'Jul', 8=>'Aug', 9=>'Sep', 10=>'Okt', 11=>'Nov', 12=>'Dec');
    }

    public function getSlovakLabelMonth($month){
        $arr = $this->getLibMonths('sk');
        return $arr[$month];
    }
    public function getSlovakLabelDay($day){
        $arr = $this->getLibDays('sk');
        return $arr[$day];
    }

    public function getCzechLabelMonth($month){
        $arr = $this->getLibMonths('cz');
        return $arr[$month];
    }
    public function getCzechLabelDay($day){
        $arr = $this->getLibDays('cz');
        return $arr[$day];
    }

    public function getSlovakLabelDays($full=0){
        $arr = $this->getLibDays('sk', $full);
        return $arr;
    }

    public function getCzechLabelDays($full=0){
        $arr = $this->getLibDays('cz', $full);
        return $arr;
    }

    public function getSlovakLabelMonths(){
        $arr = $this->getLibMonths('sk');
        return $arr;
    }

    public function getCzechLabelMonths(){
        $arr = $this->getLibMonths('cz');
        return $arr;
    }



    public function getLabelMonth($month, $lang){
        if($lang=='cz') return $this->getCzechLabelMonth($month);
        return $this->getSlovakLabelMonth($month);
    }

    public function getLabelDay($day, $lang){
        if($lang=='cz') return $this->getCzechLabelDay($day);
        return $this->getSlovakLabelDay($day);
    }

    public function getLabelDays($lang, $full=0){
        if($lang=='cz') {
            $days = $this->getCzechLabelDays($full);
        } else {
            $days = $this->getSlovakLabelDays($full);
        }
        unset($days[0]);
        return array_values($days);
    }

    public function getLabelMonths($lang){
        if($lang=='cz') {
            $months =  $this->getCzechLabelMonths();
        } else {
            $months =  $this->getSlovakLabelMonths();
        }
        return array_values($months);
    }

    public function clean($dateObj, $format='d.m.Y'){
        if(empty($dateObj)) return '';
        if(!is_object($dateObj)) return $dateObj;
        return $dateObj->format($format);
    }

    public function getDaysBetweenStrings($from, $to){
        $dateFrom = new \DateTime($from);
        $dateTo = new \DateTime($to);
        $interval = $dateFrom->diff($dateTo);
        $diff = $interval->format('%a');
        return $diff;
    }

    public function getFullDateString($year, $month, $day, $params) {
        $pomDateObj = new \DateTime($year . '-' . $month . '-' . $day);
        $dayNum = $pomDateObj->format('w');
        $retval = $day . ". " .
            $this->getLabelMonth($month, $params["language"]) . " " .
            $year . ", " .
            $this->getLabelDay($dayNum, $params["language"]);

        return $retval;
    }

    public function createDatetimeObject($datetimeString, $format=null) {
        if ($datetimeString instanceof \DateTime) return $datetimeString;

        if (!empty($format)) {
            $datetimeObject = \DateTime::createFromFormat($format, $datetimeString);
        } else {
            $datetimeObject = new \DateTime($datetimeString);
        }

        return $datetimeObject;
    }

    public function getNowDayMonthYear() {
        $retval = array();

        $now = $this->createDatetimeObject('');
        $retval['day'] = (int)$now->format('j');
        $retval['month'] = (int)$now->format('n');
        $retval['year'] = (int)$now->format('Y');

        return $retval;
    }

    public function getNextDayMonthYear() {
        $retval = array();

        $now = $this->createDatetimeObject('');
        $retval['day'] = (int)$now->format('j') + 1;
        $retval['month'] = (int)$now->format('n');
        $retval['year'] = (int)$now->format('Y');

        $numOfDays = \cal_days_in_month(CAL_GREGORIAN, $retval['month'], $retval['year']);
        if ($retval['day'] > $numOfDays) {
            $retval['day'] = 1;
            $pomRetval = $this->getNextMonthYear();
            $retval['month'] = $pomRetval['month'];
            $retval['year'] = $pomRetval['year'];
        }

        return $retval;
    }

    public function getNextMonthYear() {
        $retval = array();

        $now = $this->createDatetimeObject('');
        $retval['month'] = (int)($now->format('n')) + 1;
        $retval['year'] = (int)($now->format('Y'));

        if ($retval['month'] > 12) {
            $retval['month'] = 1;
            $retval['year']++;
        }

        return $retval;
    }

    public function hoursDiff($timeStart, $timeFinish) {
        $diff = date_diff($timeStart, $timeFinish);
        return $diff->d*24 + $diff->h + $diff->i/60 + $diff->s/3600;
    }
}
