<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Verdida') }}</title>
        <style>
            :root {
                --bg: #f6f2ea;
                --panel: #ffffff;
                --text: #1f1f1f;
                --muted: #6b6b6b;
                --border: #ded8cd;
                --accent: #111111;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                background: var(--bg);
                color: var(--text);
                font-family: "Georgia", "Times New Roman", serif;
            }

            .page {
                max-width: 980px;
                margin: 40px auto 60px;
                padding: 0 20px;
            }

            .title {
                font-size: 28px;
                margin: 0 0 18px;
            }

            .layout {
                display: flex;
                gap: 24px;
                align-items: flex-start;
            }

            .sidebar {
                width: 220px;
                background: var(--panel);
                border: 1px solid var(--border);
                border-radius: 10px;
                padding: 16px;
            }

            .sidebar h2 {
                font-size: 16px;
                margin: 0 0 10px;
            }

            .category-list {
                list-style: none;
                padding: 0;
                margin: 0;
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .category-link {
                display: block;
                padding: 8px 10px;
                border-radius: 8px;
                color: var(--text);
                text-decoration: none;
                border: 1px solid transparent;
            }

            .category-link:hover {
                border-color: var(--border);
            }

            .category-link.active {
                background: var(--accent);
                color: #ffffff;
                border-color: var(--accent);
            }

            .content {
                flex: 1;
            }

            .cards {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 14px;
            }

            .card {
                background: var(--panel);
                border: 1px solid var(--border);
                border-radius: 10px;
                padding: 14px 16px;
            }

            .card-title {
                font-size: 16px;
                margin: 0 0 6px;
            }

            .card-meta {
                font-size: 12px;
                color: var(--muted);
                text-transform: uppercase;
                letter-spacing: 0.04em;
                margin-bottom: 8px;
            }

            .card-desc {
                margin: 0;
                color: var(--muted);
                line-height: 1.5;
            }

            .empty {
                background: var(--panel);
                border: 1px dashed var(--border);
                border-radius: 10px;
                padding: 18px;
                color: var(--muted);
            }

            @media (max-width: 760px) {
                .layout {
                    flex-direction: column;
                }

                .sidebar {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <div class="page">
            <h1 class="title">Posts</h1>
            <div class="layout">
                <aside class="sidebar">
                    <h2>Categories</h2>
                    @php
                        $activeId = $activeCategoryId ? (int) $activeCategoryId : null;
                    @endphp
                    <ul class="category-list">
                        <li>
                            <a
                                href="{{ route('posts.index') }}"
                                class="category-link {{ $activeId ? '' : 'active' }}"
                            >
                                All
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a
                                    href="{{ route('posts.index', ['category' => $category->id]) }}"
                                    class="category-link {{ $activeId === $category->id ? 'active' : '' }}"
                                >
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </aside>

                <main class="content">
                    <div class="cards">
                        @forelse ($posts as $post)
                            <article class="card">
                                <div class="card-meta">{{ $post->category?->name }}</div>
                                <h3 class="card-title">{{ $post->title }}</h3>
                                <p class="card-desc">{{ $post->description }}</p>
                            </article>
                        @empty
                            <div class="empty">No posts found for this category.</div>
                        @endforelse
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
