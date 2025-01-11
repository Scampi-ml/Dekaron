<!DOCTYPE html>
<html>
    <head>
        <title>{if isset($title)}{$title}{/if} - {$name}</title>
        <meta name="description" content="{$description}">
        <meta name="keywords" content="{$keywords}">
        <meta name="author" content="{$author}">
        <meta name="robots" content="index,follow"/>
        <meta name="googlebot" content="index,follow"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <link rel="stylesheet" href="{$BASE_URL}assets/css/default.css" type="text/css" />
        <link rel="stylesheet" href="{$BASE_URL}assets/css/cms.css" type="text/css" />
        <link rel="stylesheet" href="{$BASE_URL}assets/css/main.css" type="text/css" />
        {if isset($push_css)} 
            {foreach from=$push_css item=css}
                <link rel="stylesheet" href="{$BASE_URL}assets/css/{$css}" type="text/css" />
            {/foreach} 
        {/if}  
        <script type="text/javascript">
			var Config = {
				URL: "{$SITE_URL}",			
				UseTooltip: 1,
				newsCat:"{$newsCat}",
				newsTotal:"{$newsTotal}",
				changelogCat:"{$changelogCat}",
				changelogTotal:"{$changelogTotal}"				
			};
        </script>
        <!--[if lt IE 9]>
            <script type="text/javascript" src={$BASE_URL}assets/js/html5shiv.js"></script>
        <![endif]-->  
        <link rel="shortcut icon" href="assets/images/favicon.gif" />
    </head>
    <body>
        <section id="socialNetworks"> 
			{$show_social}
        </section>    
    	<section id="wrapper">
        {include file="inc/view_side.tpl"}
