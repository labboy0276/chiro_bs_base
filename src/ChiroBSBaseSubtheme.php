<?php

namespace Drupal\chiro_bs_base;

use Drupal\block\Entity\Block;

/**
 * Class ChiroBSBaseSubtheme.
 *
 * @package Drupal\ChiroBSBaseSubtheme
 */
class ChiroBSBaseSubtheme {

  /**
   * Converts / Loads all the block into the theme layer.
   *
   * @param object $vars
   *   The vars from the preprocess we are using this in.
   */
  public static function convertBlocks(&$vars) {
    // Get active theme
    $theme = explode("/", \Drupal::theme()->getActiveTheme()->getPath());
    $theme = end($theme);

    // Load up the site branding block into a var.
    // So we don't need to use a region or the block in content.
    $block_ids = \Drupal::entityQuery('block')->execute();
    foreach ($block_ids as $id) {
      if (strpos($id, $theme) !== FALSE) {
        $name = str_replace($theme . '_', '', $id);

        // Load up the blocks and set them to the vars.
        ${$name} = Block::load($theme . '_' . $name);
        $vars[$name] = \Drupal::entityManager()
        ->getViewBuilder('block')
        ->view(${$name});
      }
    }
  }

  /**
   * Remove Twig Debug markup usually generated from toString Markup classes.
   *
   * @param string $string
   *   The raw string that needs to be cleaned up
   *
   * @return string
   *   The cleansed string.
   */
  public static function removeTwigDebug($string) {
    $output = preg_replace('/<!--(.|\s)*?-->/', '', $string);
    $output = str_replace(array("\n", "\r"), '', $output);
    return $output;
  }
}
