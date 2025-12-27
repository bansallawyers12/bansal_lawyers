// Alpine.js Data Component for TinyMCE
// Use in Blade templates: x-data="tinyMCE({ height: 500 })"

export function tinyMCE(options = {}) {
    return {
        content: '',
        editor: null,
        isLoading: false,
        
        async init() {
            // TinyMCE should be loaded globally
            if (typeof tinymce === 'undefined') {
                console.error('TinyMCE not loaded. Make sure it\'s included in the page.');
                return;
            }
            
            // Wait for Alpine to finish rendering
            this.$nextTick(() => {
                if (!this.$el) return;
                
                // Get initial content
                this.content = this.$el.value || '';
                
                const config = {
                    target: this.$el,
                    height: options.height || 500,
                    menubar: options.menubar !== false,
                    plugins: options.plugins || [
                        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                        'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
                    ],
                    toolbar: options.toolbar || 'undo redo | blocks | ' +
                        'bold italic underline strikethrough | forecolor backcolor | ' +
                        'alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist outdent indent | blockquote | ' +
                        'removeformat | link image media anchor | ' +
                        'table | charmap | code preview fullscreen | help',
                    content_style: options.contentStyle || 'body { font-family: "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Helvetica Neue", Arial, sans-serif; font-size: 14px }',
                    setup: (editor) => {
                        this.editor = editor;
                        
                        // Sync content with Alpine.js data
                        editor.on('change keyup', () => {
                            this.content = editor.getContent();
                            // Update textarea value for form submission
                            if (this.$el) {
                                this.$el.value = this.content;
                            }
                            this.$dispatch('tinymce:change', { content: this.content });
                        });
                        
                        // Set initial content if provided
                        if (this.content) {
                            editor.setContent(this.content);
                        }
                    },
                    // Include file_picker_callback and other options (will be set via editor.settings if needed)
                    ...Object.fromEntries(
                        Object.entries(options).filter(([key]) => 
                            !['height', 'menubar', 'plugins', 'toolbar', 'contentStyle'].includes(key)
                        )
                    )
                };
                
                try {
                    tinymce.init(config);
                } catch (error) {
                    console.error('Failed to initialize TinyMCE:', error);
                }
            });
        },
        
        destroy() {
            if (this.editor) {
                tinymce.remove(this.editor);
                this.editor = null;
            }
        }
    };
}

