<?php

namespace App\Entity;

interface TagInterface {

    public function getName();
    public function setName(string $name): TagInterface;
    public function getPath();
    public function setPath(string $path): TagInterface;

}
