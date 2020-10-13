<?php

namespace app\controllers;

use app\classes\Flash;
use app\database\models\User;
use Psr\Container\ContainerInterface;

class Home extends Base
{
    private $user;
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->user = new User;
        $this->container = $container;
    }

    public function index($request, $response)
    {
        $users = $this->user->find();

        $message = Flash::get('message');

        $cache = $this->container->get('cache');

        $response = $cache->withEtag($response, md5(time()));
        // $response = $cache->withExpires($response, '+50 seconds');
        // $response = $cache->withLastModified($response, '-50 seconds');

        return $this->getTwig()->render($response, $this->setView('site/home'), [
            'title' => 'Home',
            'users' => $users,
            'message' => $message,
        ]);
    }
}
