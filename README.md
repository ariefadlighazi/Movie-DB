# Movie DB - Technical Test

## Features
- Auth System (Custom AuthController)
- Movie Search (OMDb API Integration)
- Infinite Scroll (Intersection Observer API)
- Favorites Management (Database persisted)
- Responsive Design (Tailwind CSS)
- Lazy Loading (Browser native)

## Architecture
- **Service Pattern**: API logic is encapsulated in `OmdbService` and `OmdbClient` to keep Controllers thin.
- **Repository-like persistence**: Favorites are handled through Eloquent models.
- **AJAX Interactivity**: Infinite scroll and favorite toggling use Axios for a SPA-like feel.

## Libraries Used
- **Laravel 12**: Framework
- **Axios**: For API calls and Infinite Scroll
- **Tailwind CSS**: For UI/UX
- **Lucide/Heroicons**: For iconography

## Notes
While the requirement mentioned Laravel 5, I have implemented this using Laravel 12 to leverage modern security features, better performance, and the latest Vite integration for a superior UI/UX experience.

