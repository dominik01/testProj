<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2.10.2014
 * Time: 11:27
 */

namespace Webron\CoreBundle\Classes;


use Webron\DownloadBundle\Classes\Downloader;

class WebronZipArchive {

    public function __construct(){
    }

    public function createZipArchive($zipName=null, $zipDir=null){
        $zipArchive = new \ZipArchive();
        if(empty($zipName)) $zipName = uniqid().'.zip';
        if(!empty($zipDir)) {
            $classDownloader = new Downloader();
            $classDownloader->makeDirIfNotExistsRecursive($zipDir);
            $zipName = $zipDir . $zipName;
        }
        $res = $zipArchive->open($zipName, \ZipArchive::CREATE);
        /*if($res===true){
            echo 'ok';
        } else {
            echo 'fail';
        }*/
        //$zipArchive->close();
        return $zipArchive;
    }

    public function addFile(&$archive, $file, $localName=null){
        $archive->addFile($file,$localName);
    }

    public function close(&$archive){
        $archive->close();
    }

    public function unzip($file,$dest){
        $zip = new \ZipArchive;
        $res = $zip->open($file);
        if ($res === TRUE) {
            $zip->extractTo($dest);
            $zip->close();
            return 1;
        }
        return 0;
    }

} 