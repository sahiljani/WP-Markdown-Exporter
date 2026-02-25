# WP Markdown Exporter — Full Implementation Plan

This plan replaces the prior high-level scaffold with concrete, actionable steps.

## How to use this plan

- Status labels:
  - `[ ]` Not started
  - `[-]` In progress
  - `[x]` Done
- Priority labels:
  - `P0` must-have for first usable release
  - `P1` high-value next
  - `P2` nice-to-have

---

## Phase 0 — Baseline cleanup and architecture hardening (P0)

### 0.1 Bootstrap + load order
- [ ] **Task 0.1.1 (P0):** Keep `my-llm-exporter.php` as bootstrap-only (headers/constants/autoload/init only).
- [ ] **Task 0.1.2 (P0):** Ensure plugin boot is deterministic and idempotent (prevent double registration).
- [ ] **Task 0.1.3 (P0):** Add activation hook to initialize default options with `autoload = no`.

### 0.2 Service container/registrar quality
- [ ] **Task 0.2.1 (P0):** Move from direct `new` calls inside `Plugin` to a small registrar/factory class.
- [ ] **Task 0.2.2 (P0):** Define explicit service dependency wiring (constructor DI for renderer/converter/export service).
- [ ] **Task 0.2.3 (P0):** Add integration test or smoke test for service registration.

### 0.3 Configuration + options contract
- [ ] **Task 0.3.1 (P0):** Define canonical options schema in one place (`my_llm_exporter_settings`).
- [ ] **Task 0.3.2 (P0):** Implement defaults + sanitization callbacks for every option.
- [ ] **Task 0.3.3 (P0):** Add `delete_data_on_uninstall` default false and ensure uninstall respects it.

**Exit criteria for Phase 0**
- Bootstrap stays minimal.
- Services are registered through a dedicated registrar/factory.
- Options schema/defaults/sanitization are implemented and tested.

---

## Phase 1 — Core export pipeline (P0)

### 1.1 Render source HTML correctly
- [ ] **Task 1.1.1 (P0):** Implement `ContentRenderer::render(int $post_id)` using `get_post()` + `apply_filters('the_content', ...)`.
- [ ] **Task 1.1.2 (P0):** Handle invalid post IDs, non-readable posts, password-protected content, and empty content.
- [ ] **Task 1.1.3 (P0):** Add tests around renderer behavior edge cases.

### 1.2 HTML cleaning pipeline
- [ ] **Task 1.2.1 (P0):** Implement conservative cleaner: remove `<script>`/`<style>`, normalize whitespace.
- [ ] **Task 1.2.2 (P0):** Add optional cleaner rules for builder wrappers (without destructive stripping).
- [ ] **Task 1.2.3 (P0):** Support mode switch: `clean` vs `preserve`.

### 1.3 Markdown conversion adapter
- [ ] **Task 1.3.1 (P0):** Add a real converter adapter implementation behind `MarkdownConverterInterface`.
- [ ] **Task 1.3.2 (P0):** Preserve critical HTML blocks when conversion fidelity is low.
- [ ] **Task 1.3.3 (P0):** Post-process markdown: spacing normalization + entity decoding.

### 1.4 Final export builder
- [ ] **Task 1.4.1 (P0):** Build `MarkdownExportService::export($post_id, $options)` with front matter.
- [ ] **Task 1.4.2 (P0):** Include title, URL, post type, publish date, modified date.
- [ ] **Task 1.4.3 (P0):** Add optional SEO metadata fields when available.

**Exit criteria for Phase 1**
- A single post can be exported to stable, readable markdown.
- Clean/preserve modes both work.
- Front matter is deterministic and configurable.

---

## Phase 2 — Secure single-post UX (P0)

### 2.1 Admin tools page (QA surface)
- [ ] **Task 2.1.1 (P0):** Implement `Tools > Markdown Export` page for manual QA and quick export checks.
- [ ] **Task 2.1.2 (P0):** Add post selector and export mode selector.

### 2.2 Secure AJAX endpoint
- [ ] **Task 2.2.1 (P0):** Add `wp_ajax_myplugin_export_md` endpoint.
- [ ] **Task 2.2.2 (P0):** Enforce `check_ajax_referer` + `current_user_can('edit_post', $post_id)` + `absint`.
- [ ] **Task 2.2.3 (P0):** Return structured JSON (`success`, `markdown`, `errors`).

### 2.3 Editor integration
- [ ] **Task 2.3.1 (P0):** Classic editor metabox with “Copy Markdown” action.
- [ ] **Task 2.3.2 (P0):** Gutenberg sidebar panel with same action.
- [ ] **Task 2.3.3 (P0):** Add copy-to-clipboard UX + success/failure notices.

**Exit criteria for Phase 2**
- Editors can securely copy markdown for a single post from editor UI.

---

