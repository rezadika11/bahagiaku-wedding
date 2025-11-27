<script setup lang="ts">
const currentYear = new Date().getFullYear();
</script>

<template>
    <footer class="bg-gray-900 text-white py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-teal-500 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                            B
                        </div>
                        <span class="font-bold text-xl tracking-tight">Bahagiaku</span>
                    </div>
                    <p class="text-gray-400 max-w-sm">
                        Platform pembuatan undangan pernikahan digital terbaik di Indonesia. Bagikan momen bahagiamu dengan cara yang lebih modern dan elegan.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-4">Menu</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-teal-400 transition-colors">Beranda</a></li>
                        <li><a href="#features" class="hover:text-teal-400 transition-colors">Fitur</a></li>
                        <li><a href="#themes" class="hover:text-teal-400 transition-colors">Tema</a></li>
                        <li><a href="#pricing" class="hover:text-teal-400 transition-colors">Harga</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>support@bahagiaku.com</li>
                        <li>+62 812 3456 7890</li>
                        <li>Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500 text-sm">
                &copy; {{ currentYear }} Bahagiaku. All rights reserved.
            </div>
        </div>
    </footer>
</template>
