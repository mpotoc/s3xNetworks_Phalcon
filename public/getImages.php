<?php

function drawArray(DirectoryIterator $directory)
{
    $result=array();
    foreach($directory as $object)
    {
        if($object->isDir()&&!$object->isDot())
        {
            $result[$object->getFilename()]=drawArray(new DirectoryIterator($object->getPathname()));
        }
        else if($object->isFile())
        {
            $result[]=$object->getFilename();
        }
    }
    return $result;
}
$array=drawArray(new DirectoryIterator('files/'));
echo json_encode($array);