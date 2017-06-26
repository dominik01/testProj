<?php

namespace Webron\DownloadBundle\Classes;


class Downloader {

    public function __construct(){
    }

    public function downloadFile($source, $destination, $name=false, $rewrite=false){

        $name = $this->getName($name, $source);
        if(!$rewrite && file_exists($destination.$name)){
            $this->log('File already exists: ' . $destination.$name, 'Downloader:downloadFile');
            return 1;
        }
        $this->log('Downloading file: ' . $source, 'Downloader:downloadFile');

        //$file = \fopen ($source, "rb");
        //$file = \file_get_contents($source, "rb");
        $c = \curl_init($source);
        \curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($c, CURLOPT_SSLVERSION,3);
        $file = \curl_exec($c);
           //print_r($file);
        if ($file) {
            $newf = \fopen ($destination . $name, "wb");

            if ($newf) {
                fputs($newf, $file);
                /*
                while(!feof($file)) {
                    fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
                }*/
            }
        }
        /*
        if ($file) {
            fclose($file);
        }*/

        if (!empty($newf)) {
            fclose($newf);
        }

        $this->log('File: ' . $source . ' downloaded', 'Downloader:downloadFile');


        return 1;
    }

    public function getName($name, $source){

        $parts = explode('/', $source);
        $lastPart = array_pop($parts);

        if(!empty($name)){
            $newName = $name;
        } else {
            $newName = $lastPart;
        }
        return $newName;
    }

    private function getSuffix($name){
        $parts = explode('.', $name);
        $suffix = array_pop($parts);
        return $suffix;
    }

    public function makeDirIfNotExists($systemUrl){
        if (!file_exists($systemUrl)) {
            $this->log('Creating directory: ' . $systemUrl, 'Downloader:makeDirIfNotExists');
            mkdir($systemUrl, 0777, true);
        }
    }

    public function makeDirIfNotExistsRecursive($systemUrl){
        $pom = explode("/", $systemUrl);
        if(!empty($pom)){
            $path = '';
            foreach($pom as $key=>$value){
                $path .= $value . '/';
                if (!file_exists($path)) {
                    $this->log('Creating directory: ' . $path, 'Downloader:makeDirIfNotExists');
                    mkdir($path, 0777, true);
                }
            }
        }
    }

    public function getShortId($id){
        $retval = substr($id, -2);
        return $retval;
    }

    protected function log($desc, $name){

    }

    public function copy($source, $dest){
        $this->log('Copy file: ' . $source, 'Downloader:copy');
        if(copy($source, $dest)){
            $this->log('Copy file: ' . $source . ' successful', 'Downloader:copy');
            return true;
        }
        $this->log('Copy file: ' . $source . ' unsuccessful', 'Downloader:copy');
        return false;
    }

    public function recurseCopy($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurseCopy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

} 