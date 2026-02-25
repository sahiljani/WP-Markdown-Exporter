# WP Markdown Exporter

WP Markdown Exporter provides a clean architecture foundation for exporting WordPress content as LLM-friendly Markdown.

## Current scope

- Bootstrap-only plugin entrypoint.
- Service registrar pattern for modular WP hook registration.
- Initial service stubs for admin UI, AJAX copy endpoint, and export pipeline.
- Composer + static analysis/testing quality tooling configuration.

## Local development

1. Install dependencies:
   ```bash
   composer install
   ```
2. Run coding standards:
   ```bash
   composer lint
   ```
3. Run static analysis:
   ```bash
   composer stan
   ```
4. Run tests:
   ```bash
   composer test
   ```

## Roadmap

- Render frontend-equivalent HTML with `the_content`.
- Add robust HTML cleaner + Markdown converter adapter.
- Add single-post copy, list-table actions, and bulk ZIP exports.
- Add settings, SEO metadata integration, and release workflow.
