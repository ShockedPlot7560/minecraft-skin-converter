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
     * @param int $scale, default is 1 => 2 will multiply by 2 the final size
     */
    public static function exportPng(Skin $image, string $path, string $type, int $scale = 1) {
        switch ($type) {
            case self::HEAD_TYPE:
                imagepng($image->getHead($scale), $path);
                break;
            case self::BODY_TYPE:
                imagepng($image->getBody($scale), $path);
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