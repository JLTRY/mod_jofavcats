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

$pagcount = $params->get('pag_count', '');
$first_page = 0;
$last_page = $cat->pages['total'];
if ($pagcount && $pagcount < $last_page) {
    $edge = $cat->pages['current'] + 1 - $pagcount;
    if ($edge >= 0) :
        $first_page = $edge;
    endif;
    $last_page = $first_page + $pagcount;
}
$Itemid = Factory::getApplication()->input->getInt('Itemid');
?>
<div class="fc_pag" id="fc_pag-<?php echo $mid; ?>-<?php echo $id; ?>">
    <?php if ($params->get('pag_1', 0)) : ?>
    <span<?php echo($cat->pages['current'] != 0 ? ' onclick="fc_paginate(0,\'' . $id .
    '\',' . $mid . ',' . $Itemid . ')"' : ''); ?>>&lt;&lt;
    </span>
    <?php endif; ?>
    <?php if ($params->get('pag_2', 1)) : ?>
    <span<?php echo($cat->pages['current'] != 0 ?
    ' onclick="fc_paginate(' . ($cat->pages['current'] - 1) * $cat->pages['items'] .
    ',\'' . $id . '\',' . $mid . ',' . $Itemid . ')"' : ''); ?>>&lt;
    </span>
    <?php endif; ?>
    <?php for ($p = $first_page; $p < $last_page; $p++) : ?>
    <span<?php echo($p == $cat->pages['current'] ? ' class="current"' : ''); ?>
        <?php echo($cat->pages['current'] != $p ?
        ' onclick="fc_paginate(' . $p * $cat->pages['items'] .
        ',\'' . $id . '\',' . $mid . ',' . $Itemid . ')"' : ''); ?>>
        <?php echo ($p + 1); ?>
    </span>
    <?php endfor; ?>
    <?php if ($params->get('pag_2', 1)) : ?>
    <span<?php echo($cat->pages['current'] != $cat->pages['total'] - 1 ?
    ' onclick="fc_paginate(' . ($cat->pages['current'] + 1) * $cat->pages['items'] .
    ',\'' . $id . '\',' . $mid . ',' . $Itemid . ')"' : ''); ?>>&gt;
    </span>
    <?php endif; ?>
    <?php if ($params->get('pag_1', 0)) : ?>
    <span<?php echo($cat->pages['current'] != $cat->pages['total'] - 1 ?
    ' onclick="fc_paginate(' . ($cat->pages['total'] - 1) * $cat->pages['items'] .
    ',\'' . $id . '\',' . $mid . ',' . $Itemid . ')"' : ''); ?>>&gt;&gt;
    </span>
    <?php endif; ?>
    <?php if ($params->get('pag_3', 0)) : ?>
    <span class="totalcount">(<?php echo $cat->pages['total']; ?>)</span>
    <?php endif; ?>
</div> 
