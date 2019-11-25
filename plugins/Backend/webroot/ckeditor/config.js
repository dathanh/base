/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here.
    // For complete reference see:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    // The toolbar groups arrangement, optimized for two toolbar rows.
    config.toolbarGroups = [
        {name: 'clipboard', groups: ['clipboard', 'undo']},
        {name: 'editing', groups: ['find', 'selection', 'spellchecker']},
        {name: 'links'},
        {name: 'insert'},
        {name: 'forms'},
        {name: 'tools'},
        {name: 'document', groups: ['mode', 'document', 'doctools']},
        {name: 'others'},
        '/',
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align']},
        {name: 'styles'},
        {name: 'colors'},
        {name: 'about'}
    ];

    config.skin = 'moonocolor';
    // Remove some buttons provided by the standard plugins, which are
    // not needed in the Standard(s) toolbar.
    config.removeButtons = 'Underline,Subscript,Superscript';

    // Set the most common block elements.
    config.format_tags = 'p;h1;h2;h3;pre;div;button;img;provider;audio;source;h4;span';
    config.extraAllowedContent = 'div[*]{*}(*);button[*]{*}(*);iframe[*]{*}(*);img[*]{*}(*);span[*]{*}(*);';
    config.disallowedContent = 'script; *[on*]';

    // Simplify the dialog windows.
    config.removeDialogTabs = 'image:advanced;link:advanced';

    // remove upload tab
    config.removeDialogTabs = 'link:upload';

    config.mathJaxLib = '//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';

    config.mathJaxClass = 'my-math';
    config.htmlEncodeOutput = false;
    config.entities = false;
    config.enterMode = CKEDITOR.ENTER_BR;

    config.codeSnippet_theme = 'pojoaque';

    config.extraPlugins = 'panelbutton,colorbutton,justify,preview';
    config.height = 200;
//    config.startupMode = 'source';
};
