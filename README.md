# HTML to PDF Bundle

## Installation

Add to `composer.json`:


    {
        "require": {
            "eventpad/html-to-pdf-bundle"
        }
    }

## Optional

Add this to `app/config/routing_dev.yml`:

    _htmltopdf:
        resource: "@EPHtmlToPdfBundle/Resources/config/routing_dev.yml"
        prefix: /eventpad/html-to-pdf-bundle/

This allows you to open `/eventpad/html-to-pdf-bundle/test/test-card` to ensure everything is working.