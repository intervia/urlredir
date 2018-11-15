<?php

/*
 * Redirection array
 * 
 * Format:
 * $redir['old-page'] = '/new-page';
 * 
 * Notes:
 * "old-page" must not include the domain name, i.e.:
 * "http://example.com/old-page" should be used as "old-page" (without slash)
 * "new-page" can be a relative address like "/contact" (use front slash)
 * or absolute address like "http://example.com/contact"
 * 
 * Origin: Can include pages, directories and queries (literal match)
 * Destination: Target page with front slash (root), or absolute URL
 * 
 */

//Redirection examples
$redir['oldpage'] = '/newpage';
$redir['oldpage.php?lang=en'] = '/en/newpage';
$redir['en/oldpage.html'] = '/newpage/en/';
$redir['/route/to/oldpage.php'] = 'http://example.com/newpage';
$redir['oldpage?value=some'] = 'https://example.com/newpage?p=aboutus';
$redir['/route/to/oldpage.php?page=contact'] = '/forms/en/newpage?p=contact';