<?php
/* DO NOT MODIFY THIS FILE
 * -----------------------
 * If you need to make changes to this file create a copy of it in
 * your child theme and perform any updates there.
 */

global $theme_options;

if(isset($theme_options))
{
    /*--------- Column Settings ---------*/

    $theme_options->add(array(
        'name' => 'Column Settings',
        'type' => 'heading'
    ));

    $theme_options->add(array(
        'name'    => 'Left Column Width',
        'id'      => 'left_column_width',
        'default' => 0,
        'type'    => 'number'
    ));

    $theme_options->add(array(
        'name'    => 'Right Column Width',
        'id'      => 'right_column_width',
        'default' => 0,
        'type'    => 'number'
    ));
}
