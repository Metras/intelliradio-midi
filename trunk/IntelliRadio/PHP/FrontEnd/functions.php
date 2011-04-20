<?php
/**
 * 
 * Patented MIDI Include function
 * @param $name String name of the page (as given by GET request)
 * @param $namesAndPages Array array of names for pages and their mapping for PHP files
 */
function midiInclude($name, $namesAndPages) {
	include($namesAndPages[$name]);
}