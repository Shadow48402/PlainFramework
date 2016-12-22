<?php
/* Smarty version 3.1.30, created on 2016-11-16 20:15:51
  from "C:\Users\Niels\Dropbox\PlainFramework\app\templates\default.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_582cbe77caaca4_74992790',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '61fd7a0e7088d2ab976a9214df2369547c9a6047' => 
    array (
      0 => 'C:\\Users\\Niels\\Dropbox\\PlainFramework\\app\\templates\\default.tpl',
      1 => 1479327344,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:default/head.tpl' => 1,
  ),
),false)) {
function content_582cbe77caaca4_74992790 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
    <head>
        <?php $_smarty_tpl->_subTemplateRender("file:default/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    </head>
    <body>
        <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['view_name']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

    </body>
</html><?php }
}
