<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создатель коротких ссылок</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

    <!-- Шапка -->
    <header class="max-w-6xl mx-auto px-4 py-6 flex justify-between items-center">
        <div class="text-2xl font-bold text-indigo-600">Создатель коротких ссылок</div>
        <div class="space-x-4">
            <a href="/login" class="text-gray-600 hover:text-indigo-600 font-medium">Войти</a>
            <a href="/register" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 font-medium transition">Регистрация</a>
        </div>
    </header>

    <!-- Главный блок -->
    <main class="max-w-4xl mx-auto text-center mt-20 px-4">
        <h1 class="text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl">
            Управляйте вашими ссылками <span class="text-indigo-600">эффективно</span>
        </h1>
        <p class="mt-6 text-lg leading-8 text-gray-600 max-w-2xl mx-auto">
            Создавайте короткие ссылки, делитесь ими и отслеживайте подробную статистику переходов в реальном времени. Всё в одном удобном личном кабинете.
        </p>
        
        <div class="mt-10 flex justify-center gap-x-6">
            <a href="/dashboard/register" class="bg-indigo-600 text-white text-lg px-8 py-4 rounded-xl font-semibold shadow-lg hover:bg-indigo-700 hover:shadow-indigo-200 transition">
                Начать бесплатно
            </a>
        </div>
    </main>

    <!-- Сетка преимуществ -->
    <section class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 mt-24 px-4 mb-20">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="text-3xl mb-3">⚡</div>
            <h3 class="text-xl font-bold mb-2">Мгновенно</h3>
            <p class="text-gray-500">Генерация короткой ссылки занимает доли секунды. Быстро и без лишних кликов.</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="text-3xl mb-3">📊</div>
            <h3 class="text-xl font-bold mb-2">Аналитика</h3>
            <p class="text-gray-500">Отслеживайте количество переходов по каждой вашей ссылке прямо в дашборде.</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="text-3xl mb-3">🔒</div>
            <h3 class="text-xl font-bold mb-2">Приватность</h3>
            <p class="text-gray-500">Ваши ссылки принадлежат только вам. Управляйте, редактируйте или удаляйте их в любой момент.</p>
        </div>
    </section>

</body>
</html>