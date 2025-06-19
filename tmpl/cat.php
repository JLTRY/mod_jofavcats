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

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

$show_introtext = $params->get('show_introtext', 0);
$show_introtext2 = $params->get('show_introtext2', 0);
?>
          <div id="fc_items-<?php echo $mid; ?>-<?php echo $id; ?>" class="fc_items">
        	<ul class="fc_leading">
			<?php foreach ($cat->articles as $article) : 
				if ($params->get('link_image',0)) :
					$image = '<a href="' . $article->link . '"' . ($link_target == 1 ? ' target="_blank"' : '') . '>' . $article->image . '</a>';
				else :
					$image = $article->image;
				endif;
				if ( $params->get('bold_firstsentence', 0) ) :
					$regex = '/^(.*?)[\.\?!]\s/';
					$article->displayIntrotext = (preg_match($regex, $article->displayIntrotext) == 1 ? preg_replace($regex, '<strong>$0</strong>', $article->displayIntrotext) : '<strong>'.$article->displayIntrotext.'</strong>'); 
				endif; ?>
        		<li><?php echo ($show_image == 2 ? $image : ''); ?><?php if ($item_heading) : ?><?php echo '<h' . $item_heading . '>'; ?>
				<?php if ($params->get('link_titles') == 1) : ?>
                <a class="fc_title<?php echo $article->active; ?>" href="<?php echo $article->link; ?>"<?php echo ($params->get('link_target') == 1 ? ' target="_blank"' : ''); ?>>
                <?php echo $article->title; ?>
                <?php if ($article->displayHits) :?>
                    <span class="fc_hits">
                    (<?php echo $article->displayHits; ?>)  </span>
                <?php endif; ?></a>
                <?php else :?>
                <?php echo $article->title; ?>
                    <?php if ($article->displayHits) :?>
                    <span class="fc_hits">
                    (<?php echo $article->displayHits; ?>)  </span>
                <?php endif; ?></a>
                <?php endif; ?>
                <?php echo '</h' . $item_heading . '>'; ?><?php endif; ?>
				<?php if ($article->displayAuthorName) :?>
					<span class="fc_writtenby">
					<?php echo $article->displayAuthorName; ?>
					</span>
				<?php endif;?>
				<?php if ($article->displayDate) : ?>
					<span class="fc_date<?php echo ($article->displayAuthorName?' date-and-author':''); ?>"><?php echo $article->displayDate; ?></span>
				<?php endif; ?>
                <?php if($show_introtext==1):?><p><?php endif; ?><?php echo ($show_image == 1 ? $image : ''); ?><?php echo $article->displayIntrotext; ?><?php if($show_introtext==1):?></p><?php endif; ?>
				<?php if ($params->get('show_readmore') && ((strlen($article->displayIntrotext) < strlen($article->introtext)) || ($params->get('show_introtext', 1) == 2 && $article->fulltext))) :?>
                    <p class="fc_readmore">
                        <a class="fc_title <?php echo $article->active; ?>" href="<?php echo $article->link; ?>"<?php echo ($params->get('link_target') == 1 ? ' target="_blank"' : ''); ?>>
                        <?php if ($article->params->get('access-view')== FALSE) :
                                echo Text::_('MOD_JOFAVCATS_REGISTER_TO_READ_MORE');
                            elseif ($readmore = $article->alternative_readmore) :
                                echo $readmore;
                                echo HTMLHelper::_('string.truncate', $article->title, $params->get('readmore_limit'));
                                if ($params->get('show_readmore_title', 0) != 0) :
                                    echo HTMLHelper::_('string.truncate', ($article->title), $params->get('readmore_limit'));
                                endif;
                            elseif ($params->get('show_readmore_title', 0) == 0) :
                                echo Text::sprintf('MOD_JOFAVCATS_READ_MORE_TITLE');
                            else :
                                
                                echo Text::_('MOD_JOFAVCATS_READ_MORE');
                                echo HTMLHelper::_('string.truncate', ($article->title), $params->get('readmore_limit'));
                            endif; ?>
						</a>
                    </p>
                <?php endif; ?>
                </li>
            <?php endforeach; ?>
            </ul>
            <?php if ( $cat->subarticles || $show_more==1 ) : ?>
				<?php require ModuleHelper::getLayoutPath('mod_jofavcats', 'links'); ?>
			<?php endif; ?>    
          </div>  
		  <?php if ($pag) : ?>
              <?php require ModuleHelper::getLayoutPath('mod_jofavcats', 'pag'); ?>
          <?php endif; ?>