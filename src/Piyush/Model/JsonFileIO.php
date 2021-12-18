<?php

namespace Piyush\Model;

class JsonFileIO
{
    public static function readFile($relativePath)
    {
        $absolutePath = self::buildAbsFilePath($relativePath);
        $stringContents = self::readFileContents($absolutePath);
        return self::decodeJson($stringContents);
    }

    public static function writeFile($relativePath, $contents)
    {
        $absolutePath = self::buildAbsFilePath($relativePath);
        return self::writeFileContents($absolutePath, $contents);
    }

    public static function writeFileContents($absPath, $contents)
    {
        $jsonEncodedContent = self::encodeJson($contents);
        return @file_put_contents($absPath, $jsonEncodedContent);
    }

    public static function buildAbsFilePath($relativePath)
    {
        return rtrim(dirname(__DIR__, 3), "\\/") . '/' . ltrim($relativePath, "\\/");
    }
    
    public static function readFileContents($absPath)
    {
        return @file_get_contents($absPath);
    }
    
    public static function encodeJson($data)
    {
        return json_encode($data);
    }
    
    public static function decodeJson($stringData)
    {
        return json_decode($stringData, true);
    }

}