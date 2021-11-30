<?php

use ShockedPlot7560\minecraftskin\Exporter;
use ShockedPlot7560\minecraftskin\Skin;

require dirname(__DIR__) . "/vendor/autoload.php";

$skin = new Skin(__DIR__ . "/secondLayer.png");
Exporter::exportPng($skin, __DIR__ . "/head.png", Exporter::HEAD_TYPE);

Exporter::exportPng($skin, __DIR__ . "/body.png", Exporter::BODY_TYPE);

Exporter::exportPng($skin, __DIR__ . "/skin.png", Exporter::SKIN_TYPE);