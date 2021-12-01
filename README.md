# Minecraft skin exporter and converter
It is designed to support any type of skin format, but also to be able to export the skin from different angles.

## Usage
Declare a new Skin instance with the path to the respective image

```php
$skin = new ShockedPlot7560\minecraftskin\Skin("a/path/to/file");
```
Use the Exporter to export your skin as a file, or use the internal methods of the Skin class directly
```php
Exporter::exportPng($skin, "path/to/head/skin", Exporter::HEAD_TYPE);
```

## Example
Simply use the two php files located in the example folder to get a demonstration in two different formats
