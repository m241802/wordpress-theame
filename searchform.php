<?php
/**
 * The template generates your search form
 *
 * @package msa
 */
?>

<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<label for="s" class="screen-reader-text">Search for:</label>
	<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e('Search', 'msa'); ?>" />
</form>