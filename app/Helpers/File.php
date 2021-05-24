<?php

namespace App\Helpers;

/**
 * Class responsible for writing files
 */
class File
{
    /**
     * Method to write the sorted list in storage folder
     * 
     * @return void
     */
    public static function writeFileSorted(array $list) : void
    {
        if (empty($list)) {
            return;
        }

        // defining the file path
        $path = __DIR__ . '/../../storage/';
        $filename = 'sorted_items.csv';
        $file = $path . $filename;

        // check if has an another file already created
        if (file_exists($file)) {
            // removing the file
            unlink($file);
        }

        // writing the header
        $header = "Item;Extra;Price;Wired" . PHP_EOL;
        file_put_contents($file, $header);

        foreach ($list as $data) {
            $line = "";
            $line .= "{$data->getType()};;{$data->getPrice()};" . PHP_EOL;

            // checking if this electronic item has extras or not
            if ($data::AMOUNT_OF_EXTRAS != 0 && !empty($data->getExtras())) {
                foreach ($data->getExtras() as $extra) {
                    $line .= "{$data->getType()};{$extra->getType()};{$extra->getPrice()};{$extra->getWired()}" . PHP_EOL;
                }
            }

            // writing the content
            file_put_contents($file, $line, FILE_APPEND);
        }
    }
}   