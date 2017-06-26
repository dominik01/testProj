<?php
 namespace Webron\CoreBundle\Controller;

 use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use Symfony\Component\HttpFoundation\Response;
 use Webron\CoreBundle\Classes\WebronError;
 use Webron\CoreBundle\Classes\WebronHelper;

 class WebronCoreController extends Controller
 {
     protected $params;
 
     protected function prepareParameters($request=null){
		 $parameters['env'] = $this->get( 'kernel' )->getEnvironment();
         $parameters['base'] = $this->get('kernel')->getRootDir() . '/../files/';
         $parameters['basePath'] = $this->get('kernel')->getRootDir() . '/../';
         $parameters['baseUrl'] = $this->container->get('router')->getContext()->getBaseUrl() . '/../../';
         //$parameters['logger'] = $this->get('webron_logger');
         $parameters['em'] = $this->getDoctrine()->getManager();
         //$parameters['dm'] = $this->get('doctrine_mongodb')->getManager();
         //$parameters['mailer'] = $this->get('webron_mailer');
         $actualUser = $this->getUser();
         if(!empty($actualUser)) $parameters['actualUser'] = $parameters['em']->getRepository('WebronUserBundle:User')->findOneByEmail($this->getUser()->getEmail());
         if(!empty($parameters['actualUser'])) $parameters['language'] = $parameters['actualUser']->getLanguage();
         if(empty($parameters['language'])) $parameters['language'] = 'sk';
         if(!empty($request)){
            $post = $request->request->all();
            $content = $request->getContent();
            $parameters['session'] = $request->getSession();
            $parameters['flashbag'] = $request->getSession()->getFlashBag();
         }
         if(!empty($post)) $parameters['post'] = $post;
         if(!empty($content)) $parameters['content'] = $content;
         $this->params = $parameters;
         if(!empty($this->className)) {
            $classStr = "Goodjob\AppBundle\Classes\\" . $this->className;
            $this->class = new $classStr($parameters['em']);
         }
         return $parameters;
     }
 
     protected function getSerializedResponse($data){
         $serializer = $this->container->get('jms_serializer');
         $response = new Response($serializer->serialize($data, 'json'));
         return $response;
     }

     protected function unserialize($data){
         $response = json_decode($data, true);
         return $response;
     }

     protected function unserializeData($data){
         $response = json_decode($data, true);
         if(!empty($response)) $response = $response['data'];
         return $response;
     }

     protected function hasRights($userId, $right, $restaurantId){
         $right = $this->getRepo('UserAccessRight')->doIHaveRights($userId, $right, $restaurantId);
         return $right;
     }

     protected function insufficientRightsError(){
         return $this->returnError('2001', 'rights', 'insufficient-rights');
     }

     protected function returnError($code, $element, $desc){
         if (empty($this->params)) $this->prepareParameters();
         $langClass = new Translation($this->params['em'], $this->params['basePath']);
         $langLib = $langClass->getLib($this->params['language']);
         $print = $this->getError($code, $element, $langLib[$desc]);
         return $this->getSerializedResponse($print);
     }

     protected function getError($code, $element, $desc){
         $classError = new WebronError();
         $classError->create($code, $element, $desc);
         return $classError->printErrors();
     }

     protected function getRepo($name, $special=0){
         if(empty($this->params['em'])) $this->params['em'] = $this->getDoctrine()->getManager();
         if(empty($special)){
             $repo = $this->params['em']->getRepository('GoodjobAppBundle:'.ucfirst($name));
         } else {
             $repo = $this->params['em']->getRepository($special . ':'.ucfirst($name));
         }
         return $repo;
     }

     protected function getGetData(){
         $retval = array();
         $request = $this->getRequest();
         if(!empty($request)){
             $getData = $this->getRequest()->query->all();
             if(!empty($getData)) $retval['get'] = $getData;
         }
         return $retval;
     }
     
     protected function getPostData($request){
        $retval = array();
        if(!empty($request)){
            $post = $request->request->all();
            $content = $request->getContent();
            if(!empty($post)) $retval['post'] = $post;
            if(!empty($content)) $retval['content'] = $content;
        }
        return $retval;
    }
    
    protected function getArrayFromJson($jsonData){
        $helper = new WebronHelper();
        return $helper->jsonToArray($jsonData);
    }

    protected function getFilterParameters(){
        $retval = array('cpv'=>0, 'limit'=>0, 'method'=>0);
        $data = $this->getGetData();
        if(!empty($data['get']) && !empty($data['get']['filter'])){
            $filter=$data['get']['filter'];
            $filterArr = explode(',',$filter);
            if(!empty($filterArr)){
                foreach($filterArr as $key=>$value){
                    $pom = explode(":",$value);
                    if(empty($pom[1])) continue;
                    $retval[$pom[0]] = $pom[1];
                }
            }
        }
        return $retval;
    }

    protected function objectToArray($obj) {
        $helper = new WebronHelper();
        return $helper->objectToArray($obj);
    }

    protected function getVersion(){
        $version = $this->getRepo('ProjectVariables', 'WebronCoreBundle')->getVersion();
        return $version;
    }

 
 }
