<?php

use \Illuminate\Support\Facades\File;

function getLangError()
{
    return File::getRequire(base_path() .DS.'App'.DS.'helper'.DS.'error.php');
}


function DateFormat(string $date): string
{
    if ($date == null)
    {
      return '';
    }
    return date('Y/m/d | h:i A', strtotime($date)); //| h:s A
}
