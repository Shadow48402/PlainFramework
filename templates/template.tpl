<!DOCTYPE html>
<html>
    <head>
        <title>{$config['custom']['name']} | {$title}</title>
        {if isset($keywords)}
            <meta name="keywords" content="{$config['custom']['keywords']}, {$keywords}">
        {else}
            <meta name="keywords" content="{$config['custom']['keywords']}">
        {/if}
        <link rel='stylesheet' href='libs/css/style.css' />
    </head>
    <body>
        <nav>
            <ul>
                <li><a href='#'>Home</a></li>
                <li><a href='#'>About</a></li>
            </ul>
        </nav>

        <!--- Include View file into the template --->
        {include file=$view_name}
    </body>
</html>