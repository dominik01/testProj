<?php
/**
 * User: Michal Chylik <michal.chylik@gmail.com>
 * Date: 28.4.2015
 * Time: 14:05
 */

namespace Webron\TranslationBundle\Classes;


abstract class AbstractTranslation {

    protected $em;
    protected $languages;
    protected $actualLang;
    protected $defaultLanguage = 'sk';

    public function __construct($em=null){
        $this->em = $em;
        $this->loadLanguages();
    }

    protected abstract function loadLanguages();

    public function generateTranslationFiles(){
        if(!empty($this->languages)){
            foreach($this->languages as $key=>$value){
                $this->generateTranslationFile($value);
            }
        }
        $this->em->getRepository('WebronCoreBundle:ProjectVariables')->incrementVersion();
    }

    protected function generateTranslationFile($language){
        $staticLib = $this->loadStaticLib($language);
        if($language!=$this->defaultLanguage) $staticLib = $this->injectDefaultTranslations($staticLib);
        $fp = fopen($this->path . '/' . $language . '.json', 'w');
        fwrite($fp, json_encode($staticLib));
        fclose($fp);
    }

    protected function injectDefaultTranslations($lib){
        $defaultLib = $this->loadStaticLib($this->defaultLanguage);
        if(!empty($lib)){
            foreach($lib as $key=>$value){
                $defaultLib[$key] = $value;
            }
        }
        return $defaultLib;
    }

    protected abstract function loadStaticLib($language);
}