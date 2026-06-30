<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Producten – {{ config('app.name', 'Klosterke') }}</title>
    @fonts
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <header class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-semibold">Producten</h1>
            <a href="/" class="text-sm underline underline-offset-4 text-[#f53003] dark:text-[#FF4433]">&larr; Terug</a>
        </header>

        @foreach ($categories as $category)
            @php $group = $products[$category->value] ?? collect(); @endphp
            <section class="mb-10">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-lg font-medium">{{ $category->label() }}</h2>
                    <span class="text-xs text-[#706f6c] dark:text-[#A1A09A]">{{ $group->count() }} producten</span>
                </div>

                @if ($group->isEmpty())
                    <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] italic">Geen producten in deze categorie.</p>
                @else
                    <div class="overflow-x-auto rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A]">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-[#f5f5f4] dark:bg-[#161615] text-left">
                                    <th class="px-4 py-3 font-medium">Naam</th>
                                    <th class="px-4 py-3 font-medium">Kwaliteit</th>
                                    <th class="px-4 py-3 font-medium">Verkoopdatum</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#e3e3e0] dark:divide-[#3E3E3A]">
                                @foreach ($group as $product)
                                    <tr class="hover:bg-[#fafaf9] dark:hover:bg-[#161615]/50 transition-colors">
                                        <td class="px-4 py-2.5">{{ $product->name }}</td>
                                        <td class="px-4 py-2.5">
                                            <span class="{{ $product->quality > 0 ? 'text-green-700 dark:text-green-400' : ($product->quality < 0 ? 'text-red-600 dark:text-red-400' : '') }}">
                                                {{ $product->quality }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2.5">
                                            <span class="{{ $product->sells_before < 0 ? 'text-red-600 dark:text-red-400' : '' }}">
                                                {{ $product->sells_before }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        @endforeach

        <footer class="mt-12 pt-6 border-t border-[#e3e3e0] dark:border-[#3E3E3A] text-xs text-[#706f6c] dark:text-[#A1A09A]">
            {{ config('app.name', 'Klosterke') }} &middot; v{{ app()->version() }}
        </footer>
    </div>
</body>
</html>
