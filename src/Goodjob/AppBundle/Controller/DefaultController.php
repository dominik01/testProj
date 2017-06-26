<?php

namespace Goodjob\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Webron\CoreBundle\Controller\WebronCoreController;

class DefaultController extends WebronCoreController
{
    public function indexAction()
    {
        $session = new  Session();
        $subscription = false;
        if($session->getFlashBag()->get('notice')) $subscription=true;
        $lectors = $this->getRepo('Lector')->showAll();
        $courses = $this->getRepo('Course')->showAll();
        $blogs = $this->getRepo('Blog')->showAll();
        return $this->render('GoodjobAppBundle:Landing:index.html.twig', array('subscription' => $subscription, 'lectors' => $lectors, 'courses' => $courses, 'blogs' => $blogs));
    }

    public function aboutAction()
    {
        return $this->render('GoodjobAppBundle:About:about.html.twig', array());
    }

    public function showBlogAction(){
        $blogs = $this->getRepo('Blog')->showAll();
        return $this->render('GoodjobAppBundle:About:blog.html.twig', array('blogs'=>$blogs));
    }

    public function showArticleAction($id){
        $blog = $this->getRepo('Blog')->showOneById($id);
        return $this->render('GoodjobAppBundle:About:blog_article.html.twig', array('blog'=>$blog));
    }

    public function submitApplicationAction(Request $request)
    {
        $data = $this->getPostData($request);
        $data = $data['post'];
        $receiver = 'info@goodjob.sk';
        $body = 'Novy zakaznik '. $data['name'] .', email: '. $data['email']. ', telefon: '. $data['phone']. ' sa prihlasil na kurz '. $data['course_name'];
        $message = \Swift_Message::newInstance()
            ->setSubject('New application for course: '.$data['course_name'])
            ->setFrom($data['email'])
            ->setTo($receiver)
            ->setBody($body);
        $this->get('mailer')->send($message);

        $emailbody = $this->renderView('GoodjobAppBundle:Course:subscriptionemail.html.twig',array('data' => $data));
        $message = \Swift_Message::newInstance()
            ->setSubject('Prihlásili ste sa na kurz: '.$data['course_name'])
            ->setFrom('info@goodjob.sk')
            ->setTo($data['email'])
            ->setBody($emailbody, 'text/html');
        $this->get('mailer')->send($message);

        $this->getRepo('Application')->newApplication($data);
        return $this->render('GoodjobAppBundle:Course:thankyou.html.twig',array('data' => $data));
    }

    public function subscribeAction(Request $request)
    {
        $data = $this->getPostData($request);
        $data = $data['post'];
        /*$receiver = 'michal.chylik@goodjob.sk';
        $body = 'Novy odberatel '.', email: '. $data['email'];
        $message = \Swift_Message::newInstance()
            ->setSubject('Novy odberatel')
            ->setFrom($data['email'])
            ->setTo($receiver)
            ->setBody($body);
        $this->get('mailer')->send($message);*/
        $session = new Session();
        $session->getFlashBag()->add('notice', 'Subscriber added');
        $this->getRepo('Subscription')->newSubscription($data['email']);
        return $this->redirect($this->container->get('router')->getContext()->getBaseUrl().'#contact');
    }
}
