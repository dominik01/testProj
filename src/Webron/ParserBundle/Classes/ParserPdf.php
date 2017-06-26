<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 30.9.2014
 * Time: 16:22
 */

namespace Webron\ParserBundle\Classes;


use Smalot\PdfParser\Parser as SmalotParser;

class ParserPdf {

    public $pdfObject;

    public function __construct(){
    }

    public function parse($file){
        $class = new SmalotParser();
        set_time_limit(20);
        $text = $class->parseFile($file);
        if(!empty($text)){
            $text = $text->getText();
        }
        set_time_limit(36000);
        return $text;
    }

    public function getDictionary($text){
        $dictionary      = array(); // index po slovickach
        $dictionaryLines = array(); // index po riadkoch
        $lines = preg_split("/\\r\\n|\\r|\\n/", $text); // all cases

        if(!empty($lines)) {
            foreach ($lines as $keyLine => $line) {
                $dictionaryLines[$keyLine] = array();
                $words           = preg_split('/((^\p{P}+)|(\p{P}*\s+\p{P}*)|(\p{P}+$))/', $line, -1, PREG_SPLIT_NO_EMPTY);
                if(!empty($words)) {
                    foreach ($words as $keyWord => $word) {
                        $word = strtolower($word);
                        // pridam slovo do slovnika
                        $wordArr = array(
                            'line' => $keyLine,
                            'word' => $keyWord,
                        );

                        if(empty($dictionary[$word])) {
                            $dictionary[$word]   = array();
                        }
                        $dictionary[$word][]                 = $wordArr;
                        $dictionaryLines[$keyLine][$keyWord] = $word;
                    }
                }
            }
        }

        return array('words' => $dictionary, 'lines' => $dictionaryLines);
    }

} 
