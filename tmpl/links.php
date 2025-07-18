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

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
?>
<ul class="fc_links">
    <?php if ($cat->subarticles) :
        foreach ($cat->subarticles as $subarticle) : ?>
        <li>
            <?php if ($params->get('link_titles') == 1) : ?>
        <a class="fc_title <?php echo $subarticle->active; ?>"
        href="<?php echo $subarticle->link; ?>"
                <?php echo ($params->get('link_target') == 1 ? ' target="_blank"' : ''); ?>>
                <?php echo $subarticle->title; ?>
                <?php if ($subarticle->displayHits) :?>
            <span class="fc_hits">
            (<?php echo $subarticle->displayHits; ?>)  </span>
                <?php endif; ?></a>
            <?php else :?>
                                <?php echo $subarticle->title; ?>
                                <?php if ($subarticle->displayHits) :?>
            <span class="fc_hits">
            (<?php echo $subarticle->displayHits; ?>)  </span>
                                <?php endif; ?></a>
            <?php endif; ?>
                            <?php if ($subarticle->displayAuthorName) :?>
            <span class="fc_writtenby">
                                <?php echo $subarticle->displayAuthorName; ?>
            </span>
                            <?php endif;?>
            <?php if ($subarticle->displayDate) : ?>
            <span class="fc_date<?php echo ($subarticle->displayAuthorName ? ' date-and-author' : ''); ?>">
                <?php echo $subarticle->displayDate; ?>
            </span>
            <?php endif; ?>
            <?php if ($subarticle->displayIntrotext) : ?>
            <div class="fc_intro2"><?php echo $subarticle->displayIntrotext; ?></div>
            <?php endif; ?>
            <?php if (
            $params->get('show_readmore2') &&
            ((strlen($subarticle->displayIntrotext) < strlen($subarticle->introtext)) ||
            ($params->get('show_introtext2', 0) == 2 && $subarticle->fulltext))
) :?>
                <div class="fc_readmore2">
                    <a class="fc_title <?php echo $subarticle->active; ?>" href="<?php echo $subarticle->link; ?>"
                    <?php echo ($params->get('link_target') == 1 ? ' target="_blank"' : ''); ?>>
                        <?php if ($subarticle->params->get('access-view') == false) :
                            echo Text::_('MOD_JOFAVCATS_REGISTER_TO_READ_MORE');
                        elseif ($readmore = $subarticle->alternative_readmore) :
                            echo $readmore;
                            echo HTMLHelper::_('string.truncate', $subarticle->title, $params->get('readmore_limit2'));
                            if ($params->get('show_readmore_title2', 0) != 0) :
                                echo HTMLHelper::_(
                                    'string.truncate',
                                    ($subarticle->title),
                                    $params->get('readmore_limit2')
                                );
                            endif;
                        elseif ($params->get('show_readmore_title2', 0) == 0) :
                            echo Text::sprintf('MOD_JOFAVCATS_READ_MORE_TITLE');
                        else :
                            echo Text::_('MOD_JOFAVCATS_READ_MORE');
                            echo HTMLHelper::_(
                                'string.truncate',
                                ($subarticle->title),
                                $params->get('readmore_limit2')
                            );
                        endif; ?>
                    </a>
                </div>
            <?php endif; ?>
        </li>
        <?php endforeach;
    endif; ?>
    <?php if ($show_more == 1) : ?>
        <li class="fc_more"><a href="<?php echo $cat->category_link; ?>">
        <?php echo Text::_('MOD_JOFAVCATS_MORE_ARTICLES'); ?></a></li>
    <?php endif; ?>
    </ul>
