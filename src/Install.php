<?php
/**
 * @brief Colorbox, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Philippe aka amalgame and Tomtom
 *
 * @copyright GPL-2.0 [https://www.gnu.org/licenses/gpl-2.0.html]
 */

declare(strict_types=1);

namespace Dotclear\Plugin\colorbox;

use dcCore;
use dcNsProcess;

class Install extends dcNsProcess
{
    protected static $init = false; /** @deprecated since 2.27 */
    public static function init(): bool
    {
        static::$init = My::checkContext(My::INSTALL);

        return static::$init;
    }

    public static function process(): bool
    {
        if (!static::$init) {
            return false;
        }

        $settings = dcCore::app()->blog->settings->get(My::id());

        $opts = [
            'transition'     => 'elastic',
            'speed'          => '350',
            'title'          => '',
            'width'          => '',
            'height'         => '',
            'innerWidth'     => '',
            'innerHeight'    => '',
            'initialWidth'   => '300',
            'initialHeight'  => '100',
            'maxWidth'       => '',
            'maxHeight'      => '',
            'scalePhotos'    => true,
            'scrolling'      => true,
            'iframe'         => false,
            'opacity'        => '0.85',
            'open'           => false,
            'preloading'     => true,
            'overlayClose'   => true,
            'loop'           => true,
            'slideshow'      => false,
            'slideshowSpeed' => '2500',
            'slideshowAuto'  => false,
            'slideshowStart' => __('Start slideshow'),
            'slideshowStop'  => __('Stop slideshow'),
            'current'        => __('{current} of {total}'),
            'previous'       => __('previous'),
            'next'           => __('next'),
            'close'          => __('close'),
            'onOpen'         => '',
            'onLoad'         => '',
            'onComplete'     => '',
            'onCleanup'      => '',
            'onClosed'       => '',
        ];

        $settings->put('colorbox_enabled', false, 'boolean', 'Enable Colorbox plugin', false, true);
        $settings->put('colorbox_theme', '3', 'integer', 'Colorbox theme', false, true);
        $settings->put('colorbox_zoom_icon', false, 'boolean', 'Enable Colorbox zoom icon', false, true);
        $settings->put('colorbox_zoom_icon_permanent', false, 'boolean', 'Enable permanent Colorbox zoom icon', false, true);
        $settings->put('colorbox_position', false, 'boolean', 'Colorbox zoom icon position', false, true);
        $settings->put('colorbox_user_files', 'public', 'boolean', 'Colorbox user files', false, true);
        $settings->put('colorbox_selectors', '', 'string', 'Colorbox selectors', false, true);
        $settings->put('colorbox_legend', 'alt', 'string', 'Colorbox legend', false, true);
        $settings->put('colorbox_advanced', serialize($opts), 'string', 'Colorbox advanced options', false, true);

        return true;
    }
}
