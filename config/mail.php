<?php

return [

  "driver" => "smtp",
  "host" => "smtp.story-juice.com",
  "port" => 587,
  "from" => array(
      "address" => "account@story-juice.com",
      "name" => "Story Juice"
  ),
  "username" => "account@story-juice.com",
  "password" => "accountSJ1337",
  "sendmail" => "/usr/sbin/sendmail -bs",
  "pretend" => false

];
