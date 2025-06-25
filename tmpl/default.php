<?php
/*------------------------------------------------------------------------
# mod_jofavcats - JO Favorite Categories
# ------------------------------------------------------------------------
# author    JL TRYOEN / Jesús Vargas Garita
# Copyright (C) 2010 www.joomlahill.com. All Rights Reserved.
# Copyright (C) 2025 www.jltryoen.fr All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
# Websites: http://www.jltryoen.fr http://www.joomlahill.com
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;


$item_heading = $params->get('item_heading');
$cat_heading  = $params->get('cat_heading');
$link_cats    = $params->get('link_cats', 1);
$show_image   = $params->get('show_image', 0);
$show_more    = $params->get('show_more');
$link_target  = $params->get('link_target');
$pag          = $params->get('pag_show', 0);
$css          = $params->get('add_css', -1);

if ($params->get('moduleclass_sfx')) {
    $moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
} else {
    $moduleclass_sfx = "";
}



$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->getRegistry()->addRegistryFile('media/mod_jofavcats/joomla.asset.json');
$wa->usePreset("module.jofavcats");
$doc = Factory::getDocument();
if ($css != -1) :
    $doc->addStyleSheet('media/mod_jofavcats/' . $css);
endif;
?>
<ul class="featcats<?php echo $moduleclass_sfx; ?> row" id="featcats-<?php echo $mid; ?>">
    <?php foreach ($cats as $id => $cat) : ?>
    <li class="<?php echo $cat->col_class; ?>" id="featcat-<?php echo $mid; ?>-<?php echo $id; ?>">
        <?php if ($show_more == 2) :?>
            <a href="<?php echo $cat->category_link; ?>" class="fc_more">
                <?php echo Text::_('MOD_JOFAVCATS_MORE_ARTICLES'); ?>
            </a>
        <?php endif; ?>
        <?php if ($params->get('cat_image') && $cat->category_image) : ?>
            <?php if ($link_cats) :
                ?><a href="<?php echo $cat->category_link; ?>"><?php
            endif; ?>
            <img src="<?php echo URI::base(false) . $cat->category_image; ?>" class="fc_cat_image" />
            <?php if ($link_cats) :
                ?></a><?php
            endif; ?>
        <?php endif; ?>
        <?php if ($cat_heading) :
            ?><?php echo '<h' . $cat_heading . '>'; ?><?php if ($link_cats) :
    ?><a href="<?php echo $cat->category_link; ?>"><?php
            endif; ?><?php echo $cat->category_title; ?><?php if ($link_cats) :
    ?></a><?php
            endif; ?><?php echo '</h' . $cat_heading . '>'; ?><?php
        endif; ?>
        <?php if ($cat->articles) : ?>
            <div id="fc_ajax-<?php echo $mid; ?>-<?php echo $id; ?>" class="fc_ajax">
                <?php require ModuleHelper::getLayoutPath('mod_jofavcats', 'cat'); ?>
            </div>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<div style="clear:both"></div>