## Phase 3 — List table + bulk export (P1)

### 3.1 List table actions
- [ ] **Task 3.1.1 (P1):** Add row action “Copy as Markdown” for supported post types.
- [ ] **Task 3.1.2 (P1):** Add bulk action “Export as Markdown”.

### 3.2 Bulk output modes
- [ ] **Task 3.2.1 (P1):** Mode A: combined markdown output (LLM paste-friendly).
- [ ] **Task 3.2.2 (P1):** Mode B: ZIP download of per-post `.md` files.

### 3.3 Resilience for large batches
- [ ] **Task 3.3.1 (P1):** AJAX chunk processing (e.g., 20 posts/request).
- [ ] **Task 3.3.2 (P1):** Track progress in transient/state key.
- [ ] **Task 3.3.3 (P1):** Build ZIP incrementally and clean temp artifacts.

**Exit criteria for Phase 3**
- Large selections export without hitting request timeouts.

---

## Phase 4 — Settings, presets, SEO metadata (P1)

### 4.1 Settings page and storage
- [ ] **Task 4.1.1 (P1):** Build settings page via Settings API.
- [ ] **Task 4.1.2 (P1):** Store all settings in `my_llm_exporter_settings`.
- [ ] **Task 4.1.3 (P1):** Settings fields:
  - include front matter
  - include SEO metadata
  - default export mode (`clean|preserve|html` if supported)
  - include prompt template
  - prompt template text
  - delete data on uninstall

### 4.2 SEO plugin integration
- [ ] **Task 4.2.1 (P1):** Detect Yoast and Rank Math safely.
- [ ] **Task 4.2.2 (P1):** Export meta title/description/canonical when enabled.
- [ ] **Task 4.2.3 (P1):** Graceful fallback when plugin metadata is unavailable.

### 4.3 Presets/templates
- [ ] **Task 4.3.1 (P1):** Add editable prompt presets (rewrite/summarize/FAQ).
- [ ] **Task 4.3.2 (P1):** Include preset block at end of export when enabled.

**Exit criteria for Phase 4**
- Non-technical users can tune exports without code changes.

---

## Phase 5 — Quality gates, CI, and release (P0)

### 5.1 Testing
- [ ] **Task 5.1.1 (P0):** Add unit tests for renderer, cleaner, export builder, and security checks.
- [ ] **Task 5.1.2 (P0):** Add regression fixtures for tricky builder HTML.

### 5.2 Static checks and standards
- [ ] **Task 5.2.1 (P0):** PHPCS with WPCS in CI.
- [ ] **Task 5.2.2 (P0):** PHPStan with WordPress stubs and baseline policy.
- [ ] **Task 5.2.3 (P0):** PHPUnit in CI matrix (PHP 8.0–8.3).

### 5.3 Release process
- [ ] **Task 5.3.1 (P0):** Keep `CHANGELOG.md` updated per release.
- [ ] **Task 5.3.2 (P0):** Ensure version constant and plugin header versions are synchronized.
- [ ] **Task 5.3.3 (P0):** Tag `v0.1.0` when Phase 0–2 are complete and tested.

**Exit criteria for Phase 5**
- Every PR runs quality checks.
- Release artifacts and changelog are reproducible.

---

## Security checklist (must pass before release)

- [ ] Capability checks for every export action (`edit_post`, post scoped).
- [ ] Nonce verification for all AJAX/download actions.
- [ ] Input validation (`absint`, whitelist mode values).
- [ ] Escaped output in admin UI.
- [ ] No public unauthenticated content export route.
- [ ] Uninstall data deletion only when explicitly enabled.

---

## Suggested commit sequence (actionable)

1. [ ] `chore: refine plugin bootstrap and registrar wiring`
2. [ ] `feat: implement renderer with content edge-case handling`
3. [ ] `feat: add html cleaner modes and markdown converter adapter`
4. [ ] `feat: implement markdown export service with front matter`
5. [ ] `feat: add secure ajax export endpoint`
6. [ ] `feat: add classic editor metabox and gutenberg sidebar copy action`
7. [ ] `feat: add list table row and bulk export actions`
8. [ ] `feat: implement batch processing and zip output`
9. [ ] `feat: add settings page with presets and metadata toggles`
10. [ ] `test: add exporter/security unit tests`
11. [ ] `chore: add github actions matrix for lint/stan/tests`
12. [ ] `docs: finalize readme + changelog for v0.1.0`

---

## Definition of Done (v0.1.0)

- [ ] Single-post copy works in classic and Gutenberg editors.
- [ ] Bulk export supports combined markdown and ZIP.
- [ ] Clean/preserve mode is selectable and reliable.
- [ ] Security checks are enforced everywhere.
- [ ] PHPCS, PHPStan, PHPUnit all pass in CI.
- [ ] Documentation and changelog are complete.
