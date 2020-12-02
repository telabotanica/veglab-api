<?php

namespace App\Entity;

interface TimestampedEntityInterface
{

   public function getDateCreated(): ?\DateTimeInterface;
   public function setDateCreated(?\DateTimeInterface $dateCreated): TimestampedEntityInterface;
   public function getDateUpdated(): ?\DateTimeInterface;
   public function setDateUpdated(?\DateTimeInterface $dateUpdated): TimestampedEntityInterface;
 
}
