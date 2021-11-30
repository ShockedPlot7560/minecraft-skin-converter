<?php

namespace ShockedPlot7560\minecraftskin;

use InvalidArgumentException;

class Exporter {

    const SKIN_TYPE = "skin";
    const BODY_TYPE = "body";
    const HEAD_TYPE = "head";

    /**
     * @param Skin $image 
     * @param string $type The export type : skin / body / head
     */
    public static function exportPng(Skin $image, string $path, string $type) {
        switch ($type) {
            case self::HEAD_TYPE:
                imagepng($image->getHead(), $path);
                break;
            case self::BODY_TYPE:
                imagepng($image->getBody(), $path);
                break;
            case self::SKIN_TYPE:
                imagepng($image->getSkin(), $path);
                break;
            default:
                throw new InvalidArgumentException();
                break;
        }
    }

}