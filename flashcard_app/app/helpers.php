<?php declare(strict_types=1);

if (! function_exists('secure_asset_image')) {
    /**
     * @return string
     */
    function secure_asset_image($path): string
    {
        return secure_asset('image/' . $path);
    }
}

if (! function_exists('secure_asset_card_image')) {
    /**
     * @return string
     */
    function secure_asset_card_image($file_name): string
    {
        return secure_asset_image('card/' . $file_name);
    }
}

