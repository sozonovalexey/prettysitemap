<?php namespace Xeor\PrettySitemap;

use Event;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'xeor.sitemap::lang.plugin.name',
            'description' => 'xeor.sitemap::lang.plugin.description',
            'author'      => 'Sozonov Alexey',
            'icon'        => 'icon-sitemap',
            'homepage'    => 'https://github.com/sozonovalexey/sitemap-plugin'
        ];
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        Event::listen('cms.page.display', function ($controller, $url, $page, $result) {
            if (strpos($url, 'sitemap') !== false && strpos($url, 'xml') !== false) {
                $prefix = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
                $prefix .= '<?xml-stylesheet type="text/xsl" href="/plugins/xeor/prettysitemap/assets/xsl/sitemap.xsl"?>' . "\n";
                return $prefix . $result;
            }
        });
    }
}
