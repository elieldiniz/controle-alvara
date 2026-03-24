---
name: Laravel Best Practices
description: Guidelines for high-quality Laravel development based on industry standards.
---

# Laravel Best Practices Skill

This skill ensures adherence to the most effective patterns for Laravel development, maximizing maintainability, readability, and performance.

## Core Principles

### 1. Fat Models, Skinny Controllers
- **Repositories/Services/Actions**: Move business logic out of controllers.
- **Model Scopes**: Use Eloquent scopes for common query constraints.
- **Validation**: Always use `FormRequest` classes for validation.

### 2. DRY (Don't Repeat Yourself)
- **View Composers**: Use `ViewServiceProvider` to share common data (like categories or types) across views instead of querying in Blade.
- **Traits/Base Classes**: Shared logic should be encapsulated.

### 3. Clean Blade Templates
- **No Queries**: Never call models (`User::all()`) or DB queries in Blade.
- **Minimal Logic**: Keep Blade files focused on presentation. Use Helpers or Presenters if needed.
- **Eager Loading**: Always use `with()` to prevent N+1 issues when displaying relationships.

### 4. Naming Conventions (PSR/Laravel)
- **Controllers**: Singular (`ArticleController`).
- **Models**: Singular (`Article`).
- **Relationships**: Singular for 1:1 (`author`), Plural for 1:N/N:N (`comments`).
- **Pivot Tables**: Singular model names in alphabetical order (`article_user`).

### 5. Syntax & Performance
- **Short Syntax**: Prefer `now()`, `back()`, `session()`, `asset()` instead of verbose versions.
- **Collections**: Prefer Collections over raw Arrays for data manipulation.
- **Chunking**: Use `chunk()` or `cursor()` for large datasets.

## Implementation Guide for Agents
1. **Audit before Implement**: Check if a pattern or service already exists before creating a new one.
2. **Preference for Traits**: Use Traits for cross-cutting concerns (e.g., Tenancy, Auditing).
3. **Configuration**: Never use `env()` outside of `config/*.php`.

---
*Created on 2026-03-24 for the Alvras Project.*
