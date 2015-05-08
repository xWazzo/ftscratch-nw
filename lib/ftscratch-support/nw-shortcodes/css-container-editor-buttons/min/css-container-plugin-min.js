//DOCS: http://code.tutsplus.com/tutorials/guide-to-creating-your-own-wordpress-editor-buttons--wp-30182

(function() {
    tinymce.create('tinymce.plugins.CssContainer', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {
            //DOCS: http://www.tinymce.com/wiki.php/api4:method.tinymce.Editor.addButton
            
            // Add Button Information
            ed.addButton('css_container', {
                title : 'Add CSS Container shortcode',
                cmd : 'css_container',
                image : url + '/css-container.png',
            });

            ed.addButton('css_container_inside', {
                title : 'Inside CSS Container shortcode',
                cmd : 'css_container_inside',
                image : url + '/css-container-inside.png',
            });

            // Button Commands
            ed.addCommand('css_container', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';
                return_text = '[css-container class="" id="" container="div" attr=\'{"data-type":2}\']' + selected_text + '[/css-container]';
                ed.execCommand('mceInsertContent', 0, return_text);      

            });

            ed.addCommand('css_container_inside', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';
                return_text = '[css-container-inside class="" id="" container="div" attr=\'{"data-type":2}\']' + selected_text + '[/css-container-inside]';
                ed.execCommand('mceInsertContent', 0, return_text);      

            });
        },
 
        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        },
 
        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'CssContainer Buttons',
                author : 'Lee',
                authorurl : 'http://wp.tutsplus.com/author/leepham',
                infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
                version : "0.1"
            };
        }
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'css_container', tinymce.plugins.CssContainer );
})();

