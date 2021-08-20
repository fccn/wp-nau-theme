# NAU WordPress Theme

This repository contains the WordPress NAU Theme visible on https://www.nau.edu.pt site.

## Required WordPress plugins
* Polylang - https://wordpress.org/plugins/polylang/
* Post Tags and Categories for Pages - https://wordpress.org/plugins/post-tags-and-categories-for-pages/
* OpenedX LMS and WordPress integrator (LITE) - https://wordpress.org/plugins/edunext-openedx-integrator/

## Recommended WordPress plugins
* ACF - Advanced Custom Fields - https://wordpress.org/plugins/advanced-custom-fields/
* Yoast SEO - https://wordpress.org/plugins/wordpress-seo/ - simplifica o processo de gestão SEO
* Page-list - https://wordpress.org/plugins/page-list/ - simplifca a criação de páginas em sub-listas
* Polylang Duplicate Content Addon - https://wordpress.org/plugins/duplicate-content-addon-for-polylang/

## Theme shortcodes
* nau_courses_list - Creates a course list (not in use)
* nau_courses_gallery - List all course cards in a catalog view
* nau_entities_gallery - Lists all entitie cards in a catalog view
* nau_news_gallery - Post list of all news
* nau_homepage_funder_entities_small_images - Lists entity logos on the home page
* nau_courses_cards - Similar to nau_courses_gallery?
* nau_homepage_slider - DEPRECATED
* nau_homepage_announcements - Replaces nau_homepage_slider
* nau_homepage_search - Search form. used in the homepage
* nau_courses_by_state - List courses by state (see additional information below)
* list_knowledge_areas - Generate a list of knowledge areas with course counts by area

**nau_courses_by_state shortode**
This shortcode accepts arguments used to generate a custom course list.

The argument `state` accepts the following values:
* soon
* available
* finished

If no `state` is provided, it shows all courses.

Usage
```html
[nau_courses_by_state state="available"]
```
## Custom post types
* Announcements - Homepage slider posts. Can be used to promote new courses or events.

## Custom containers
Homepage containers are needed to center highlighted courses. Containers have a max width of 1400px, to allow for modern resolution scalling.

```html
<div class="entity-container">
<h2>Cursos em destaque</h2>
[shortcodes go here]
</div>
```

## Build
Before you install this theme you need to build it, run it like:
```code
make build
```
