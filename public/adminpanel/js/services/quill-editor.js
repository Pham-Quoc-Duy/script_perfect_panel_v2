// Initialize Quill Editor for Service Description
document.addEventListener('DOMContentLoaded', function() {
    // Check if Quill is loaded
    if (typeof Quill === 'undefined') {
        return;
    }

    // Initialize Quill editor
    const quill = new Quill('#editor-service-description', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'align': []
                }],
                ['link'],
                [{
                    'color': []
                }, {
                    'background': []
                }],
                [{
                    'size': ['small', false, 'large', 'huge']
                }],
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }]
            ]
        }
    });

    // Store reference globally for form submission
    window.serviceDescriptionEditor = quill;

    // Get initial content if exists
    const initialContent = document.getElementById('service-description-content');
    if (initialContent && initialContent.value) {
        const value = initialContent.value.trim();

        if (value) {
            try {
                // Try to parse as JSON (Quill Delta format)
                const delta = JSON.parse(value);
                quill.setContents(delta);
            } catch (e) {
                // If not JSON, treat as plain HTML or text
                quill.root.innerHTML = value;
            }
        }
    }

    // Update hidden input on text change
    quill.on('text-change', function() {
        if (initialContent) {
            initialContent.value = JSON.stringify(quill.getContents());
        }
    });
});