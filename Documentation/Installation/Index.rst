.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


==============================
Installation
==============================

Setup:
---------
* Install the extension 
* Include the extension setup in your template
* set the storage folder PID in the constant editor of the template.
* Insert the Blog plugin on a full-width page.
* Make shure that you don't render a title tag oder meta tags on the page with the blog plugin. This is done by the extension.
* Add to the page typoscript of your storage folder: TCEMAIN.clearCacheCmd = PID of the Blogplugin


It's recommended to use realURL for correct writing of the post links. You can find a sample configuration for writing URLs like www.myweb.com/this-is-my-post in the folder multiblog/realURL_config.
	