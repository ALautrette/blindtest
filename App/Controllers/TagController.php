<?php

namespace App\Controllers;

use App\Repositories\TagRepository;
use App\Repositories\PlaylistRepository;

class TagController
{
    public function __construct(
        private TagRepository $tagRepository = new TagRepository(),
    ) {
    }


    public function index()
    {
        $tags = $this->tagRepository->findAll();
        require_once __DIR__ . '/../Views/Tag/index.php';
    }

    public function createForm()
    {
        require_once __DIR__ . '/../Views/Tag/create.php';
    }

    public function create()
    {
        //
    }
}
